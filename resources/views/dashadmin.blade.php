@extends('master.master') <!-- pastikan ini file layout utama Mantis kamu -->

@section('title', 'Statistik')

@section('content')
    <div class="row">
        <!-- Total Siswa -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Siswa</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalSiswa }}</h5>
                    <p class="card-text">Jumlah siswa yang terdaftar.</p>
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Guru</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalGuru }}</h5>
                    <p class="card-text">Jumlah guru aktif.</p>
                </div>
            </div>
        </div>

        <!-- Total Kegiatan -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Kegiatan</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalKegiatan }}</h5>
                    <p class="card-text">Kegiatan yang dibuat.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
