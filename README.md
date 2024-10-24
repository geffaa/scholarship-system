# Sistem Pendaftaran Beasiswa Online

Project ini merupakan implementasi sistem pendaftaran beasiswa online untuk sertifikasi Junior Web Developer. Sistem ini memungkinkan mahasiswa untuk mendaftar beasiswa dengan melihat Index Prestasi Kumulatif (IPK) terakhir sebagai salah satu syarat utama.

## 🚀 Fitur Utama

- Tampilan jenis dan syarat beasiswa
- Form pendaftaran beasiswa dengan validasi
- Pengecekan otomatis IPK untuk eligibilitas
- Upload berkas persyaratan
- Tracking status pendaftaran
- Dashboard hasil pendaftaran

## 💻 Teknologi yang Digunakan

- **Frontend:** HTML, CSS (Tailwind CSS), JavaScript
- **Backend:** PHP (Laravel 10)
- **Database:** MySQL
- **Package/Library:**
  - Laravel Breeze (Authentication)
  - Tailwind CSS
  - Alpine.js

## 📋 Prasyarat

Sebelum memulai, pastikan telah terinstall:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Git

## 🔧 Instalasi & Penggunaan

1. Clone repository
```bash
git clone https://github.com/username/scholarship-registration.git
cd scholarship-registration
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarship_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Jalankan migration dan seeder
```bash
php artisan migrate
php artisan db:seed
```

6. Compile assets
```bash
npm run dev
```

7. Jalankan server
```bash
php artisan serve
```

## 🔍 Fitur Detail

### 1. Halaman Utama
- Menampilkan minimal 2 jenis beasiswa
- Informasi syarat dan ketentuan
- Tombol pendaftaran

### 2. Form Pendaftaran
- Validasi input nama, email, dan nomor HP
- Pilihan semester (1-8)
- Pengecekan otomatis IPK
- Upload berkas (PDF/JPG/ZIP)
- Disable form jika IPK < 3.0

### 3. Hasil Pendaftaran
- Tampilan data pendaftar
- Status verifikasi
- Akses berkas yang diupload

## 🔐 Validasi & Batasan

1. **Email**
   - Format email valid
   - Unique dalam database

2. **Nomor HP**
   - Format numerik
   - Panjang nomor valid

3. **Semester**
   - Range 1-8
   - Required

4. **IPK**
   - Minimal 3.0 untuk eligibilitas
   - Auto-generated dalam sistem

5. **Berkas**
   - Format: PDF, JPG, atau ZIP
   - Maksimal ukuran 2MB

## 📄 Lisensi
Project ini dibuat untuk keperluan sertifikasi Junior Web Developer LSP Informatika.

---
© 2024 Sistem Pendaftaran Beasiswa Online. All rights reserved.
