@extends('master.master')

@section('title', 'Edit Kegiatan')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Edit Kegiatan</h5>

            <form action="{{ route('admin.kegiatan.update', $edit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $edit->judul) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $edit->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $edit->tanggal) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="kuota" class="form-label">Kuota Pendaftaran</label>
                    <input type="number" name="kuota" class="form-control" min="1"
                        value="{{ old('kuota', $edit->kuota) }}" required>
                    @error('kuota')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kegiatan') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
