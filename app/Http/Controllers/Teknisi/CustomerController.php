<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Models\Teknisi\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Tampilkan semua customer
    }

    public function show($id)
    {
        // Detail customer
    }

    public function edit($id)
    {
        // Form edit customer
    }

    public function update(Request $request, $id)
    {
        // Update customer
    }

    public function destroy($id)
    {
        // Hapus customer
    }
}
