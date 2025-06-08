<!-- resources/views/pages/customer/orders/create.blade.php -->

@extends('layouts.customer.app')

@section('title', 'Pesan Layanan Baru')

@section('content')
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="flex-grow py-10 lg:py-16" data-aos="fade-up" data-aos-duration="800">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-8 text-center drop-shadow-lg leading-tight">
            Pesan Layanan Baru
        </h1>

        <form method="POST" action="{{ route('customer.orders.store') }}">
            @csrf
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="service_id" class="block text-gray-700 font-semibold">Layanan</label>
                    <select name="service_id" id="service_id" class="w-full px-4 py-2 border rounded-lg mt-2" required>
                        <option value="">Pilih Layanan</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tanggal_service_diharapkan" class="block text-gray-700 font-semibold">Tanggal
                        Layanan</label>
                    <input type="date" name="tanggal_service_diharapkan" id="tanggal_service_diharapkan"
                        class="w-full px-4 py-2 border rounded-lg mt-2" required>
                </div>
                <div class="mb-4">
                    <label for="jam_service_diharapkan" class="block text-gray-700 font-semibold">Jam Layanan</label>
                    <input type="time" name="jam_service_diharapkan" id="jam_service_diharapkan"
                        class="w-full px-4 py-2 border rounded-lg mt-2" required>
                </div>
                <div class="mb-4">
                    <label for="alamat_service" class="block text-gray-700 font-semibold">Alamat Layanan</label>
                    <input type="text" name="alamat_service" id="alamat_service"
                        class="w-full px-4 py-2 border rounded-lg mt-2" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_masalah" class="block text-gray-700 font-semibold">Deskripsi Masalah
                        (Opsional)</label>
                    <textarea name="deskripsi_masalah" id="deskripsi_masalah" class="w-full px-4 py-2 border rounded-lg mt-2"
                        rows="4"></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-yellow-500 text-white font-semibold py-3 rounded-lg mt-4 hover:bg-yellow-600">
                    Buat Pesanan
                </button>
            </div>
        </form>
    </main>
@endsection
