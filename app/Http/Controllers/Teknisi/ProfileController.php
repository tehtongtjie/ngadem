<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 

use App\Models\Teknisi\Teknisi; 
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil teknisi yang sedang login.
     * Menggunakan Route Model Binding untuk resolusi otomatis model Teknisi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Temukan profil teknisi berdasarkan user_id yang sedang login
        $teknisi = Teknisi::where('user_id', Auth::id())->first();

        // Jika profil teknisi tidak ditemukan, bisa diarahkan ke halaman pembuatan profil
        if (!$teknisi) {
            // Atau Anda bisa return view 'create' jika Anda punya form pembuatan profil
            // return view('pages.teknisi.profile.create');
            abort(404, 'Profil teknisi tidak ditemukan.');
        }

        // Tampilan ini diharapkan ada di 'resources/views/pages/teknisi/profile/index.blade.php',
        // dan akan menerima variabel $teknisi.
        return view('pages.teknisi.profile.index', compact('teknisi'));
    }

    /**
     * Menampilkan detail profil teknisi (seringkali sama dengan index untuk profil pribadi).
     * Metode ini mungkin tidak selalu dipanggil jika index() sudah mencakup semua.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return $this->index(); // Memanggil metode index() untuk menghindari duplikasi kode
    }


    /**
     * Menampilkan formulir untuk mengedit profil teknisi.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $teknisi = Teknisi::where('user_id', Auth::id())->first();

        if (!$teknisi) {
            abort(404, 'Profil teknisi tidak ditemukan.');
        }

        // Tampilan ini diharapkan ada di 'resources/views/pages/teknisi/profile/edit.blade.php',
        // dan akan menerima variabel $teknisi.
        return view('pages.teknisi.profile.edit', compact('teknisi'));
    }

    /**
     * Memperbarui data profil teknisi di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat'       => 'required|string',
            'no_hp'        => 'required|string|max:20', // Batasi panjang no_hp
            'keahlian'     => 'required|string|max:255',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maks 2MB
        ]);

        $teknisi = Teknisi::where('user_id', Auth::id())->first();

        if (!$teknisi) {
            abort(404, 'Profil teknisi tidak ditemukan.');
        }

        // Penanganan upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($teknisi->foto && Storage::disk('public')->exists('foto/' . $teknisi->foto)) {
                Storage::disk('public')->delete('foto/' . $teknisi->foto);
            }

            // Simpan foto baru
            $fileName = time() . '.' . $request->foto->extension();
            $request->file('foto')->storeAs('public/foto', $fileName); // Simpan ke public/foto
            $teknisi->foto = $fileName;
        }

        // Perbarui atribut teknisi
        $teknisi->nama_lengkap = $request->nama_lengkap;
        $teknisi->alamat       = $request->alamat;
        $teknisi->no_hp        = $request->no_hp;
        $teknisi->keahlian     = $request->keahlian;

        try {
            $teknisi->save();
            return redirect()->route('teknisi.profile.index')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating teknisi profile: ' . $e->getMessage(), ['user_id' => Auth::id(), 'request_data' => $request->all()]);
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Metode destroy tidak umum untuk profil teknisi (biasanya admin).
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        abort(403, 'Anda tidak diizinkan menghapus profil.');
    }
}