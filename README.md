# Simpel – Sistem Informasi Manajemen Pelayanan

🔧 Pengembangan lanjutan dari project [Laravel Laundry](https://github.com/isnaenisetiyadi79/laravel_laundry)  
Dirancang untuk menjadi sistem manajemen layanan jasa yang lebih umum dan fleksibel  
Menggunakan Laravel + Livewire + PostgreSQL/MySQL

---

## 🧩 Tentang Proyek Ini

**Simpel** (Sistem Informasi Manajemen Pelayanan) adalah sistem informasi berbasis web untuk berbagai jenis **usaha layanan jasa**, tidak terbatas hanya pada laundry. Proyek ini dikembangkan dengan arsitektur modern menggunakan Laravel dan Livewire, serta dukungan basis data PostgreSQL atau MySQL.

Project ini dirancang agar dapat dengan mudah dikembangkan untuk kebutuhan berbagai jenis layanan: laundry, salon, bengkel, servis elektronik, dan lainnya.

---

## ⚙️ Teknologi Utama

- **Laravel 12** – Framework PHP modern
- **Livewire** – Interaktivitas tanpa JavaScript berlebih
- **Tailwind CSS** – UI responsif dan bersih
- **PostgreSQL / MySQL** – Opsi database fleksibel

---

## ✅ Fitur Yang Sudah Ada

- 👤 **Manajemen User**
  - Pendaftaran dan login
  - Belum ada level akses (akan dikembangkan)
  
- 👥 **Manajemen Customer**
  - Tambah/edit/hapus pelanggan
  - Riwayat order
  
- 🛠️ **Manajemen Jenis Layanan**
  - Konfigurasi layanan (misal: setrika, servis AC, potong rambut, dll.)
  
- 📦 **Manajemen Order**
  - Input order pelanggan
  - Hubungan antara customer dan jenis layanan

---

## 🧭 Fitur Yang Akan Dikembangkan

- 🔐 **Role & Level Akses**
  - Admin, kasir, operator, dll.
  
- 🧾 **Detail Order Lebih Dari Satu**
  - Satu order bisa memiliki banyak layanan dalam satu transaksi
  
- 💼 **Penggajian**
  - Berdasarkan job description per layanan
  - Perhitungan upah otomatis
  
- 📥 **Pengambilan Barang/Jasa Berdasarkan Detail Order**
  - Tracking order yang sudah selesai dan siap diambil
  
- 💸 **Pembayaran**
  - Mendukung transaksi **cash** dan **hutang**
  - Riwayat pembayaran hutang pelanggan

---

## 📦 Instalasi

```bash
git clone https://github.com/isnaenisetiyadi79/simpel.git
cd simpel
composer install

# Setup database dan sesuaikan konfigurasi .env
cp .env.example .env

#edit isinya sesuai database
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=[dbase]
DB_USERNAME=[username]
DB_PASSWORD=[password]

#Generate key aplikasi
php artisan key:generate


# Lakukan migrasi database
php artisan migrate --seed


