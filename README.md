# laravel_laundry
Belajar dari udemy, Laravel Livewire Studi Kasus: Laundry

**Tentang Software**
Ini adalah murni belajar dari Udemy. Bisa digunakan untuk layanan sederhana, seperti laundry. Bisa juga untuk layanan jasa lainnya, seperti service handphone, komputer dan elektronik lainnya, bengkel motor, dan lain-lain.

**_Petunjuk instalasi_**
Clone repository ini atau download zip.

'git clone https://github.com/isnaenisetiyadi79/laravel_laundry'

## Install composer
'composer install'

## Edit koneksi database .env
Terlebih dahulu, buat database dan usernya, berikan grant sesuai kebutuhan,
Disarankan menggunakan PostgreSQL meskipun MySQL juga bisa(pada MySQL belum diuji).

'cp .env.example .env'
'nano .env'

edit koneksi database:
'DB_CONNECTION=pgsql'
'DB_HOST=127.0.0.1'
'DB_PORT=5432'
'DB_DATABASE=[nama database]'
'DB_USERNAME=[nama user]'
'DB_PASSWORD=[password]'

## Install Composer
'composer install'
_Tunggu sampai proses instalasi selesai, ini membutuhkan waktu beberapa menit._


## Key Generate
'php artisan key:generate'

# Migrasi Dababase
'php artisan migrate'
'php artisan db:seed'
