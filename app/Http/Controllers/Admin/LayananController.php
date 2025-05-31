<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::paginate(10);
        return view('pages.admin.layanan.index', compact('layanans'));
    }

    public function show($id)
    {
        $layanan = Layanan::find($id);
        if (!$layanan) {
            abort(404, 'Layanan tidak ditemukan');
        }
        return view('pages.admin.layanan.show', compact('layanan'));
    }
}
