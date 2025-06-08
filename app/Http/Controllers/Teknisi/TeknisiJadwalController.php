<?php

namespace App\Http\Controllers\Teknisi;

use App\Models\Teknisi\Jadwal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeknisiJadwalController extends Controller
{
    // Tampilkan semua jadwal teknisi (bisa disesuaikan hanya jadwal teknisi yg login)
    public function index()
    {
        // Contoh menampilkan semua jadwal teknisi yang login
        $user = auth()->user();
        $jadwals = Jadwal::where('teknisi_id', $user->id)->orderBy('tanggal', 'asc')->get();

        return view('pages.teknisi.jadwal.index', compact('jadwals'));
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $this->authorize('delete', $jadwal);

        $jadwal->delete();

        return redirect()->route('pages.teknisi.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}