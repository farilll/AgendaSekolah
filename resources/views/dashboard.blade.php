<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php
                        $role = Auth::user()->role;
                    @endphp

                    @if ($role === 'guru')
                        <h3>Selamat datang, Guru {{ Auth::user()->name }}!</h3>
                        <p>Ini adalah halaman dashboard untuk guru.</p>

                        {{-- Tambahkan konten khusus guru di sini --}}
                    @elseif ($role === 'siswa')
                        <h3>Selamat datang, Siswa {{ Auth::user()->name }}!</h3>
                        <p>Ini adalah halaman dashboard untuk siswa.</p>

                        {{-- Tambahkan konten khusus siswa di sini
                    @else
                        <h3>Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p>Anda tidak memiliki role yang dikenali.</p> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
