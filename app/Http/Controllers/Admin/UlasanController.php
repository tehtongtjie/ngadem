<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ulasan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UlasanController extends Controller
{
    // Tampilkan semua ulasan
    public function index()
    {
        $ulasan = Ulasan::with(['order', 'user', 'teknisi'])->paginate(10);
        return view('pages.admin.ulasan.index', compact('ulasan'));
    }

    public function show(Ulasan $ulasan) 
    {
        $ulasan->load(['order', 'user', 'teknisi']);
        return view('pages.admin.ulasan.show', compact('ulasan'));
    }

    public function destroy(Ulasan $ulasan) 
    {
        $ulasan->delete();
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}