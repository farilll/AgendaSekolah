@extends('master.master')

@section('title', 'Pendaftaran Kegiatan')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mt-4">
                <div class="col-12 col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Form Pendaftaran Kegiatan</h5>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="card-body">
                            <form method="POST" action="{{ route('daftar.siswa') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="agenda_id" class="form-label">Pilih Kegiatan</label>
                                    <select name="agenda_id" id="agenda_id" class="form-control" required>
                                        <option value="">-- Pilih Kegiatan --</option>
                                        @foreach ($kegiatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->judul }} - {{ $item->tanggal }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('agenda_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alasan" class="form-label">Alasan Mengikuti</label>
                                    <textarea name="alasan" id="alasan" class="form-control" rows="4" placeholder="Tulis alasan Anda..." required>{{ old('alasan') }}</textarea>
                                    {{-- @error('alasan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror --}}
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
