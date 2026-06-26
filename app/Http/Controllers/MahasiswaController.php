<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jurusanId = $request->input('jurusan_id');

        $mahasiswas = Mahasiswa::with('jurusan')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })
            ->when($jurusanId, function ($query, $jurusanId) {
                return $query->where('jurusan_id', $jurusanId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString(); // Pertahankan parameter search & filter saat berpindah halaman

        $jurusans = Jurusan::all();

        return view('mahasiswa.index', compact('mahasiswas', 'jurusans', 'search', 'jurusanId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request)
    {
        $validated = $request->validated();

        // Security Policy: Proteksi parameter sensitif (Biaya Kuliah / Price)
        // DILARANG mengambil nilai biaya kuliah dari request user (mencegah manipulasi DOM/request payload)
        // HARUS dihitung/di-set dari backend (server-side only)
        $jurusan = Jurusan::findOrFail($validated['jurusan_id']);
        
        // Kalkulasi di backend: Biaya Semester Jurusan + Biaya Registrasi
        $registrationFee = 250000;
        $validated['biaya_kuliah'] = $jurusan->biaya_semester + $registrationFee;

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validated();

        // Security Policy: Proteksi parameter sensitif (Biaya Kuliah / Price)
        // Lakukan kalkulasi ulang di backend jika terjadi pembaruan Jurusan
        $jurusan = Jurusan::findOrFail($validated['jurusan_id']);
        
        $registrationFee = 250000;
        $validated['biaya_kuliah'] = $jurusan->biaya_semester + $registrationFee;

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}
