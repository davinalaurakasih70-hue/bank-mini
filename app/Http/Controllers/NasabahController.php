<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::latest()->get();

        return view('nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:nasabahs,nis',
            'nama' => 'required|max:255',
            'kelas' => 'required|max:30',
            'alamat' => 'nullable',
            'no_hp' => 'nullable|max:20',
        ]);

        Nasabah::create($request->only([
            'nis',
            'nama',
            'kelas',
            'alamat',
            'no_hp',
        ]));

        return redirect()->route('nasabah.index')
            ->with('success', 'Data nasabah berhasil ditambahkan!');
    }

    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nis' => 'required|unique:nasabahs,nis,' . $nasabah->id,
            'nama' => 'required|max:255',
            'kelas' => 'required|max:30',
            'alamat' => 'nullable',
            'no_hp' => 'nullable|max:20',
        ]);

        $nasabah->update($request->only([
            'nis',
            'nama',
            'kelas',
            'alamat',
            'no_hp',
        ]));

        return redirect()->route('nasabah.index')
            ->with('success', 'Data nasabah berhasil diperbarui!');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();

        return redirect()->route('nasabah.index')
            ->with('success', 'Data nasabah berhasil dihapus!');
    }
}
