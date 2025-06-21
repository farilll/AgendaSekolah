@extends('master.master')
@section('title', 'Edit Guru')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mt-4">
                <div class="col-12 col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Edit Agenda</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('edit.guru', $edit->id) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" value="{{ $edit->judul }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" rows="4" required>{{ $edit->deskripsi }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{ $edit->tanggal }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="kuota" class="form-label">Kuota Pendaftaran</label>
                                    <input type="number" name="kuota" class="form-control" min="1" required>
                                    @error('kuota')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
