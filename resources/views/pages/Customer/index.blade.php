@extends('layouts.customer.app')

@section('title', 'Dashboard Pelanggan')

@section('styles')
    {{-- AOS & FontAwesome --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Tailwind CSS CDN for rapid styling (replace with local in production) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom Styling for Glassmorphism and Scrollbar --}}
    <style>

    </style>
@endsection

@section('content')
    {{-- Header Spacer --}}
    <div id="header-spacer"></div>

    {{-- Hero Section --}}
    <section class="relative h-screen flex items-center justify-center bg-cover bg-center overflow-hidden"
        style="background-image: url('{{ asset('img/foto5.jpg') }}');" data-aos="fade-in" data-aos-duration="1000">

        {{-- Overlay gradasi hitam --}}
        <div class="absolute inset-0 bg-gradient-to-br from-black/80 to-black/60"></div>

        <div class="relative z-10 text-center text-white p-6 md:p-10 rounded-3xl bg-black/30 backdrop-blur-lg border border-white/30 shadow-2xl max-w-4xl mx-4"
            data-aos="zoom-in" data-aos-delay="400" data-aos-duration="800" role="banner">

            <h1 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight drop-shadow-lg">
                Selamat Datang, <span class="text-yellow-300">{{ $userName ?? 'Pelanggan Setia' }}</span>!
            </h1>

            <p class="text-base md:text-lg max-w-2xl mx-auto mb-8 font-light">
                Kami menyediakan layanan <strong class="font-semibold">perawatan dan perbaikan AC</strong> terbaik dengan
                <strong class="font-semibold">teknisi ahli</strong> dan
                <strong class="font-semibold">kepercayaan pelanggan</strong> sebagai prioritas.
            </p>

            <a href="{{ route('customer.service.index') }}"
                class="inline-flex items-center bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition-all duration-300 pulse"
                aria-label="Jelajahi layanan perawatan AC">
                <i class="fas fa-hammer mr-2"></i> Jelajahi Layanan
            </a>
        </div>
    </section>


    {{-- Main Content Area --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 min-h-[600px] auto-rows-fr">
            {{-- Pesanan Terbaru (Latest Orders) --}}
            <section class="glass-effect rounded-3xl p-6 xl:col-span-2 xl:row-span-3" data-aos="fade-right"
                data-aos-delay="100" data-aos-duration="800" role="region" aria-labelledby="latest-orders">
                <h2 id="latest-orders"
                    class="text-2xl md:text-3xl font-extrabold mb-4 text-orange-700 flex items-center border-b border-yellow-400 pb-3">
                    <i class="fas fa-clipboard-list mr-3 text-yellow-500"></i> Status Pesanan Terbaru
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-white bg-gray-800">
                        <thead>
                            <tr class="border-b-2 border-yellow-400 bg-yellow-50">
                                <th class="py-2 px-4 text-left font-bold text-orange-800">No.</th>
                                <th class="py-2 px-4 text-left font-bold text-orange-800">Layanan</th>
                                <th class="py-2 px-4 text-left font-bold text-orange-800">Tanggal</th>
                                <th class="py-2 px-4 text-left font-bold text-orange-800">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestOrders as $key => $order)
                                @php
                                    $badgeMap = [
                                        'pending' => 'bg-orange-100 text-orange-800',
                                        'diterima' => 'bg-yellow-100 text-yellow-800',
                                        'dalam_proses' => 'bg-purple-100 text-purple-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusText = ucfirst(str_replace('_', ' ', $order->status_order));
                                    $badgeClass = $badgeMap[$order->status_order] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <tr class="border-b border-yellow-200 hover:bg-white hover:bg-opacity-50 transition-colors">
                                    <td class="py-2 px-4">{{ $key + 1 }}</td>
                                    <td class="py-2 px-4">{{ $order->service->nama_layanan ?? 'Layanan tidak ditemukan' }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM BBBB') }}
                                    </td>
                                    <td class="py-2 px-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-600 italic">
                                        Belum ada pesanan. <br>
                                        <a href="{{ route('customer.orders.create') }}"
                                            class="text-orange-500 hover:underline font-medium mt-2 inline-block">
                                            Pesan layanan sekarang!
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <p class="text-gray-700 text-sm mt-4">
                    Pantau status pesanan Anda untuk update terkini. Kami akan memberi notifikasi untuk setiap perubahan
                    penting.
                </p>
                <a href="{{ route('customer.orders.index') }}"
                    class="inline-flex items-center text-orange-600 font-semibold hover:underline mt-4 group"
                    aria-label="Lihat semua pesanan">
                    Lihat Semua Pesanan
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                </a>
            </section>

            {{-- Aksi Cepat (Quick Actions) --}}
            <section class="glass-effect rounded-3xl p-6 flex flex-col items-center xl:col-span-3 xl:row-span-3"
                data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" role="region"
                aria-labelledby="quick-actions">
                <h2 id="quick-actions"
                    class="text-2xl md:text-3xl font-extrabold mb-4 text-orange-700 border-b border-yellow-400 pb-3 w-full text-center">
                    <i class="fas fa-bolt mr-2 text-yellow-500"></i> Aksi Cepat
                </h2>
                <div class="flex flex-col space-y-3 w-full max-w-sm">
                    <a href="{{ route('customer.orders.create') }}"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-full shadow-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-200"
                        aria-label="Pesan layanan baru">
                        <i class="fas fa-plus-circle mr-2"></i> Pesan Layanan Baru
                    </a>
                    <a href="{{ route('customer.payments.index') }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-6 rounded-full shadow-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-200"
                        aria-label="Bayar tagihan">
                        <i class="fas fa-money-bill-wave mr-2"></i> Bayar Tagihan
                    </a>
                    <a href="{{ route('customer.profile.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-full shadow-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-200"
                        aria-label="Kelola profil">
                        <i class="fas fa-user-circle mr-2"></i> Kelola Profil
                    </a>
                </div>
                <p class="w-full text-sm text-white mt-6 text-center">
                    Akses layanan penting dengan cepat untuk pengalaman yang lebih mudah dan efisien.
                </p>
            </section>

            {{-- Tips Perawatan AC (AC Maintenance Tips) --}}
            <section class="glass-effect rounded-3xl p-6 xl:col-span-3 xl:row-span-2 xl:col-start-1 xl:row-start-4"
                data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" role="region"
                aria-labelledby="maintenance-tips">
                <h2 id="maintenance-tips"
                    class="text-2xl md:text-3xl font-extrabold mb-4 text-orange-700 flex items-center border-b border-yellow-400 pb-3">
                    <i class="fas fa-lightbulb mr-3 text-yellow-500"></i> Tips Perawatan AC
                </h2>
                <ul class="space-y-3 text-white text-800 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                        <span><strong>Bersihkan Filter:</strong> Cuci filter setiap 2-4 minggu untuk efisiensi dan udara
                            bersih.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-fan text-blue-500 mt-1 mr-2 flex-shrink-0"></i>
                        <span><strong>Unit Outdoor:</strong> Pastikan bebas dari kotoran atau penghalang.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-thermometer-half text-red-500 mt-1 mr-2 flex-shrink-0"></i>
                        <span><strong>Suhu Ideal:</strong> Atur 24-26°C untuk hemat energi.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-clock text-purple-500 mt-1 mr-2 flex-shrink-0"></i>
                        <span><strong>Mode Timer:</strong> Gunakan timer untuk efisiensi saat tidur.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-tint text-cyan-500 mt-1 mr-2 flex-shrink-0"></i>
                        <span><strong>Tanda Kebocoran:</strong> Hubungi teknisi jika ada tetesan air atau bau aneh.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-calendar-check text-indigo-500 mt-1 mr-2 flex-shrink-0"></i>
                        <span><strong>Servis Berkala:</strong> Lakukan servis setiap 3-6 bulan.</span>
                    </li>
                </ul>
            </section>

            {{-- Mengapa Memilih Kami (Why Choose Us) --}}
            <section
                class="glass-effect rounded-3xl p-6 flex flex-col xl:col-span-2 xl:row-span-2 xl:col-start-4 xl:row-start-4"
                data-aos="fade-up" data-aos-delay="400" data-aos-duration="800" role="region"
                aria-labelledby="why-choose-us">
                <h2 id="why-choose-us"
                    class="text-2xl md:text-3xl font-extrabold mb-4 text-orange-700 flex items-center border-b border-yellow-400 pb-3 text-center w-full">
                    <i class="fas fa-star mr-3 text-yellow-500"></i> Mengapa Memilih Kami?
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div
                        class="bg-yellow-50/50 rounded-lg p-4 flex flex-col items-center transform hover:scale-105 transition-transform duration-200">
                        <i class="fas fa-certificate text-orange-600 text-3xl mb-2"></i>
                        <h3 class="font-bold text-lg text-orange-800 mb-1">Teknisi Tersertifikasi</h3>
                        <p class="text-gray-800 text-sm text-center">
                            Tim ahli tersertifikasi untuk layanan berkualitas tinggi.
                        </p>
                    </div>
                    <div
                        class="bg-yellow-50/50 rounded-lg p-4 flex flex-col items-center transform hover:scale-105 transition-transform duration-200">
                        <i class="fas fa-rocket text-orange-600 text-3xl mb-2"></i>
                        <h3 class="font-bold text-lg text-orange-800 mb-1">Layanan Cepat</h3>
                        <p class="text-gray-800 text-sm text-center">
                            Penyelesaian masalah yang efisien dan responsif.
                        </p>
                    </div>
                    <div
                        class="bg-yellow-50/50 rounded-lg p-4 flex flex-col items-center sm:col-span-2 transform hover:scale-105 transition-transform duration-200">
                        <i class="fas fa-hand-holding-heart text-orange-600 text-3xl mb-2"></i>
                        <h3 class="font-bold text-lg text-orange-800 mb-1">Kepuasan Pelanggan</h3>
                        <p class="text-gray-800 text-sm text-center">
                            Komitmen untuk kenyamanan dan kepuasan Anda.
                        </p>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mt-4 text-center">
                    Kami memastikan AC Anda optimal dengan pelayanan terbaik.
                </p>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
    {{-- AOS Library --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-quart',
            once: true,
            offset: 100
        });

        document.addEventListener("DOMContentLoaded", () => {
            const headerSpacer = document.getElementById("header-spacer");
            const header = document.querySelector(".navbar");

            if (headerSpacer && header) {
                const updateSpacerHeight = () => {
                    headerSpacer.style.height = `${header.offsetHeight}px`;
                };
                updateSpacerHeight();
                window.addEventListener('resize', updateSpacerHeight);
            }
        });
    </script>
@endsection
