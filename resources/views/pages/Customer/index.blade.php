@extends('layouts.customer.app')

@section('title', 'Dashboard Customer')

@section('content')
    <div id="header-spacer" class="h-16 md:h-20 lg:h-24"></div>

    <main class="container mx-auto px-4 py-10 lg:py-16">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-8 text-center drop-shadow-lg leading-tight">
            Selamat Datang, <span class="text-yellow-600">{{ $userName }}!</span>
        </h1>
        <p class="text-center text-lg text-gray-700 mb-12 max-w-2xl mx-auto">
            Siap menikmati kenyamanan maksimal? Kelola semua pesanan AC Anda, jelajahi layanan terbaru, dan cek informasi
            akun dengan mudah, semua ada di genggaman Anda.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <section class="glass-effect rounded-3xl p-6 shadow-lg transform hover:scale-105 duration-300 col-span-2"
                data-aos="fade-right" data-aos-delay="100">
                <h2 class="text-2xl font-bold mb-4 text-yellow-600 flex items-center">
                    <i class="fas fa-clipboard-list mr-3 text-yellow-500"></i> Status Pesanan Terbaru
                </h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-gray-900">
                        <thead>
                            <tr class="border-b-2 border-yellow-400">
                                <th class="py-2 px-1 text-sm font-semibold">No.</th>
                                <th class="py-2 px-1 text-sm font-semibold">Layanan</th>
                                <th class="py-2 px-1 text-sm font-semibold">Tanggal</th>
                                <th class="py-2 px-1 text-sm font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestOrders as $key => $order)
                                <tr class="border-b border-yellow-200 hover:bg-yellow-50 transition-colors">
                                    <td class="py-2 px-1 text-sm">{{ $key + 1 }}</td>
                                    <td class="py-2 px-1 text-sm">
                                        {{ $order->service->nama_layanan ?? 'Layanan tidak ditemukan' }}</td>
                                    <td class="py-2 px-1 text-sm">
                                        {{ \Carbon\Carbon::parse($order->tanggal_service_diharapkan)->isoFormat('D MMMM BBBB') }}
                                    </td>
                                    <td class="py-2 px-1 text-sm">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if ($order->status_order === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif ($order->status_order === 'diterima') bg-blue-100 text-blue-800
                                            @elseif ($order->status_order === 'dalam_proses') bg-purple-100 text-purple-800
                                            @elseif ($order->status_order === 'selesai') bg-green-100 text-green-800
                                            @elseif ($order->status_order === 'dibatalkan') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-600">Anda belum memiliki pesanan
                                        terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('customer.orders.index') }}"
                    class="mt-5 inline-flex items-center text-yellow-600 font-semibold hover:underline group">
                    Lihat Semua Pesanan
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </section>

            <section
                class="glass-effect rounded-3xl p-6 shadow-lg flex flex-col justify-center items-center transform hover:scale-105 duration-300 col-span-2"
                data-aos="fade-up" data-aos-delay="200">
                <h2 class="text-2xl font-bold mb-6 text-yellow-600 flex items-center">
                    <i class="fas fa-bolt mr-3 text-yellow-500"></i> Aksi Cepat
                </h2>
                <div class="flex flex-col space-y-4 w-full max-w-xs">
                    <a href="{{ route('customer.orders.create') }}"
                        class="action-button bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-full shadow-lg text-center transition-all duration-300 flex items-center justify-center transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-3"></i> Pesan Layanan Baru
                    </a>
                    <a href="{{ route('customer.payments.index') }}"
                        class="action-button bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-full shadow-lg text-center transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-money-bill-wave mr-3"></i> Bayar Tagihan
                    </a>
                    <a href="{{ route('customer.orders.index') }}"
                        class="action-button bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-full shadow-lg text-center transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-history mr-3"></i> Riwayat Pesanan
                    </a>
                </div>
            </section>

            <section
                class="glass-effect rounded-3xl p-6 shadow-lg transform hover:scale-105 duration-300 col-span-2 md:col-span-1 lg:col-span-2"
                data-aos="fade-up" data-aos-delay="300">
                <h2 class="text-2xl font-bold mb-4 text-yellow-600 flex items-center">
                    <i class="fas fa-lightbulb mr-3 text-yellow-500"></i> Tips Perawatan AC
                </h2>
                <ul class="list-none text-gray-800 space-y-3">
                    <li>
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <strong>Bersihkan Filter AC Rutin:</strong> Periksa dan bersihkan filter AC Anda setiap 2-4 minggu.
                        Filter yang bersih menjaga kualitas udara dan efisiensi AC.
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <strong>Periksa Unit Outdoor:</strong> Pastikan unit outdoor bebas dari kotoran, daun, atau halangan
                        lain yang bisa mengganggu aliran udara.
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <strong>Atur Suhu Ideal:</strong> Hindari menyetel suhu terlalu rendah (ideal 24-26°C) untuk
                        menghemat energi dan menjaga komponen AC.
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <strong>Gunakan Mode Timer:</strong> Manfaatkan fitur timer untuk mematikan AC secara otomatis saat
                        Anda tidak di ruangan atau saat tidur.
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <strong>Perhatikan Tanda Kebocoran:</strong> Jika melihat tetesan air atau es pada unit
                        indoor/outdoor, segera hubungi teknisi untuk menghindari kerusakan lebih lanjut.
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        <strong>Jadwalkan Servis Berkala:</strong> Lakukan pembersihan dan pemeriksaan AC secara profesional
                        minimal 3-6 bulan sekali untuk performa optimal dan umur panjang AC.
                    </li>
                </ul>
            </section>


            <section
                class="glass-effect rounded-3xl p-6 shadow-lg transform hover:scale-105 duration-300 col-span-2 md:col-span-1 lg:col-span-2"
                data-aos="fade-up" data-aos-delay="400">
                <h2 class="text-2xl font-bold mb-4 text-yellow-600 flex items-center">
                    <i class="fas fa-handshake mr-3 text-yellow-500"></i>
                    Mengapa Memilih Ngadem?
                </h2>
                <p class="text-gray-800 leading-relaxed">
                    Di Ngadem, kami hadir sebagai <strong>solusi #1 Anda untuk AC dingin dan nyaman</strong>! 🌬️ Tim
                    teknisi kami yang <strong>berpengalaman & bersertifikasi</strong> siap memberikan layanan perawatan dan
                    perbaikan terbaik, langsung di rumah atau kantor Anda. Kami berkomitmen penuh untuk menghadirkan
                    <strong>kesejukan sejati</strong> dengan cepat dan profesional. ✨ Percayakan kenyamanan AC Anda kepada
                    Ngadem!
                </p>
            </section>


        </div>
    </main>
@endsection
