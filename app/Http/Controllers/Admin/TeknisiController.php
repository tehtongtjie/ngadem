<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Teknisi;
use App\Models\Admin\TeknisiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisi = Teknisi::with('detail')->get();
        return view('pages.admin.teknisi.index', compact('teknisi'));
    }

    public function create()
    {
        return view('pages.admin.teknisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|string|min:6|confirmed',
            'area_layanan'      => 'nullable|string|max:255',
            'spesialisasi'      => 'nullable|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $teknisi = Teknisi::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'teknisi',
            ]);

            TeknisiDetail::create([
                'user_id'           => $teknisi->id,
                'area_layanan'      => $request->area_layanan,
                'spesialisasi'      => $request->spesialisasi,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'rating'            => 0.0,
                'jumlah_ulasan'     => 0,
            ]);

            DB::commit();

            return redirect()->route('admin.teknisi.index')->with('success', 'Teknisi baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal menyimpan data teknisi: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * 
     *
     * @param  \App\Models\Admin\Teknisi
     * @return \Illuminate\View\View
     */
    public function show(Teknisi $teknisi)
    {
        $teknisi->load('detail');
        return view('pages.admin.teknisi.show', compact('teknisi'));
    }

    public function edit(Teknisi $teknisi)
    {
        $teknisi->load('detail');
        return view('pages.admin.teknisi.edit', compact('teknisi'));
    }

    public function update(Request $request, Teknisi $teknisi)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => [
                'required',
                'email',
                Rule::unique('users')->ignore($teknisi->id),
            ],
            'password'          => 'nullable|string|min:6|confirmed',
            'area_layanan'      => 'nullable|string|max:255',
            'spesialisasi'      => 'nullable|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'name'  => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $teknisi->update($data);

            $detail = $teknisi->detail;
            if ($detail) {
                $detail->update([
                    'area_layanan'      => $request->area_layanan,
                    'spesialisasi'      => $request->spesialisasi,
                    'deskripsi_singkat' => $request->deskripsi_singkat,
                ]);
            } else {
                TeknisiDetail::create([
                    'user_id'           => $teknisi->id,
                    'area_layanan'      => $request->area_layanan,
                    'spesialisasi'      => $request->spesialisasi,
                    'deskripsi_singkat' => $request->deskripsi_singkat,
                    'rating'            => 0.0,
                    'jumlah_ulasan'     => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.teknisi.index')->with('success', 'Data teknisi berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal mengupdate data teknisi: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Teknisi $teknisi)
    {
        DB::beginTransaction();

        try {
            if ($teknisi->detail) {
                $teknisi->detail->delete();
            }

            $teknisi->delete();

            DB::commit();

            return redirect()->route('admin.teknisi.index')->with('success', 'Teknisi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal menghapus teknisi: ' . $e->getMessage()]);
        }
    }
}
