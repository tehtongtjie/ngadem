@extends('layouts.app') {{-- Pastikan Anda memiliki layout admin yang benar dan sudah mengimpor Tailwind CSS --}}

@section('title', 'Detail Pembayaran')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Pembayaran</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
                <h6 class="text-lg font-semibold text-gray-800">Informasi Pembayaran</h6>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal border-collapse">
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    ID</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pembayaran->id }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Order ID</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pembayaran->order_id }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Metode Pembayaran</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $pembayaran->metode_pembayaran }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Jumlah Bayar</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">Rp
                                    {{ number_format($pembayaran->jumlah_bayar, 2, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Status Pembayaran</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ ucfirst($pembayaran->status_pembayaran) }}</td>
                            </tr>
                            <tr>
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Tanggal Pembayaran</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $pembayaran->tanggal_pembayaran->format('d M Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                </a>
                <a href="{{ route('admin.pembayaran.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-arrow-left mr-2">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Kembali ke Daftar
                </a>

                <form action="{{ route('admin.pembayaran.destroy', $pembayaran->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-trash-2 mr-2">
                            <path d="M3 6h18" />
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            <line x1="10" x2="10" y1="11" y2="17" />
                            <line x1="14" x2="14" y1="11" y2="17" />
                        </svg>
                        Hapus Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
