@extends('master.master')
@section('title', 'Tambah Guru')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mt-4">
                <div class="col-12 col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Tambah Agenda</h5>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ route('guru.simpan') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Agenda</label>
                                    <input type="text" class="form-control" name="judul" required>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kuota" class="form-label">Kuota Pendaftaran</label>
                                    <input type="number" name="kuota" class="form-control" min="1" required>
                                    @error('kuota')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="{{ route('lihat.guru') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
