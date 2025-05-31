@extends('layouts.app') {{-- Pastikan layout ini sudah mendukung Tailwind CSS --}}

@section('title', 'Detail Pesanan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Pesanan</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
                <h6 class="text-lg font-semibold text-gray-800">Informasi Pesanan</h6>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal border-collapse">
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    ID Pesanan</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pesanan->id }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Pelanggan</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pesanan->user->name ?? '-' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Teknisi</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pesanan->teknisi->name ?? '-' }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Layanan</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $pesanan->service->nama_layanan ?? '-' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Tanggal Pesanan</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y H:i') }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Tanggal Service Diharapkan</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($pesanan->tanggal_service_diharapkan)->format('d M Y') }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Jam Service Diharapkan</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pesanan->jam_service_diharapkan }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Alamat Service</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pesanan->alamat_service }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Deskripsi Masalah</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $pesanan->deskripsi_masalah ?? '-' }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Status Order</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ ucfirst($pesanan->status_order) }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Total Harga</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">Rp
                                    {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Dibuat Pada</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $pesanan->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Terakhir Diperbarui</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $pesanan->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-pencil mr-2">
                            <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                            <path d="m15 5 4 4" />
                        </svg>
                        Edit Pesanan
                    </a>
                    <a href="{{ route('admin.pesanan.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
