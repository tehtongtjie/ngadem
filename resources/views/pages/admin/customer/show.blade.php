@extends('layouts.app') {{-- Pastikan Anda memiliki layout admin yang benar dan sudah mengimpor Tailwind CSS --}}

@section('title', 'Detail Customer')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Customer</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
                <h6 class="text-lg font-semibold text-gray-800">Informasi Customer</h6>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal border-collapse">
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    ID</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $customer->id }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Nama</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $customer->name }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Email</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ $customer->email }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Role</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">{{ ucfirst($customer->role) }}</td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Terdaftar Sejak</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $customer->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th
                                    class="px-5 py-3 bg-white text-left text-sm font-semibold text-gray-600 uppercase tracking-wider w-48">
                                    Terakhir Diperbarui</th>
                                <td class="px-5 py-3 bg-white text-sm text-gray-900">
                                    {{ $customer->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('admin.customer.edit', $customer->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-pencil mr-2">
                            <path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                            <path d="m15 5 4 4" />
                        </svg>
                        Edit Customer
                    </a>
                    <a href="{{ route('admin.customer.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left mr-2">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Kembali ke Daftar
                    </a>

                    {{-- Tombol hapus (opsional, bisa juga di daftar index) --}}
                    <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trash-2 mr-2">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                            Hapus Customer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
