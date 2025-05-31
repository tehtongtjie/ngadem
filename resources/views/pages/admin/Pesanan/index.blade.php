@extends('layouts.app') {{-- Pastikan layout ini sudah mendukung Tailwind CSS --}}

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pesanan</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($pesanan->count() > 0)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    #
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Pelanggan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Teknisi
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Layanan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Pesanan
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $index => $item)
                                <tr
                                    class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 transition-colors duration-200">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $pesanan->firstItem() + $index }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $item->user->name ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $item->teknisi->name ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->service->nama_layanan ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        @php
                                            $statusClass = '';
                                            switch (strtolower($item->status_order)) {
                                                case 'selesai':
                                                    $statusClass =
                                                        'bg-green-100 text-green-800 ring-1 ring-green-500/20';
                                                    break;
                                                case 'pending':
                                                    $statusClass = 'bg-gray-100 text-gray-800 ring-1 ring-gray-500/20';
                                                    break;
                                                case 'diterima':
                                                    $statusClass = 'bg-blue-100 text-blue-800 ring-1 ring-blue-500/20';
                                                    break;
                                                case 'dalam_proses':
                                                    $statusClass =
                                                        'bg-yellow-100 text-yellow-800 ring-1 ring-yellow-500/20';
                                                    break;
                                                case 'dibatalkan':
                                                    $statusClass = 'bg-red-100 text-red-800 ring-1 ring-red-500/20';
                                                    break;
                                                default:
                                                    $statusClass = 'bg-gray-100 text-gray-800 ring-1 ring-gray-500/20';
                                                    break;
                                            }
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst($item->status_order) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.pesanan.show', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-eye mr-1">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                                Lihat
                                            </a>
                                            <a href="{{ route('admin.pesanan.edit', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-pencil mr-1">
                                                    <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                                    <path d="m15 5 4 4" />
                                                </svg>
                                                Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-6 flex justify-center">
                {{ $pesanan->links('pagination::tailwind') }}
            </div>
        @else
            <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-md flex items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-info mr-2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" x2="12" y1="16" y2="12" />
                    <line x1="12" x2="12.01" y1="8" y2="8" />
                </svg>
                Belum ada data pesanan.
            </div>
        @endif
    </div>
@endsection
