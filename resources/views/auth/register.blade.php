{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>

    {{-- Logo di Mobile --}}
    <div class="lg:hidden text-center mb-8" data-aos="fade-down">
        <a href="/">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem"
                class="h-20 w-auto mx-auto drop-shadow-md hover:scale-105 transition-transform duration-300">
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 mt-4">
            Daftar Akun Baru
        </h1>
        <p class="text-gray-600 mt-1 text-sm">
            Jadilah bagian dari kenyamanan bersama <span class="text-yellow-600 font-semibold">Ngadem</span>
        </p>
    </div>

    {{-- Kartu Form Registrasi --}}
    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border border-gray-100 w-full max-w-md mx-auto"
        data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
            Buat Akun Ngadem
        </h2>

        <x-auth-session-status class="mb-4 text-green-600 text-center font-medium" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        autocomplete="name"
                        class="pl-10 pr-4 py-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('name') border-red-500 @enderror">
                    <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Daftar Sebagai</label>
                <div class="relative">
                    <select id="role" name="role" required
                        class="pl-10 pr-4 py-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 @error('role') border-red-500 @enderror">
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="teknisi" {{ old('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                    </select>
                    <i class="fas fa-user-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <div class="relative">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        autocomplete="username"
                        class="pl-10 pr-4 py-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('email') border-red-500 @enderror">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="pl-10 pr-4 py-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('password') border-red-500 @enderror">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konfirmasi Kata Sandi
                </label>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        autocomplete="new-password"
                        class="pl-10 pr-4 py-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('password_confirmation') border-red-500 @enderror">
                    <i class="fas fa-lock-open absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- CTA --}}
            <div
                class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('login') }}"
                    class="text-sm text-gray-600 underline hover:text-yellow-600 transition-colors order-2 sm:order-1">
                    Sudah punya akun?
                </a>

                <button type="submit"
                    class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-300 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105 order-1 sm:order-2 focus:outline-none focus:ring-2 focus:ring-offset-2">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>

</x-guest-layout>
