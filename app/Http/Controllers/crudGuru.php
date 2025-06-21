<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use App\Models\AgendaUserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class crudGuru extends Controller
{
    public function lihatkegiatan()
    {
        $lihat = AgendaModel::with('pendaftarans')->get();
        return view('kegiatanguru.lihatguru', compact('lihat'));
    }

    public function tambahkegiatan()
    {
        return view('kegiatanguru.tambahguru');
    }


    public function simpankegiatan(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string|max:1000',
                'tanggal' => 'required|date|after_or_equal:today',
                'kuota' => 'required|integer|min:1',
            ]);

            AgendaModel::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
                'kuota' => $request->kuota,
                'user_id' => Auth::id(),
            ]);
            DB::commit();
            return redirect()->route('lihat.guru')->with('success', 'Agenda berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('lihat.guru')->with('error', 'Agenda Gagal ditambahkan.');
        }
    }





    public function editkegiatan(Request $request)
    {
        $edit = AgendaModel::findOrFail($request->id);
        if ($request->isMethod('post')) {
            $edit->judul = $request->judul;
            $edit->deskripsi = $request->deskripsi;
            $edit->tanggal = $request->tanggal;
            $edit->kuota = $request->kuota;
            $edit->save();
            return redirect()->route('lihat.guru');
        }
        return view('kegiatanguru.editguru', compact('edit'));
    }

    public function hapuskegiatan(Request $request)
    {
        DB::beginTransaction();

        try {
            $agenda = AgendaModel::findOrFail($request->id);

            // Hapus pendaftar dari agenda_user
            AgendaUserModel::where('agenda_id', $agenda->id)->delete();

            // Hapus agendanya
            $agenda->delete();

            DB::commit();
            return redirect()->route('lihat.guru')->with('success', 'Agenda berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('lihat.guru')->with('error', 'Gagal menghapus agenda.');
        }
    }

    public function pendaftaranSiswa()
    {
        $pendaftaran = AgendaUserModel::with('user', 'agenda')->get();

        return view('kegiatanguru.siswamendaftar', compact('pendaftaran'));
    }
}
