@extends('master.master')

@section('title', 'Kelola Kegiatan')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="mb-4">Semua Kegiatan Guru</h5>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 20%;">Judul</th>
                            <th style="width: 25%;">Deskripsi</th>
                            <th style="width: 15%;">Guru</th>
                            <th style="width: 15%;">Tanggal</th>
                            <th style="width: 10%;">Kuota</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lihat as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan->judul }}</td>
                                <td>{{ Str::limit($kegiatan->deskripsi, 50) }}</td>
                                <td>{{ $kegiatan->user->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</td>
                                <td>{{ $kegiatan->kuota - $kegiatan->pendaftarans->count() }} / {{ $kegiatan->kuota }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.kegiatan.hapus', $kegiatan->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada kegiatan tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
