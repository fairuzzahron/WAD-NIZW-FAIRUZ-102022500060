<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RuanganController extends Controller
{
    //
    public function index()
    {
        $dt_ruang = Ruangan::all();
        return view('index', compact('dt_ruang'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|max:100',
            'kapasitas'    => 'required',
            'fasilitas'    => 'required',
            'lantai'       => 'required',
            'gambar'       => 'required|image|mimes:jpg,jpeg,png,webp|max:10485', // 10MB max
        ]);

        $namaFile = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $namaFile);
        }

        Ruangan::create([
            'gambar'       => $namaFile,
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas'    => $request->kapasitas,
            'fasilitas'    => $request->fasilitas,
            'lantai'       => $request->lantai,
            'status'       => 'aktif',
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Data masuk database yh!');
    }

    public function edit($id)
    {
        $data_ruang = Ruangan::findOrFail($id);
        return view('update', compact('data_ruang'));
    }

    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'nama_ruangan' => 'required|max:100',
            'kapasitas'    => 'required',
            'fasilitas'    => 'required',
            'lantai'       => 'required',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10485',
        ]);

        $namaFile = $ruangan->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($namaFile && File::exists(public_path('img/' . $namaFile))) {
                File::delete(public_path('img/' . $namaFile));
            }

            $file = $request->file('gambar');
            $namaFile = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $namaFile);
        }

        $ruangan->update([
            'gambar'       => $namaFile,
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas'    => $request->kapasitas,
            'fasilitas'    => $request->fasilitas,
            'lantai'       => $request->lantai,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Data update masuk database yh!');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);

        // Hapus file gambar
        if ($ruangan->gambar && File::exists(public_path('img/' . $ruangan->gambar))) {
            File::delete(public_path('img/' . $ruangan->gambar));
        }

        $ruangan->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Data dihapus admin yh!');
    }
}
