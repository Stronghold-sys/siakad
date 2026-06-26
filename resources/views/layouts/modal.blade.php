@php
    $modalJurusans = \App\Models\Jurusan::all();
@endphp

<!-- Global Dynamic Modal Wrapper (Contentful Theme) -->
<div x-data="globalModal" 
     x-show="isOpen" 
     x-on:open-modal.window="open($event.detail)"
     x-on:close-modal.window="close()"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 transition-opacity duration-200"
     style="display: none;"
     x-transition:enter="ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <!-- Modal Content Box (Avenir Next, White Surface, 6px Radius, Modal Shadow) -->
    <div class="bg-surface w-full max-w-lg rounded-md p-6 border border-border-subtle shadow-modal relative transform transition-all duration-200"
         x-show="isOpen"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.outside="close()">

        <!-- Header -->
        <div class="flex justify-between items-center pb-4 border-b border-border-subtle mb-5">
            <h3 class="text-lg font-semibold text-text-primary" x-text="title"></h3>
            <button @click="close()" class="text-text-secondary hover:text-text-primary transition-colors duration-150 min-w-[44px] min-h-[44px] flex items-center justify-center rounded hover:bg-bg-app">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Main Form -->
        <form :action="action" method="POST" class="space-y-4">
            @csrf
            <!-- Method Spoofing (for PUT / DELETE) -->
            <input type="hidden" name="_method" :value="method">
            <!-- Hidden Student ID tracking -->
            <input type="hidden" name="modal_id" :value="studentId">

            <!-- DELETE CONFIRMATION STATE -->
            <template x-if="isDelete">
                <div class="space-y-3">
                    <p class="text-text-primary text-sm leading-relaxed">
                        Apakah Anda yakin ingin menghapus data mahasiswa ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </template>

            <!-- CREATE / EDIT STATE -->
            <template x-if="!isDelete">
                <div class="space-y-4">
                    <!-- NIM Input -->
                    <div>
                        <label for="nim" class="block text-xs font-semibold text-text-secondary mb-1.5 uppercase tracking-wide">Nomor Induk Mahasiswa (NIM)</label>
                        <x-input type="text" 
                                 name="nim" 
                                 id="nim" 
                                 x-model="nim"
                                 placeholder="Contoh: 2201010001" 
                                 required />
                        @error('nim')
                            <p class="text-semantic-error text-xs mt-1 font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Nama Input -->
                    <div>
                        <label for="nama" class="block text-xs font-semibold text-text-secondary mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                        <x-input type="text" 
                                 name="nama" 
                                 id="nama" 
                                 x-model="nama"
                                 placeholder="Contoh: Aditya Pratama" 
                                 required />
                        @error('nama')
                            <p class="text-semantic-error text-xs mt-1 font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Jurusan Selector -->
                    <div>
                        <label for="jurusan_id" class="block text-xs font-semibold text-text-secondary mb-1.5 uppercase tracking-wide">Program Studi / Jurusan</label>
                        <div class="relative">
                            <select name="jurusan_id" 
                                    id="jurusan_id" 
                                    x-model="jurusan_id"
                                    class="w-full min-h-[44px] px-3 py-2 border border-border-core rounded-sm text-sm text-text-primary bg-surface transition-all duration-150 focus:border-brand-blue focus:ring-3 focus:ring-brand-blue/20 focus:outline-none appearance-none cursor-pointer" 
                                    required>
                                <option value="" disabled class="text-text-muted">Pilih Jurusan</option>
                                @foreach($modalJurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" class="text-text-primary">
                                        {{ $jurusan->nama_jurusan }} (Rp {{ number_format($jurusan->biaya_semester, 0, ',', '.') }}/smtr)
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-text-secondary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('jurusan_id')
                            <p class="text-semantic-error text-xs mt-1 font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Informational Field: Server-side Tuition Fee warning -->
                    <div class="p-3 bg-bg-app rounded-sm border border-border-subtle">
                        <p class="text-xs text-text-secondary leading-relaxed">
                            <strong>Note Keamanan:</strong> Biaya Kuliah mahasiswa dihitung secara otomatis oleh sistem backend berdasarkan tarif Jurusan yang dipilih ditambah biaya registrasi Rp 250.000.
                        </p>
                    </div>
                </div>
            </template>

            <!-- Actions Footer -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-border-subtle mt-6">
                <x-button type="button" variant="secondary" @click="close()">
                    Batal
                </x-button>
                <!-- Button Simpan (Create/Edit) -->
                <x-button type="submit" variant="primary" x-show="!isDelete">
                    Simpan Data
                </x-button>
                <!-- Button Hapus (Delete Confirmation) -->
                <x-button type="submit" variant="negative" x-show="isDelete" style="display: none;">
                    Hapus Data
                </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('globalModal', () => ({
            isOpen: {{ $errors->any() ? 'true' : 'false' }},
            title: '{{ old("modal_id") ? "Ubah Data Mahasiswa" : "Tambah Mahasiswa Baru" }}',
            action: '{{ old("modal_id") ? route("mahasiswa.update", old("modal_id")) : route("mahasiswa.store") }}',
            method: '{{ old("modal_id") ? "PUT" : "POST" }}',
            isDelete: false,
            nim: '{{ old("nim") }}',
            nama: '{{ old("nama") }}',
            jurusan_id: '{{ old("jurusan_id") }}',
            studentId: '{{ old("modal_id") }}',

            open(detail) {
                this.isOpen = true;
                this.isDelete = detail.isDelete || false;
                this.title = detail.title || 'Form Mahasiswa';
                this.action = detail.action || '';
                this.method = detail.method || 'POST';
                this.studentId = detail.id || '';
                
                if (!this.isDelete) {
                    this.nim = detail.nim || '';
                    this.nama = detail.nama || '';
                    this.jurusan_id = detail.jurusan_id || '';
                }
            },
            close() {
                this.isOpen = false;
                this.isDelete = false;
                this.nim = '';
                this.nama = '';
                this.jurusan_id = '';
                this.studentId = '';
            }
        }));
    });
</script>
