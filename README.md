<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development/)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->

<p align="center">
  <b>Agenda Sekolah</b><br>
  <i>(Manajemen Kegiatan Sekolah)</i><br><br>
  <img src="images/logoUnsulbar.jpg" width="150"><br><br>
  <b>Faril</b><br>
  <b>D0223015</b><br><br>
  Framework Web Based<br>
  2025
</p>

---

## Role dan Fitur-fiturnya

| Role  | Fitur                                                                                                                                   |
| ----- | --------------------------------------------------------------------------------------------------------------------------------------- |
| Admin | - Mengelola semua agenda (buat, edit, hapus) <br> - Mengelola data pengguna (guru dan siswa) <br> - Melihat siapa yang mendaftar agenda |
| Guru  | - Membuat, mengedit, dan menghapus agenda miliknya sendiri <br> - Melihat siswa yang mendaftar ke agenda yang dibuat                    |
| Siswa | - Melihat daftar agenda yang tersedia <br> - Mendaftar ke agenda yang dipilih                                                           |

---

## Struktur Tabel Database

### Tabel 1: `[users]`

| Nama Field | Tipe Data    | Keterangan                        |
| ---------- | ------------ | --------------------------------- |
| id         | INT          | Primary key, auto increment       |
| name       | VARCHAR(255) | Nama lengkap pengguna             |
| email      | VARCHAR(255) | Email unik untuk login            |
| password   | VARCHAR(255) | Password terenkripsi              |
| role       | ENUM         | Role pengguna: admin, guru, siswa |
| created_at | TIMESTAMP    | Waktu dibuat                      |
| updated_at | TIMESTAMP    | Waktu diperbarui                  |

---

### Tabel 2: `[agenda]`

| Nama Field | Tipe Data    | Keterangan                                                |
| ---------- | ------------ | --------------------------------------------------------- |
| id         | INT          | Primary key, auto increment                               |
| user_id    | INT          | ID pengguna yang membuat agenda (relasi ke tabel `users`) |
| judul      | VARCHAR(255) | Judul agenda                                              |
| deskripsi  | TEXT         | Deskripsi agenda (opsional)                               |
| tanggal    | DATE         | Tanggal pelaksanaan agenda                                |
| created_at | TIMESTAMP    | Waktu dibuat                                              |
| updated_at | TIMESTAMP    | Waktu diperbarui                                          |

---

### Tabel 3: `[agenda_user]`

| Nama Field | Tipe Data | Keterangan                                               |
| ---------- | --------- | -------------------------------------------------------- |
| id         | INT       | Primary key, auto increment                              |
| agenda_id  | INT       | ID agenda yang didaftarkan (relasi ke tabel `agendas`)   |
| user_id    | INT       | ID siswa yang mendaftar agenda (relasi ke tabel `users`) |
| created_at | TIMESTAMP | Waktu pendaftaran                                        |
| updated_at | TIMESTAMP | Waktu pembaruan (jika ada)                               |

---

## Relasi Antar Tabel

-   Tabel `[users]` memiliki relasi **one-to-many** dengan tabel `[agenda]`.

    -   Foreign key: `user_id` di `[agenda]` merujuk ke `id` di `[users]`.
    -   Penjelasan: 1 pengguna bisa membuat banyak agenda.

-   Tabel `[agenda]` memiliki relasi **one-to-many** dengan tabel `[agenda_user]`.

    -   Foreign key: `agenda_id` di `[agenda_user]` merujuk ke `id` di `[agenda]`.
    -   Penjelasan: 1 agenda bisa diikuti oleh banyak siswa.

-   Tabel `[users]` memiliki relasi **one-to-many** dengan tabel `[agenda_user]`.
    -   Foreign key: `user_id` di `[agenda_user]` merujuk ke `id` di `[users]`.
    -   Penjelasan: 1 siswa bisa mendaftar ke banyak agenda.

---
