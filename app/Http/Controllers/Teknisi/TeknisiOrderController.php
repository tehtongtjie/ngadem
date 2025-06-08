<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Models\Teknisi\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeknisiOrderController extends Controller
{
    public function index()
    {
        // Menampilkan semua order
    }

    public function show($id)
    {
        // Detail order berdasarkan id
    }

    public function edit($id)
    {
        // Form edit order
    }

    public function update(Request $request, $id)
    {
        // Update order
    }

    public function destroy($id)
    {
        // Hapus order
    }

    // Custom methods sesuai route khusus
    public function completed()
    {
        // Tampilkan orders yang completed
    }

    public function assigned()
    {
        // Tampilkan orders yang assigned
    }

    public function pending()
    {
        // Tampilkan orders yang pending
    }

    public function declined()
    {
        // Tampilkan orders yang declined
    }

    public function history()
    {
        // Tampilkan riwayat orders
    }
}
