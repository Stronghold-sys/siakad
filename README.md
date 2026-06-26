# SIAKAD - CRUD Mahasiswa Glassmorphism

Aplikasi Sistem Informasi Akademik (SIAKAD) sederhana untuk mengelola data Mahasiswa dan Jurusan. Aplikasi ini dikembangkan menggunakan Laravel (versi terbaru), Tailwind CSS (v4), Alpine.js, dan LottieFiles untuk menghadirkan antarmuka berbasis **Glassmorphism UI** yang modern, responsif, serta interaktif.

Proyek ini telah memenuhi seluruh standar akademik, mulai dari fungsionalitas CRUD lengkap, arsitektur kode terstruktur, keamanan ketat, hingga performa tinggi.

---

## 🚀 Fitur Utama

1. **Dashboard Statistik**:
   - Menampilkan total jumlah mahasiswa aktif.
   - Grafik distribusi persentase mahasiswa per program studi.
   - Tabel tarif acuan biaya kuliah per jurusan.
2. **CRUD Mahasiswa (Centralized Modal)**:
   - Pengelolaan data mahasiswa terpusat dalam satu file modal dinamis (`resources/views/layouts/modal.blade.php`).
   - Tidak ada duplikasi kode modal untuk operasi Tambah, Edit, maupun Hapus.
3. **Pencarian & Filter**:
   - Pencarian real-time berdasarkan nama mahasiswa.
   - Filter data berdasarkan program studi / jurusan.
4. **Keamanan Produksi**:
   - **Server-Side Parameter Protection**: Menghitung `biaya_kuliah` langsung di backend (Base Biaya Semester + Biaya Registrasi Rp 250.000). Parameter ini sepenuhnya terlindungi dari manipulasi request payload di sisi frontend.
   - **Rate Limiting**: Membatasi aksi submit form (POST, PUT, DELETE) maksimal **5 kali per menit per IP** menggunakan Laravel Rate Limiter middleware (`throttle:form_submit`).
5. **Animasi Lottie & Uiverse**:
   - Animasi notifikasi sukses (Lottie).
   - Animasi notifikasi error / konfirmasi hapus (Lottie).
   - Animasi halaman kosong / *empty state* (Lottie).
   - Animasi pemuatan data / *loading state* (Lottie).
   - Desain form input dan tombol interaktif yang terinspirasi dari Uiverse.io.
6. **Custom Glass Pagination**:
   - Navigasi halaman yang dihias dengan style frosted glass transparan yang serasi.

---

## 🛠️ Langkah Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di komputer lokal (*localhost*) Anda:

### 1. Prasyarat Sistem
Pastikan komputer Anda sudah terinstal:
- PHP >= 8.2 (Herd Lite atau PHP bawaan XAMPP)
- Composer
- Node.js & NPM
- XAMPP (untuk menjalankan MySQL database)

---

