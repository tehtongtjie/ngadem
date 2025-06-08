<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Models\Teknisi\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeknisiServiceController extends Controller
{
    public function index()
    {
        // Tampilkan semua service
    }

    public function show($id)
    {
        // Detail service
    }

    public function edit($id)
    {
        // Form edit service
    }

    public function update(Request $request, $id)
    {
        // Update service
    }

    public function destroy($id)
    {
        // Hapus service
    }
}
