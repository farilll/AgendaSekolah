<?php

// namespace App\Http\Controllers;

// use App\Models\AgendaModel;
// use App\Models\AgendaUserModel;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class agendaUserCntrl extends Controller
// {
//     public function store(Request $request)
//     {
//         $request->validate([
//             'agenda_id' => 'required|exists:agendas,id',
//         ]);

//         AgendaUserModel::create([
//             'user_id' => Auth::id(),
//             'agenda_id' => $request->agenda_id,
//             'alasan' => $request->alasan,
//         ]);

//         return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan.');

//     }
//     public function create()
//     {
//         $kegiatan = AgendaModel::all(); // atau model yang sesuai
//         return view('kegiatansiswa.pendaftaran', compact('kegiatan'));
//     }

//     public function hapussiswa($id)
//     {
//         $hapus = AgendaUserModel::findOrFail($id);
//         $hapus->delete();
//         return redirect()->back()->with('success', 'Data berhasil dihapus.');
//     }
// }

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use App\Models\AgendaUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class agendaUserCntrl extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'agenda_id' => 'required|exists:agendas,id',
            'alasan' => 'required|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $agenda = AgendaModel::findOrFail($request->agenda_id);

            // Cek apakah siswa sudah pernah mendaftar ke agenda ini
            $sudahTerdaftar = AgendaUserModel::where('agenda_id', $agenda->id)
                ->where('user_id', Auth::id())
                ->exists();

            if ($sudahTerdaftar) {
                throw new \Exception('Anda sudah mendaftar pada kegiatan ini.');
            }

            // Hitung jumlah pendaftar saat ini
            $jumlahPendaftar = AgendaUserModel::where('agenda_id', $agenda->id)->count();

            if ($agenda->kuota !== null && $jumlahPendaftar >= $agenda->kuota) {
                throw new \Exception('Kuota pendaftaran telah penuh.');
            }

            // Simpan pendaftaran
            AgendaUserModel::create([
                'user_id' => Auth::id(),
                'agenda_id' => $agenda->id,
                'alasan' => $request->alasan,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $kegiatan = AgendaModel::all();
        return view('kegiatansiswa.pendaftaran', compact('kegiatan'));
    }

    public function hapussiswa($id)
    {
        $hapus = AgendaUserModel::findOrFail($id);
        $hapus->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}

