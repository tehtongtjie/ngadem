<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer\Service;

class LayananController extends Controller
{
    /**
     * Menampilkan daftar semua layanan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $layanans = Service::paginate(10); // Menggunakan Service::
        return view('pages.admin.layanan.index', compact('layanans'));
    }

    /**
     * Menampilkan formulir untuk membuat layanan baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.layanan.create');
    }

    /**
     * Menyimpan layanan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255|unique:services,nama_layanan', // Validasi unik
            'deskripsi' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
            // Tambahkan validasi untuk gambar/file jika ada 'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        Service::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'harga_dasar' => $request->harga_dasar,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail layanan tertentu.
     * Menggunakan Route Model Binding untuk resolusi otomatis model Service.
     *
     * @param  \App\Models\Customer\Service  $layanan
     * @return \Illuminate\View\View
     */
    public function show(Service $layanan) // Menggunakan Route Model Binding
    {
        return view('pages.admin.layanan.show', compact('layanan'));
    }

    /**
     * Menampilkan formulir untuk mengedit layanan.
     * Menggunakan Route Model Binding.
     *
     * @param  \App\Models\Customer\Service  $layanan
     * @return \Illuminate\View\View
     */
    public function edit(Service $layanan) // Menggunakan Route Model Binding
    {
        return view('pages.admin.layanan.edit', compact('layanan'));
    }

    /**
     * Memperbarui data layanan di penyimpanan.
     * Menggunakan Route Model Binding.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Service  $layanan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Service $layanan) // Menggunakan Route Model Binding
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255|unique:services,nama_layanan,' . $layanan->id, // Validasi unik, kecuali ID sendiri
            'deskripsi' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
            // Tambahkan validasi untuk gambar/file jika ada 'gambar_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $layanan->gambar_layanan; // Ambil path lama jika ada

        try {
            $layanan->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'harga_dasar' => $request->harga_dasar,
                'status' => $request->status,
                // 'gambar_layanan' => $path,
            ]);

            return redirect()->route('admin.layanan.show', $layanan->id)
                             ->with('success', 'Layanan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating layanan: ' . $e->getMessage(), ['layanan_id' => $layanan->id, 'request_data' => $request->all()]);
            return redirect()->back()->with('error', 'Gagal memperbarui layanan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menghapus layanan dari penyimpanan.
     * Menggunakan Route Model Binding.
     *
     * @param  \App\Models\Customer\Service  $layanan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $layanan) // Menggunakan Route Model Binding
    {

        try {
            $layanan->delete();
            return redirect()->route('admin.layanan.index')
                             ->with('success', 'Layanan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting layanan: ' . $e->getMessage(), ['layanan_id' => $layanan->id]);
            return redirect()->back()->with('error', 'Gagal menghapus layanan: ' . $e->getMessage());
        }
    }
}