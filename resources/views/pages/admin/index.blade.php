@extends('layouts.app') {{-- Pastikan layout ini sudah mendukung Tailwind CSS --}}

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mx-auto px-4 py-10 bg-gray-50 min-h-screen">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900">Dashboard Admin</h1>
            {{-- Anda bisa menambahkan tombol aksi di sini jika perlu --}}
            {{-- <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus mr-2">
                    <line x1="12" x2="12" y1="5" y2="19"/>
                    <line x1="5" x2="19" y1="12" y2="12"/>
                </svg>
                Tambah Baru
            </a> --}}
        </div>

        {{-- Bagian Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-10">
            {{-- Card Total Pelanggan --}}
            <div
                class="relative bg-white border-l-8 border-blue-600 shadow-xl p-8 rounded-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="flex items-center">
                    <div class="flex-grow mr-4">
                        <div class="text-sm font-bold text-blue-700 uppercase mb-2">
                            Total Pelanggan
                        </div>
                        <div class="text-5xl font-extrabold text-gray-900">{{ $totalPelanggan ?? 0 }}</div>
                    </div>
                    <div class="flex-shrink-0 text-blue-500 opacity-70">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-users">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card Total Teknisi --}}
            <div
                class="relative bg-white border-l-8 border-green-600 shadow-xl p-8 rounded-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="flex items-center">
                    <div class="flex-grow mr-4">
                        <div class="text-sm font-bold text-green-700 uppercase mb-2">
                            Total Teknisi
                        </div>
                        <div class="text-5xl font-extrabold text-gray-900">{{ $totalTeknisi ?? 0 }}</div>
                    </div>
                    <div class="flex-shrink-0 text-green-500 opacity-70">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-wrench">
                            <path
                                d="M.9 11.6a6.14 6.14 0 0 1 1.8-3.8l7.5-7.5 4.6 4.6L8.3 16.1a6.14 6.14 0 0 1-3.8 1.8L.9 11.6Zm17.1 10.5L16 19l3.5-3.5 2.1 2.1c.8.8.8 2 0 2.8l-2.1 2.1c-.8.8-2 .8-2.8 0Z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card Total Layanan --}}
            <div
                class="relative bg-white border-l-8 border-cyan-600 shadow-xl p-8 rounded-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                <div class="flex items-center">
                    <div class="flex-grow mr-4">
                        <div class="text-sm font-bold text-cyan-700 uppercase mb-2">
                            Total Layanan
                        </div>
                        <div class="text-5xl font-extrabold text-gray-900">{{ $totalLayanan ?? 0 }}</div>
                    </div>
                    <div class="flex-shrink-0 text-cyan-500 opacity-70">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-clipboard-list">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                            <path d="M12 11h4" />
                            <path d="M12 15h4" />
                            <path d="M8 11h.01" />
                            <path d="M8 15h.01" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Layanan Terbaru --}}
        <div class="bg-white shadow-xl mb-8 rounded-xl">
            <div class="p-6 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                <h5 class="text-xl font-bold text-blue-700">5 Layanan Terbaru</h5>
            </div>
            <div class="p-6">
                @if (isset($latestLayanan) && $latestLayanan->count() > 0) {{-- Assuming $latestLayanan is passed from controller --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Nama Layanan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Teknisi</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Jadwal Layanan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($latestLayanan as $index => $layanan)
                                    {{-- Looping through $latestLayanan --}}
                                    <tr
                                        class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $layanan->nama_layanan ?? '-' }}</td> {{-- Assuming 'nama_layanan' exists on $layanan object --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $layanan->teknisi->name ?? ($layanan->teknisi->nama_teknisi ?? '-') }}
                                            {{-- Assuming 'teknisi' relationship or 'nama_teknisi' field --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $statusClass = '';
                                                switch (strtolower($layanan->status ?? '')) {
                                                    case 'selesai':
                                                        $statusClass =
                                                            'bg-green-100 text-green-800 ring-1 ring-green-500/20';
                                                        break;
                                                    case 'dijadwalkan':
                                                        $statusClass =
                                                            'bg-blue-100 text-blue-800 ring-1 ring-blue-500/20';
                                                        break;
                                                    case 'berlangsung':
                                                        $statusClass =
                                                            'bg-yellow-100 text-yellow-800 ring-1 ring-yellow-500/20';
                                                        break;
                                                    case 'dibatalkan':
                                                        $statusClass = 'bg-red-100 text-red-800 ring-1 ring-red-500/20';
                                                        break;
                                                    default:
                                                        $statusClass =
                                                            'bg-gray-100 text-gray-800 ring-1 ring-gray-500/20';
                                                }
                                            @endphp
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                {{ ucfirst($layanan->status ?? '-') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $layanan->jadwal_layanan ? \Carbon\Carbon::parse($layanan->jadwal_layanan)->translatedFormat('d M Y, H:i') : '-' }}
                                            {{-- Assuming 'jadwal_layanan' field --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-md flex items-center"
                        role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-info mr-2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" x2="12" y1="16" y2="12" />
                            <line x1="12" x2="12.01" y1="8" y2="8" />
                        </svg>
                        Belum ada data layanan terbaru.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
