<?php

use App\Http\Controllers\adminCntrl;
use App\Http\Controllers\agendaUserCntrl;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\crudGuru;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\forAdmin;
use App\Http\Middleware\forGuru;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', function () {
        return view('dashadmin');
    })->name('dashadmin');

    Route::get('/guru/dashboard', function () {
        return view('dashguru');
    })->name('dashguru');

    Route::get('/siswa/dashboard', function () {
        return view('dashsiswa');
    })->name('dashsiswa');

});


//login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);


Route::middleware(['auth', forGuru::class])->group(function () {
    // Lihat daftar guru
    Route::get('/guru', [crudGuru::class, 'lihatkegiatan'])->name('lihat.guru');
    // Tampilkan form tambah guru
    Route::get('/guru/tambah', [crudGuru::class, 'tambahkegiatan'])->name('tambah.guru');
    // Simpan data guru baru
    Route::post('/guru/simpan', [crudGuru::class, 'simpankegiatan'])->name('guru.simpan');
    // Edit guru berdasarkan ID
    Route::match(['get', 'post'], '/guru/edit/{id}', [crudGuru::class, 'editkegiatan'])->name('edit.guru');
    // Hapus guru
    Route::delete('/guru/hapus/{id}', [crudGuru::class, 'hapuskegiatan'])->name('hapus.guru');
    // Route::post('/guru/hapusagenda', [crudGuru::class, 'hapuskegiatan'])->name('hapus.guru');
    Route::get('/pendaftaran-siswa', [crudGuru::class, 'pendaftaranSiswa'])->name('pendaftaran.siswa');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pendaftaran', [agendaUserCntrl::class, 'create'])->name('create.siswa');
    Route::post('/pendaftaran', [agendaUserCntrl::class, 'store'])->name('daftar.siswa');
    Route::delete('/hapus/siswa/{id}', [agendaUserCntrl::class, 'hapussiswa'])->name('hapus.siswa');
});

Route::middleware(['auth', forAdmin::class])->group(function () {
    Route::resource('users', adminCntrl::class);
    Route::get('/admin/dashboard', [adminCntrl::class, 'dashboard'])->name('dashadmin');
    Route::get('/admin/users/{id}/edit', [adminCntrl::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [adminCntrl::class, 'update'])->name('users.update');
    Route::get('/admin/users/create', [adminCntrl::class, 'tambahakun'])->name('users.create');
    Route::post('/admin/users', [adminCntrl::class, 'store'])->name('users.store');

    // Fitur admin untuk melihat & mengelola semua kegiatan guru
    Route::get('/admin/kegiatan', [adminCntrl::class, 'lihatKegiatanGuru'])->name('admin.kegiatan');
    Route::get('/admin/kegiatan/{id}/edit', [adminCntrl::class, 'editKegiatanGuru'])->name('admin.kegiatan.edit');
    Route::put('/admin/kegiatan/{id}', [adminCntrl::class, 'updateKegiatanGuru'])->name('admin.kegiatan.update');
    Route::delete('/admin/kegiatan/{id}', [adminCntrl::class, 'hapusKegiatanGuru'])->name('admin.kegiatan.hapus');


});

require __DIR__ . '/auth.php';