### 2. Persiapan Database (XAMPP)
1. Buka **XAMPP Control Panel**.
2. Klik tombol **Start** pada modul **Apache** dan **MySQL**.
3. Buka browser Anda dan akses **phpMyAdmin** di [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
4. Buat database baru bernama **`mahasiswa_db`**:
   - Klik menu **New** di kolom kiri phpMyAdmin.
   - Masukkan nama database: `mahasiswa_db`.
   - Klik **Create**.

---

### 3. Konfigurasi Aplikasi
1. Buka terminal atau Command Prompt pada direktori proyek.
2. Pastikan berkas `.env` sudah terkonfigurasi untuk MySQL (sudah kami otomatisasikan):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mahasiswa_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Generate application key (jika belum ada):
   ```bash
   php artisan key:generate
   ```

---

### 4. Migrasi & Seeder Database
Jalankan perintah berikut untuk membuat tabel-tabel relasi database dan mengisi data sampel jurusan serta mahasiswa awal:
```bash
php artisan migrate:fresh --seed
```
*Perintah ini akan secara otomatis mengisi program studi (Teknik Informatika, Sistem Informasi, DKV, dll.) beserta beberapa data mahasiswa contoh.*

---

### 5. Jalankan Server Pengembangan
Untuk melihat aplikasi berjalan di localhost, jalankan dua server berikut:

#### A. Jalankan Backend Laravel (PHP Server)
Jalankan perintah ini di terminal:
```bash
php artisan serve
```
Aplikasi Anda akan siap diakses di [http://127.0.0.1:8000](http://127.0.0.1:8000).

#### B. Jalankan Frontend Compile (Vite Dev Server - Opsional)
Jika Anda ingin memodifikasi styling atau menguji *Hot Module Replacement*:
```bash
npm run dev
```
*Catatan: Kami telah menyertakan CDN Tailwind CSS di file layout utama sebagai fallback. Aplikasi dapat langsung menampilkan visual glassmorphism dengan sempurna hanya dengan menjalankan server PHP backend (`php artisan serve`)!*

---

## 📂 Struktur File Utama Proyek

Berikut adalah berkas-berkas penting yang diimplementasikan:

```
tugas/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php      # Stats total mahasiswa & distribusi jurusan
│   │   │   └── MahasiswaController.php      # Logika CRUD, filter, & proteksi parameter
│   │   └── Requests/
│   │       ├── StoreMahasiswaRequest.php    # Validasi input tambah mahasiswa
│   │       └── UpdateMahasiswaRequest.php   # Validasi input ubah mahasiswa
│   └── Models/
│       ├── Jurusan.php                      # Model Jurusan (hasMany Mahasiswa)
│       └── Mahasiswa.php                    # Model Mahasiswa (belongsTo Jurusan)
├── database/
│   ├── migrations/
│   │   ├── ..._create_jurusans_table.php    # Skema tabel Jurusan (+ biaya_semester)
│   │   └── ..._create_mahasiswas_table.php   # Skema tabel Mahasiswa (+ biaya_kuliah)
│   └── seeders/
│       ├── JurusanSeeder.php                # Pengisian program studi awal
│       ├── MahasiswaSeeder.php              # Pengisian mahasiswa awal
│       └── DatabaseSeeder.php               # Class pemanggil seeder utama
├── resources/
│   └── views/
│       ├── components/
│       │   └── glass-pagination.blade.php   # Pagination kustom bertema glassmorphism
│       ├── layouts/
│       │   ├── app.blade.php                # Layout HTML utama (Glow effect, CDN, Font)
│       │   └── modal.blade.php              # Modal dinamis terpusat (Alpine.js)
│       ├── dashboard.blade.php              # Tampilan halaman statistik utama
│       └── mahasiswa/
│           └── index.blade.php              # Tampilan tabel mahasiswa, search & filter
└── routes/
    └── web.php                              # Konfigurasi routing & rate limiting
```

---

## 🔒 Desain Keamanan & Pengujian Parameter Sensitif

### Pengujian Rate Limiting:
Untuk menguji pembatasan pengiriman form:
1. Buka halaman **Data Mahasiswa**.
2. Coba kirimkan form (Tambah/Edit/Hapus) secara berturut-turut lebih dari 5 kali dalam waktu kurang dari 1 menit.
3. Pada pengiriman ke-6, server akan menolak request Anda dan memunculkan status error **`429 Too Many Requests`**. Limit akan ter-reset kembali setelah 1 menit.

### Pengujian Proteksi Parameter Biaya Kuliah:
1. Perhatikan kolom **Biaya Kuliah** pada tabel mahasiswa. Biaya tersebut dihitung di backend dengan rumus: `Biaya Semester Jurusan + Rp 250.000` (biaya registrasi).
2. Jika Anda mencoba memodifikasi form menggunakan *Inspect Element* browser untuk menambahkan input tersembunyi seperti `<input name="biaya_kuliah" value="0">`, backend secara otomatis akan **mengabaikannya**. Controller hanya membaca `jurusan_id`, memvalidasinya, lalu menghitung ulang biaya di sisi server sebelum menyimpannya ke database.
