@extends('layouts.app')

@section('page_title', 'Data Mahasiswa')

@section('content')
<div class="space-y-6" x-data="{ isLoading: false }">

    <!-- Header Panel -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <h1 class="text-2xl font-bold tracking-tight text-text-primary">Daftar Mahasiswa</h1>
            <p class="text-sm text-text-secondary">Kelola data induk mahasiswa, program studi, dan administrasi akademik.</p>
        </div>
        <!-- Tambah Mahasiswa Button (Avenir Next, 14px size, min 44px touch target) -->
        <x-button variant="primary" 
                  @click="$dispatch('open-modal', { 
                      title: 'Tambah Mahasiswa Baru', 
                      action: '{{ route('mahasiswa.store') }}', 
                      method: 'POST' 
                  })">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Mahasiswa
        </x-button>
    </div>

    <!-- Alert / Notification Banners (Clean, Solid Borders based on design tokens) -->
    @if(session('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             class="p-4 rounded-sm border-l-4 border-brand-teal bg-surface shadow-raised flex items-center justify-between transition-opacity duration-200"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-brand-teal flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium text-text-primary">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-text-secondary hover:text-text-primary min-w-[44px] min-h-[44px] flex items-center justify-center rounded">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div x-data="{ show: true }" 
             x-show="show" 
             class="p-4 rounded-sm border-l-4 border-semantic-error bg-surface shadow-raised flex items-start justify-between transition-opacity duration-200"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-semantic-error flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="space-y-1">
                    <span class="text-sm font-bold text-text-primary">Gagal Validasi Form</span>
                    <p class="text-xs text-text-secondary">Silakan periksa kembali pesan kesalahan pada modal input data.</p>
                </div>
            </div>
            <button @click="show = false" class="text-text-secondary hover:text-text-primary min-w-[44px] min-h-[44px] flex items-center justify-center rounded">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Search & Filter Card (Whitespace optimal) -->
    <x-card>
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="flex flex-col md:flex-row items-stretch gap-4" @submit="isLoading = true">
            <!-- Search field -->
            <div class="flex-grow">
                <label for="search" class="block text-xs font-semibold text-text-secondary mb-1.5 uppercase tracking-wide">Cari Mahasiswa</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-text-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <x-input type="text" 
                             name="search" 
                             id="search"
                             value="{{ $search }}"
                             class="pl-9" 
                             placeholder="Masukkan nama mahasiswa..." />
                </div>
            </div>

            <!-- Filter field -->
            <div class="w-full md:w-64">
                <label for="jurusan_id" class="block text-xs font-semibold text-text-secondary mb-1.5 uppercase tracking-wide">Program Studi</label>
                <div class="relative">
                    <select name="jurusan_id" id="jurusan_id" class="w-full min-h-[44px] px-3 py-2 border border-border-core rounded-sm text-sm text-text-primary bg-surface transition-all duration-150 focus:border-brand-blue focus:ring-3 focus:ring-brand-blue/20 focus:outline-none appearance-none cursor-pointer">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ $jurusanId == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-text-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex items-end gap-3">
                <x-button type="submit" variant="secondary" class="flex-grow md:flex-initial">
                    Terapkan
                </x-button>
                @if($search || $jurusanId)
                    <a href="{{ route('mahasiswa.index') }}" class="flex-grow md:flex-initial">
                        <x-button type="button" variant="secondary" class="w-full">
                            Reset
                        </x-button>
                    </a>
                @endif
            </div>
        </form>
    </x-card>

    <!-- Table Container Card (Md 6px Radius, shadow raised) -->
    <x-card class="p-0 overflow-hidden">
        
        <!-- Loading Overlay (Flat styling) -->
        <div x-show="isLoading" class="absolute inset-0 bg-white/60 z-30 flex items-center justify-center" style="display: none;">
            <div class="flex items-center gap-2 text-brand-blue font-medium text-sm">
                <!-- Clean CSS Spinner -->
                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Memuat Data...</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <!-- Header: 12px small font, text secondary, bold, border-core bottom -->
                    <tr class="border-b border-border-core text-text-secondary text-xs uppercase tracking-wide bg-bg-app">
                        <th class="py-3 px-4 font-semibold">NIM</th>
                        <th class="py-3 px-4 font-semibold">Nama Lengkap</th>
                        <th class="py-3 px-4 font-semibold">Program Studi</th>
                        <th class="py-3 px-4 font-semibold text-right">Biaya Kuliah (Protected)</th>
                        <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-subtle text-text-primary bg-surface">
                    @forelse($mahasiswas as $mahasiswa)
                        <!-- Table Rows: None (0px) border-radius applied -->
                        <tr class="hover:bg-bg-app/50 transition-colors duration-100 rounded-none">
                            <!-- NIM -->
                            <td class="py-3.5 px-4 font-mono text-xs md:text-sm text-text-primary">{{ $mahasiswa->nim }}</td>
                            
                            <!-- Nama -->
                            <td class="py-3.5 px-4 font-medium">{{ $mahasiswa->nama }}</td>
                            
                            <!-- Jurusan -->
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-brand-blue/10 text-brand-blue border border-brand-blue/20">
                                    {{ $mahasiswa->jurusan->nama_jurusan }}
                                </span>
                            </td>
                            
                            <!-- Biaya Kuliah -->
                            <td class="py-3.5 px-4 text-right font-semibold text-brand-teal">
                                Rp {{ number_format($mahasiswa->biaya_kuliah, 0, ',', '.') }}
                            </td>
                            
                            <!-- Actions -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Action -->
                                    <x-button variant="secondary" 
                                              class="min-h-[36px] px-2.5 py-1.5 text-xs text-text-secondary hover:text-brand-blue"
                                              @click="$dispatch('open-modal', { 
                                                  title: 'Ubah Data Mahasiswa', 
                                                  action: '{{ route('mahasiswa.update', $mahasiswa->id) }}', 
                                                  method: 'PUT', 
                                                  id: '{{ $mahasiswa->id }}', 
                                                  nim: '{{ $mahasiswa->nim }}', 
                                                  nama: '{{ $mahasiswa->nama }}', 
                                                  jurusan_id: '{{ $mahasiswa->jurusan_id }}' 
                                              })">
                                        Ubah
                                    </x-button>
                                    
                                    <!-- Delete Action -->
                                    <x-button variant="secondary" 
                                              class="min-h-[36px] px-2.5 py-1.5 text-xs text-text-secondary hover:text-semantic-error"
                                              @click="$dispatch('open-modal', { 
                                                  title: 'Hapus Data Mahasiswa', 
                                                  action: '{{ route('mahasiswa.destroy', $mahasiswa->id) }}', 
                                                  method: 'DELETE', 
                                                  isDelete: true, 
                                                  id: '{{ $mahasiswa->id }}' 
                                              })">
                                        Hapus
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <!-- Empty State (No Lottie since not referenced in preview.md, keeping it minimal) -->
                        <tr class="rounded-none">
                            <td colspan="5" class="py-12 px-4 text-center">
                                <div class="max-w-sm mx-auto space-y-2">
                                    <svg class="w-10 h-10 mx-auto text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h4 class="text-sm font-semibold text-text-primary">Tidak Ada Data Mahasiswa</h4>
                                    <p class="text-xs text-text-secondary">
                                        @if($search || $jurusanId)
                                            Tidak ada hasil yang sesuai dengan filter pencarian Anda.
                                        @else
                                            Klik tombol "Tambah Mahasiswa" di kanan atas untuk meregistrasikan mahasiswa pertama.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <!-- Custom Pagination (Contentful minimal flat theme) -->
    <div class="mt-4">
        {{ $mahasiswas->links('components.glass-pagination') }}
    </div>

</div>
@endsection
