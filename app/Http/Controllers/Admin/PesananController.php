<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use App\Models\Admin\Teknisi;
use App\Models\Admin\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // Mengambil semua pesanan dengan relasi teknisi, user, dan service
        // Anda bisa menambahkan paginasi di sini jika daftar pesanan sangat banyak
        $pesanan = Order::with(['teknisi', 'user', 'service'])->get();

        // Mengembalikan view untuk menampilkan daftar pesanan
        return view('pages.admin.pesanan.index', compact('pesanan'));
    }

    // Tampilkan detail pesanan
    public function show(Order $pesanan)
    {
        $pesanan->load(['teknisi', 'user', 'service']);
        return view('pages.admin.pesanan.show', compact('pesanan'));
    }

    // Form edit pesanan
    public function edit(Order $pesanan)
    {
        $pesanan->load(['teknisi', 'user', 'service']);
        $teknisis = Teknisi::all(); // Mengambil semua teknisi
        $users = User::all();       // Mengambil semua user
        $services = Service::where('status', 'aktif')->get(); // Mengambil service yang aktif

        return view('pages.admin.pesanan.edit', compact('pesanan', 'teknisis', 'users', 'services'));
    }

    // Update pesanan
    public function update(Request $request, Order $pesanan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'teknisi_id' => 'nullable|exists:users,id', // teknisi_id mungkin merujuk ke tabel users jika Teknisi adalah User dengan role 'teknisi'
            'service_id' => 'required|exists:services,id',
            'tanggal_pesanan' => 'required|date',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:tanggal_pesanan',
            'jam_service_diharapkan' => 'required',
            'alamat_service' => 'required|string',
            'deskripsi_masalah' => 'nullable|string',
            'status_order' => 'required|in:pending,diterima,dalam_proses,selesai,dibatalkan',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $pesanan->update($request->all());

        return redirect()->route('admin.pesanan.show', $pesanan->id)
                            ->with('success', 'Pesanan berhasil diupdate.');
    }
}
