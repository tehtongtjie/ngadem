<?php

// app/Http/Controllers/Customer/ServiceController.php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Service;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar layanan yang tersedia.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::where('status', 'aktif')->get();
        return view('pages.customer.service.index', compact('services'));
    }

}