@extends('master.master')
@section('title', 'Lihat Guru')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row mt-4">
                <div class="col-12 col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h5 class="mb-0">Semua Kegiatan</h5>
                            <a href="{{ route('tambah.guru') }}" class="btn btn-success btn-sm">Tambah Agenda</a>
                        </div>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 20%;">Judul</th>
                                            <th style="width: 35%;">Deskripsi</th>
                                            <th style="width: 25%;">Tanggal</th>
                                            <th style="width: 25%;">Kuota</th>
                                            <th style="width: 20%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lihat as $lht)
                                            <tr>
                                                <td>{{ $lht->judul }}</td>
                                                <td>{{ Str::limit($lht->deskripsi, limit: 100) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($lht->tanggal)->format('d M Y') }}</td>
                                                <td>
                                                    {{ $lht->kuota - $lht->pendaftarans->count() }} / {{ $lht->kuota }}
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('edit.guru', $lht->id) }}"
                                                            class="btn btn-sm btn-warning m-0">Edit</a>
                                                        <form action="{{ route('hapus.guru', $lht->id) }}" method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus?')"
                                                            class="m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger m-0">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada agenda.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
