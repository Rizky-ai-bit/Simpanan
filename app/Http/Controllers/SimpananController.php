<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;

class SimpananController extends Controller
{
    protected $hashids;
    public function __construct()
    {
        $this->hashids = new Hashids(config('app.key'), 85);
    }

    public function index()
    {
        $simpanan = Simpanan::all();
        $simpanan->each(function ($s) {
            $s->hashed_id = $this->hashids->encode($s->id);
        });
        return view('simpanan.index', ['simpanan' => $simpanan]);
    }

    public function create_simpanan(Request $request)
    {
        $rules = [
            'nama'          => 'required|string|max:255',
            'nomor_anggota' => 'required|string|max:50',
            'unit'          => 'required|string|max:100',
            'no_hp'         => 'required|numeric|digits_between:10,15',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Simpanan::create([
            'nama'          => $request->nama,
            'nomor_anggota' => $request->nomor_anggota,
            'unit'          => $request->unit,
            'no_hp'          => $request->no_hp
        ]);

        return redirect()->route('simpan.index')
            ->with('sukses', 'Simpanan created successfully.');
    }

    public function update(Request $request, $hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }

        $id = $ids[0];
        $simpanan = Simpanan::findOrFail($id);

        $simpanan->update($request->all());

        return redirect()->route('simpan.index')->with('sukses', 'Data berhasil diupdate!');
    }

    public function delete($hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }

        $id = $ids[0];

        $simpanan = Simpanan::findOrFail($id);
        $simpanan->delete();

        return redirect()->route('simpan.index')->with('sukses', 'Data berhasil dihapus!');
    }
}