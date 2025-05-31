<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Tampilkan daftar pembayaran
    public function index()
    {
        $pembayarans = Pembayaran::orderBy('tanggal_pembayaran', 'desc')->paginate(10);
        return view('pages.admin.pembayaran.index', compact('pembayarans'));
    }

    // Tampilkan form buat pembayaran baru
    public function create()
    {
        return view('pages.admin.pembayaran.create');
    }

    // Simpan data pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'metode_pembayaran' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:pending,berhasil,gagal',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'nullable|string|max:255',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    // Tampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    // Tampilkan form edit pembayaran
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    // Update data pembayaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'metode_pembayaran' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:pending,berhasil,gagal',
            'tanggal_pembayaran' => 'required|date',
            'bukti_pembayaran' => 'nullable|string|max:255',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    // Hapus pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
