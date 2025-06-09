<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.customer.profile.index', compact('user'));
    }

    /**
     * Menampilkan formulir untuk mengedit profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.customer.profile.edit', compact('user'));
    }

    /**
     * Memperbarui data profil pengguna di penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20', // Tambahkan validasi untuk nomor telepon
            'address' => 'nullable|string|max:255', // Tambahkan validasi untuk alamat

            // Validasi password hanya jika diisi
            'current_password' => 'nullable|required_with:password|current_password', // Pastikan password lama benar
            'password' => 'nullable|min:8|confirmed', // Password baru
        ]);

        // Perbarui atribut user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;   // Pastikan kolom 'phone' ada di tabel 'users'
        $user->address = $request->address; // Pastikan kolom 'address' ada di tabel 'users'

        // Perbarui password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('customer.profile.index')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating customer profile: ' . $e->getMessage(), ['user_id' => $user->id, 'request_data' => $request->all()]);
            return redirect()->back()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage())->withInput();
        }
    }
}