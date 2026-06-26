@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-6">
    
    <!-- Welcome Header Card -->
    <x-card class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-text-primary">
                Sistem Informasi Akademik (SIAKAD)
            </h1>
            <p class="text-sm text-text-secondary">
                Selamat datang kembali. Berikut adalah ikhtisar pendaftaran dan administrasi mahasiswa terintegrasi.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('mahasiswa.index') }}">
                <x-button variant="primary">
                    Kelola Mahasiswa
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </x-button>
            </a>
        </div>
    </x-card>

    <!-- Main Statistics Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Total Mahasiswa Card -->
        <x-card class="flex flex-col justify-center text-center space-y-2">
            <span class="text-xs font-semibold text-text-secondary uppercase tracking-wider block">Total Mahasiswa Aktif</span>
            <div class="flex items-baseline justify-center">
                <span class="text-5xl font-bold text-brand-blue tracking-tight">{{ $totalMahasiswa }}</span>
                <span class="text-xs text-text-secondary ml-1 font-medium">orang</span>
            </div>
            <p class="text-xs text-text-muted">Terdaftar di seluruh program studi</p>
        </x-card>

        <!-- Department Distribution (Span 2) -->
        <x-card class="lg:col-span-2 space-y-4">
            <div class="border-b border-border-subtle pb-2">
                <h3 class="text-base font-semibold text-text-primary">Distribusi Mahasiswa per Jurusan</h3>
                <p class="text-xs text-text-secondary">Persentase sebaran program studi mahasiswa aktif</p>
            </div>

            <!-- Stats Rows -->
            <div class="space-y-3">
                @foreach($jurusanStats as $stats)
                    @php
                        $percentage = $totalMahasiswa > 0 ? ($stats->mahasiswas_count / $totalMahasiswa) * 100 : 0;
                    @endphp
                    <div class="space-y-1">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-medium text-text-primary">{{ $stats->nama_jurusan }}</span>
                            <span class="font-semibold text-text-secondary">
                                {{ $stats->mahasiswas_count }} Mahasiswa ({{ number_format($percentage, 0) }}%)
                            </span>
                        </div>
                        <!-- Progress Bar (Design Tokens Mapping) -->
                        <div class="w-full h-2 bg-bg-app rounded-full overflow-hidden border border-border-subtle">
                            <div class="h-full bg-brand-blue transition-all duration-300"
                                 :style="{ width: '{{ $percentage }}%' }"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-card>

    </div>

    <!-- Acuan Biaya Kuliah (Flat Table based on tokens) -->
    <x-card class="space-y-4">
        <div class="border-b border-border-subtle pb-2">
            <h3 class="text-base font-semibold text-text-primary">Tarif Kuliah Program Studi</h3>
            <p class="text-xs text-text-secondary">Rincian acuan biaya kuliah per semester berdasarkan data program studi di server</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="border-b border-border-core text-text-secondary text-xs uppercase tracking-wide">
                        <th class="py-2.5 px-4 font-semibold">Nama Program Studi</th>
                        <th class="py-2.5 px-4 font-semibold">Biaya Semester (Base)</th>
                        <th class="py-2.5 px-4 font-semibold text-right">Biaya Kuliah Akhir (+Registrasi)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-subtle text-text-primary">
                    @foreach($jurusanStats as $stats)
                        <tr class="hover:bg-bg-app transition-colors duration-100">
                            <td class="py-3 px-4 font-medium">{{ $stats->nama_jurusan }}</td>
                            <td class="py-3 px-4 text-text-secondary">Rp {{ number_format($stats->biaya_semester, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-right font-semibold text-brand-teal">
                                Rp {{ number_format($stats->biaya_semester + 250000, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>

</div>
@endsection
