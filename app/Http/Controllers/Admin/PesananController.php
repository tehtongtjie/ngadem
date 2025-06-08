<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Impor semua model dari lokasi yang benar
use App\Models\Customer\Order;    // Model Order berada di App\Models\Customer
use App\Models\Customer\Payment;  // Model Payment berada di App\Models\Customer
use App\Models\Customer\Service;  // Model Service berada di App\Models\Customer
use App\Models\User;             // Model User tetap di App\Models (untuk teknisi dan customer)
class PesananController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pesanan = Order::with(['teknisi', 'user', 'service'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('pages.admin.pesanan.index', compact('pesanan'));
    }

    /**
     * Menampilkan detail pesanan tertentu.
     *
     * @param  \App\Models\Customer\Order  $pesanan
     * @return \Illuminate\View\View
     */
    public function show(Order $pesanan)
    {
        // Memuat relasi agar data terkait bisa diakses di tampilan
        $pesanan->load(['teknisi', 'user', 'service']);
        return view('pages.admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Menampilkan form untuk mengedit pesanan.
     *
     * @param  \App\Models\Customer\Order  $pesanan
     * @return \Illuminate\View\View
     */
    public function edit(Order $pesanan)
    {
        // Memuat relasi
        $pesanan->load(['teknisi', 'user', 'service']);

        // Mengambil semua teknisi (mereka adalah User dengan role 'teknisi')
        $teknisis = User::where('role', 'teknisi')->get();

        // Mengambil semua customer (mereka adalah User dengan role 'customer')
        $customers = User::where('role', 'customer')->get();

        // Mengambil service yang aktif
        $services = Service::where('status', 'aktif')->get();

        return view('pages.admin.pesanan.edit', compact('pesanan', 'teknisis', 'customers', 'services'));
    }

    /**
     * Memperbarui pesanan di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Order  $pesanan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $pesanan)
    {
        // Validasi data yang masuk dari form
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'teknisi_id' => 'nullable|exists:users,id', // teknisi_id merujuk ke tabel users
            'service_id' => 'required|exists:services,id',
            'tanggal_pesanan' => 'required|date',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:tanggal_pesanan',
            'jam_service_diharapkan' => 'required|date_format:H:i:s', // Perbaiki format jam
            'alamat_service' => 'required|string|max:255', // Tambahkan max length
            'deskripsi_masalah' => 'nullable|string',
            'status_order' => 'required|in:pending,diterima,dalam_proses,selesai,dibatalkan',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Perbarui data pesanan
        $pesanan->update($request->all());

        // --- Logika Pembuatan/Pembaruan Tagihan ---
        // Jika status pesanan berubah menjadi 'selesai' atau 'dalam_proses',
        // buat atau perbarui entri di tabel payments.
        if ($pesanan->status_order === 'selesai' || $pesanan->status_order === 'dalam_proses') {
            // Cari apakah sudah ada pembayaran yang terkait dengan pesanan ini
            $payment = Payment::where('order_id', $pesanan->id)->first();

            if (!$payment) {
                // Jika belum ada pembayaran, buat entri pembayaran baru (ini adalah 'tagihan')
                Payment::create([
                    'order_id' => $pesanan->id,
                    'metode_pembayaran' => $request->input('metode_pembayaran', 'Cash'), // Default 'Cash' jika tidak ada input
                    'jumlah_bayar' => $pesanan->total_harga,
                    'status_pembayaran' => $request->input('status_pembayaran', 'pending'), // Default 'pending'
                    'tanggal_pembayaran' => now(), // Tanggal tagihan dibuat
                ]);
                $message = 'Status pesanan berhasil diperbarui & tagihan pembayaran berhasil dibuat.';
            } else {
                // Jika pembayaran sudah ada, Anda bisa memperbarui status atau detail lainnya
                // Beri opsi di form edit Admin untuk mengubah status pembayaran juga
                // $payment->status_pembayaran = $request->input('status_pembayaran', $payment->status_pembayaran);
                // $payment->save();
                $message = 'Status pesanan berhasil diperbarui.';
            }
        } else {
            $message = 'Pesanan berhasil diperbarui.';
        }

        return redirect()->route('admin.pesanan.show', $pesanan->id)
                         ->with('success', $message);
    }
}