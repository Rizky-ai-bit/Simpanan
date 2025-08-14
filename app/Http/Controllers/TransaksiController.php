<?php

namespace App\Http\Controllers;

use App\Models\Jenis_simpanan;
use Hashids\Hashids;
use App\Models\Simpanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    protected $hashids;
    public function __construct()
    {
        $this->hashids = new Hashids(config('app.key'), 85);
    }

    public function show($hashed_id)
    {
        // Dekode ID
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }

        $id = $ids[0];

        $simpanan = Simpanan::with('transaksi.jenisSimpanan')->findOrFail($id);

        $daftarJeniSimpanan = Jenis_simpanan::all();

        $totalJenisSimpanan = [];

        foreach ($daftarJeniSimpanan as $jenis) {
            $totalSetoran = $simpanan->transaksi->where('jenis_simpanan_id', $jenis->id)->sum('setoran');
            $totalJenisSimpanan[$jenis->jenis] = $totalSetoran;
        }

        $totalSetoran = $simpanan->transaksi->sum('setoran');

        $simpanan->hashed_id = $hashed_id;
        $simpanan->transaksi->each(function ($t) {
            $t->hashed_id = $this->hashids->encode($t->id);
        });

        return view('simpanan.show', compact('simpanan', 'daftarJeniSimpanan', 'totalJenisSimpanan', 'totalSetoran'));
    }

    public function create(Request $request, $hashed_id)
    {
        // dd($request->all());
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }


        $id = $ids[0];
        $rules = [
            'jenis_simpanan_id' => 'required',
            'setoran'           => 'required|numeric|min:5000',
            'tgl'               => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $simpanan = Simpanan::findOrFail($id);
        $transaksi = Transaksi::create([
            'jenis_simpanan_id' => $request->jenis_simpanan_id,
            'setoran'           => $request->setoran,
            'tgl'               => $request->tgl,
            'id_simpanan'       => $simpanan->id
        ]);

        $simpanan->saldo_simpanan += $transaksi->setoran;
        $simpanan->save();

        return redirect()->route('show.detail', ['hashed_id' => $this->hashids->encode($simpanan->id)])->with('sukses', 'Simpanan berhasil ditambahkan');
    }

    public function pdf($hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }



        $id = $ids[0];
        $simpanan = Simpanan::with('transaksi')->findOrFail($id);
        $totalSimpanan = $simpanan->transaksi->sum('setoran');
        $simpanan->hashed_id = $hashed_id;
        return view('simpanan.pdf', compact('simpanan', 'totalSimpanan'));
    }

    public function update(Request $request, $hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }

        $id = $ids[0];

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update($request->all());

        return redirect()->route('show.detail', ['hashed_id'  => $this->hashids->encode($transaksi->id_simpanan)])->with('sukses', 'Data berhasil di ubah');
    }

    public function delete($hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }


        $id = $ids[0];

        $transaksi = Transaksi::findOrFail($id);

        $id_simpanan = $transaksi->id_simpanan;

        $transaksi->delete();

        $simpanan = Simpanan::find($id_simpanan);
        if ($simpanan) {
            $simpanan->saldo_simpanan -= $transaksi->setoran;
            $simpanan->save();
        }

        return redirect()->route('show.detail', ['hashed_id' => $this->hashids->encode($id_simpanan)])->with('sukses', 'Transaksi berhasil dihapus');
    }
}
