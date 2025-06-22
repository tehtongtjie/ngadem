@extends('layouts.customer.app')

@section('title', 'Layanan Kami - Ngadem')

@section('content')
    {{-- ========================== HEADER SPACER ========================== --}}
    <div id="header-spacer"></div>

    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="container mx-auto px-4 py-10 md:py-12 lg:py-16">

        {{-- ---------- PAGE HEADER ---------- --}}
        <header class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-800">Layanan AC Profesional Kami</h1>
            <p class="mt-2 text-white/90 drop-shadow-600 max-w-3xl mx-auto text-sm md:text-base">
                Pilih layanan terbaik untuk menjaga kenyamanan ruangan Anda. Kami siap memberikan solusi cepat dan
                berkualitas!
            </p>
        </header>

        {{-- ---------- CONDITIONAL SECTION: JIKA TIDAK ADA LAYANAN ---------- --}}
        @if ($services->isEmpty())
            {{-- EMPTY STATE --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-6 md:p-8 rounded-xl shadow-lg max-w-2xl mx-auto text-center"
                role="alert">
                <i class="fas fa-info-circle text-4xl text-blue-500 mb-4"></i>
                <p class="font-semibold text-lg mb-2">Layanan Belum Tersedia!</p>
                <p class="text-gray-600">Saat ini belum ada layanan aktif. Hubungi kami untuk informasi lebih lanjut.</p>
                <a href="{{ route('customer.dashboard') }}"
                    class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full
                          hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
            </div>
        @else
        
            {{-- ---------- SERVICES LIST (GRID) ---------- --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="services-grid">
                @foreach ($services as $service)
                    {{-- SINGLE SERVICE CARD --}}
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden
                                hover:shadow-lg hover:-translate-y-1 transition-all duration-300 ease-in-out"
                        data-name="{{ strtolower($service->nama_layanan) }}" data-price="{{ $service->harga_dasar }}">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h2 class="text-xl font-semibold text-gray-800">{{ $service->nama_layanan }}</h2>
                                <i class="fas fa-tools text-yellow-500 text-2xl"></i>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $service->deskripsi }}</p>
                            <div class="mb-4">
                                <span class="text-yellow-600 font-bold text-2xl">
                                    Rp{{ number_format($service->harga_dasar, 0, ',', '.') }}
                                </span>
                                <span class="text-gray-500 text-xs">/ layanan</span>
                            </div>
                            <a href="{{ route('customer.orders.create', ['service_id' => $service->id]) }}"
                                class="block w-full bg-yellow-500 text-white text-center font-semibold py-3 rounded-lg
                                      hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300
                                      transition duration-300 ease-in-out transform hover:scale-105">
                                <i class="fas fa-cart-plus mr-2"></i> Pesan Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
@endsection

{{-- ========================== SCRIPTS SECTION (optional) ========================== --}}
@push('scripts')
@endpush
