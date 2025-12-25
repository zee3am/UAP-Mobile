<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelayananController extends Controller
{
    // GET ALL (PUBLIC)
    public function index()
    {
        return response()->json(Pelayanan::all());
    }

    // GET DETAIL (PUBLIC)
    public function show($id)
    {
        return response()->json(Pelayanan::findOrFail($id));
    }

    // CREATE (AUTH + FILE)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'foto_sepatu' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $filename = null;

        if ($request->hasFile('foto_sepatu')) {
            $file = $request->file('foto_sepatu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pelayanans', $filename);
        }

        $pelayanan = Pelayanan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'foto_sepatu' => $filename,
        ]);

        return response()->json($pelayanan, 201);
    }

    // UPDATE (AUTH + FILE)
    public function update(Request $request, $id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        $request->validate([
            'foto_sepatu' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('foto_sepatu')) {
            if ($pelayanan->foto_sepatu) {
                Storage::delete('public/pelayanans/' . $pelayanan->foto_sepatu);
            }

            $file = $request->file('foto_sepatu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pelayanans', $filename);
            $pelayanan->foto_sepatu = $filename;
        }

        $pelayanan->update($request->except('foto_sepatu'));

        return response()->json($pelayanan);
    }

    // DELETE (AUTH)
    public function destroy($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        if ($pelayanan->foto_sepatu) {
            Storage::delete('public/pelayanans/' . $pelayanan->foto_sepatu);
        }

        $pelayanan->delete();

        return response()->json([
            'message' => 'Data pelayanan berhasil dihapus',
        ]);
    }
}