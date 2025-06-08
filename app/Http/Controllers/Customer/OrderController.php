<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use App\Models\Customer\Service;
use App\Models\Customer\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan untuk pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil pesanan-pesanan milik pengguna yang sedang login
        $orders = Order::where('user_id', Auth::id())->paginate(10);

        // Kirimkan data pesanan ke tampilan
        return view('pages.customer.orders.index', compact('orders'));
    }

    /**
     * Menampilkan form pemesanan layanan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Layanan yang aktif
        $services = Service::where('status', 'aktif')->get();
        $selectedServiceId = $request->query('service_id');

        // Pilihan metode pembayaran
        $metodePembayaranOptions = [
            'Cash',
            'Transfer Bank',
            'QRIS',
        ];

        // Kirimkan data ke tampilan
        return view('pages.customer.orders.create', compact('services', 'selectedServiceId', 'metodePembayaranOptions'));
    }

    /**
     * Simpan pesanan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:today',
            'jam_service_diharapkan' => 'required|date_format:H:i',
            'alamat_service' => 'required|string|max:255',
            'deskripsi_masalah' => 'nullable|string',
            'metode_pembayaran' => 'required|string|max:255',
        ]);

        // Ambil informasi layanan
        $service = Service::find($request->service_id);
        $totalHarga = $service ? $service->harga_dasar : 0.00;

        // Simpan pesanan baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'tanggal_pesanan' => now(),
            'tanggal_service_diharapkan' => $request->tanggal_service_diharapkan,
            'jam_service_diharapkan' => $request->jam_service_diharapkan,
            'alamat_service' => $request->alamat_service,
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'status_order' => 'pending',
            'total_harga' => $totalHarga,
        ]);

        // Buat entri pembayaran untuk pesanan
        Payment::create([
            'order_id' => $order->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $totalHarga,
            'status_pembayaran' => 'pending',
            'tanggal_pembayaran' => now(),
        ]);

        // Redirect ke daftar pesanan
        return redirect()->route('customer.orders.index')->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    /**
     * Menampilkan detail pesanan.
     *
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        // Pastikan pesanan yang diakses milik pengguna yang sedang login
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Kirimkan data pesanan ke tampilan
        return view('pages.customer.orders.show', compact('order'));
    }

    /**
     * Menampilkan form untuk mengedit pesanan.
     *
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\View\View
     */
    public function edit(Order $order)
    {
        // Pastikan pesanan yang akan diedit milik pengguna yang sedang login
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Layanan yang aktif
        $services = Service::where('status', 'aktif')->get();

        // Kirimkan data pesanan dan layanan ke tampilan
        return view('pages.customer.orders.edit', compact('order', 'services'));
    }

    /**
     * Perbarui pesanan di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_service_diharapkan' => 'required|date|after_or_equal:today',
            'jam_service_diharapkan' => 'required|date_format:H:i',
            'alamat_service' => 'required|string|max:255',
            'deskripsi_masalah' => 'nullable|string',
        ]);

        // Pastikan pesanan yang akan diupdate milik pengguna yang sedang login
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses untuk memperbarui pesanan ini.');
        }

        // Update pesanan
        $order->update([
            'service_id' => $request->service_id,
            'tanggal_service_diharapkan' => $request->tanggal_service_diharapkan,
            'jam_service_diharapkan' => $request->jam_service_diharapkan,
            'alamat_service' => $request->alamat_service,
            'deskripsi_masalah' => $request->deskripsi_masalah,
        ]);

        // Redirect kembali ke halaman detail pesanan dengan pesan sukses
        return redirect()->route('customer.orders.show', $order->id)->with('success', 'Pesanan Anda berhasil diperbarui!');
    }

    /**
     * Hapus pesanan dari database.
     *
     * @param  \App\Models\Customer\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order)
    {
        // Pastikan pesanan yang akan dihapus milik pengguna yang sedang login
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.orders.index')->with('error', 'Anda tidak memiliki akses untuk menghapus pesanan ini.');
        }

        // Hapus pesanan
        $order->delete();

        // Redirect ke daftar pesanan dengan pesan sukses
        return redirect()->route('customer.orders.index')->with('success', 'Pesanan Anda berhasil dihapus!');
    }
}
