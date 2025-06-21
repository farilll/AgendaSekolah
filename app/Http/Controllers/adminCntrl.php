<?php

// namespace App\Http\Controllers;

// use App\Models\AgendaModel;
// use App\Models\User;
// use Illuminate\Http\Request;

// class adminCntrl extends Controller
// {
//     public function index()
//     {
//         $users = User::whereIn('role', ['guru', 'siswa'])->get();
//         return view('kegiatanadmin.kelolaakun', compact('users'));
//     }

//     public function tambahakun()
//     {
//         return view('kegiatanadmin.tambahakun');
//     }
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|min:6',
//             'role' => 'required|in:guru,siswa',
//         ]);

//         User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => bcrypt($request->password),
//             'role' => $request->role,
//         ]);

//         return redirect()->route('users.index');
//     }


//     public function destroy(User $user)
//     {
//         // Cegah admin menghapus dirinya sendiri
//         if (auth()->id() === $user->id) {
//             return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
//         }

//         // Hapus user
//         $user->delete();

//         return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
//     }
//     public function dashboard()
//     {
//         $totalSiswa = User::where('role', 'siswa')->count();
//         $totalGuru = User::where('role', 'guru')->count();
//         $totalKegiatan = AgendaModel::count();

//         return view('dashadmin', compact('totalSiswa', 'totalGuru', 'totalKegiatan'));
//     }

//     public function edit($id)
//     {
//         $user = User::findOrFail($id);
//         return view('kegiatanadmin.editakun', compact('user'));
//     }

//     public function update(Request $request, $id)
//     {
//         $user = User::findOrFail($id);

//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email|unique:users,email,' . $id, // abaikan email yang sama dengan user ini
//             'password' => 'nullable|min:6',
//             'role' => 'required|in:guru,siswa',
//         ]);

//         $user->name = $request->name;
//         $user->email = $request->email;
//         $user->role = $request->role;

//         if ($request->filled('password')) {
//             $user->password = bcrypt($request->password);
//         }

//         $user->save();

//         return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui.');
//     }


// }

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use App\Models\AgendaUserModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminCntrl extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['guru', 'siswa'])->get();
        return view('kegiatanadmin.kelolaakun', compact('users'));
    }

    public function tambahakun()
    {
        return view('kegiatanadmin.tambahakun');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:guru,siswa',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        // Cegah admin menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }

    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalKegiatan = AgendaModel::count();

        return view('dashadmin', compact('totalSiswa', 'totalGuru', 'totalKegiatan'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('kegiatanadmin.editakun', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:guru,siswa',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    // ===============================
    // Fitur tambahan: Kelola Kegiatan Guru
    // ===============================

    public function lihatKegiatanGuru()
    {
        $lihat = AgendaModel::with('pendaftarans', 'user')->get();
        return view('kegiatanadmin.kegiatanadmin', compact('lihat'));
    }

    public function editKegiatanGuru($id)
    {
        $edit = AgendaModel::findOrFail($id);
        return view('kegiatanadmin.editkegiatan', compact('edit'));
    }

    public function updateKegiatanGuru(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'tanggal' => 'required|date|after_or_equal:today',
            'kuota' => 'required|integer|min:1',
        ]);

        $agenda = AgendaModel::findOrFail($id);
        $agenda->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('admin.kegiatan')->with('success', 'Agenda berhasil diperbarui!');
    }

    public function hapusKegiatanGuru($id)
    {
        DB::beginTransaction();

        try {
            $agenda = AgendaModel::findOrFail($id);

            // Hapus relasi pendaftar terlebih dahulu
            AgendaUserModel::where('agenda_id', $agenda->id)->delete();

            // Hapus agenda
            $agenda->delete();

            DB::commit();
            return redirect()->route('admin.kegiatan')->with('success', 'Agenda berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.kegiatan')->with('error', 'Gagal menghapus agenda.');
        }
    }
}
