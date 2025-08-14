<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Models\Jenis_simpanan;
use Illuminate\Support\Facades\Validator;

class JenisSimpananController extends Controller
{
    protected $hashids;
    public function __construct()
    {
        $this->hashids = new Hashids(config('app.key'), 85);
    }

    public function index()
    {
        $jenis = Jenis_simpanan::all();
        $jenis->each(function ($j) {
            $j->hashed_id = $this->hashids->encode($j->id);
        });
        return view('simpanan.jenis', ['jenis' => $jenis]);
    }

    public function create_jenis(Request $request)
    {
        $rules = [
            'jenis' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Jenis_simpanan::create([
            'jenis' => $request->jenis
        ]);

        return redirect()->route('jenis.simpanan')
            ->with('sukses', 'Jenis Simpanan created successfully.');
    }

    public function update(Request $request, $hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }

        $jenis = Jenis_simpanan::findOrFail($ids[0]);

        $rules = [
            'jenis' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $jenis->update([
            'jenis' => $request->jenis
        ]);

        return redirect()->route('jenis.simpanan')
            ->with('sukses', 'Jenis Simpanan updated successfully.');
    }

    public function delete($hashed_id)
    {
        $ids = $this->hashids->decode($hashed_id);

        if (empty($ids)) {
            abort(404);
        }

        $id = $ids[0];

        $jenis = Jenis_Simpanan::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis.simpanan')->with('sukses', 'Jenis simpanan berhasil dihapus!');
    }
}