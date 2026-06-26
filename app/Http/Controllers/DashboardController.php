<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with statistics.
     */
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        
        // Ambil data jurusan beserta jumlah mahasiswanya
        $jurusanStats = Jurusan::withCount('mahasiswas')->get();

        return view('dashboard', compact('totalMahasiswa', 'jurusanStats'));
    }
}
