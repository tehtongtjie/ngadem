<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer\Service;

class LayananController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $layanans = Service::paginate(10);
        return view('pages.admin.layanan.index', compact('layanans'));
    }

    /**
     *
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.layanan.create');
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255|unique:services,nama_layanan',
            'deskripsi' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
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
     *
     *
     *
     * @param  \App\Models\Customer\Service  
     * @return \Illuminate\View\View
     */
    public function show(Service $layanan)
    {
        return view('pages.admin.layanan.show', compact('layanan'));
    }

    /**
     *
     *
     *
     * @param  \App\Models\Customer\Service 
     * @return \Illuminate\View\View
     */
    public function edit(Service $layanan)
    {
        return view('pages.admin.layanan.edit', compact('layanan'));
    }

    /**
     *
     *
     *
     * @param  \Illuminate\Http\Request
     * @param  \App\Models\Customer\Service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Service $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255|unique:services,nama_layanan,' . $layanan->id,
            'deskripsi' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $path = $layanan->gambar_layanan;

        try {
            $layanan->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'harga_dasar' => $request->harga_dasar,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.layanan.show', $layanan->id)
                ->with('success', 'Layanan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating layanan: ' . $e->getMessage(), ['layanan_id' => $layanan->id, 'request_data' => $request->all()]);
            return redirect()->back()->with('error', 'Gagal memperbarui layanan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     *
     *
     *
     * @param  \App\Models\Customer\Service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $layanan)
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
