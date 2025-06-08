@extends('layouts.customer.app')

@section('title', 'Layanan Kami - Ngadem')

@section('content')
    {{-- Spacer untuk memberikan jarak dari navbar yang mungkin fixed atau sticky --}}
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-10 lg:py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 text-center drop-shadow-lg leading-tight">
            Pilih Layanan AC Terbaik untuk Anda
        </h1>
        <p class="text-center text-lg text-gray-700 mb-12 max-w-3xl mx-auto">
            Kami menawarkan berbagai layanan AC profesional untuk menjaga kenyamanan ruangan Anda. Pilih layanan yang sesuai
            dengan kebutuhan Anda dan kami akan segera mengurusnya!
        </p>

        @if ($services->isEmpty())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 rounded-lg shadow-md max-w-2xl mx-auto"
                role="alert">
                <p class="font-bold text-lg mb-2">Layanan belum tersedia!</p>
                <p>Maaf, saat ini belum ada layanan yang aktif. Silakan kembali lagi nanti atau hubungi kami untuk informasi
                    lebih lanjut.</p>
                <a href="{{ route('customer.dashboard') }}"
                    class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                    Kembali ke Dashboard
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Looping untuk menampilkan setiap layanan dalam bentuk card --}}
                @foreach ($services as $service)
                    <div
                        class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden
                                hover:shadow-xl hover:-translate-y-2 transition-all duration-300 ease-in-out">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $service->nama_layanan }}</h2>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $service->deskripsi }}</p>

                            <div class="flex items-baseline justify-between mb-6">
                                <span class="text-yellow-600 font-extrabold text-3xl">
                                    Rp{{ number_format($service->harga_dasar, 0, ',', '.') }}
                                </span>
                                {{-- Anda bisa tambahkan detail lain di sini, misalnya ikon --}}
                                <i class="fas fa-tools text-gray-400 text-3xl"></i> {{-- Contoh ikon --}}
                            </div>

                            <a href="{{ route('customer.orders.create', ['service_id' => $service->id]) }}"
                                class="block w-full bg-yellow-500 text-white text-center font-semibold py-3 px-6 rounded-lg
                                  hover:bg-yellow-600 focus:outline-none focus:ring-4 focus:ring-yellow-300
                                    transition duration-300 ease-in-out transform hover:scale-105">
                                Pesan Layanan Ini
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif {{-- End of @if ($services->isEmpty()) --}}
    </main>
@endsection
