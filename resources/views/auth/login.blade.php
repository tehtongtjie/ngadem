<x-guest-layout>

    {{-- Logo di Mobile (sisi kiri tersembunyi saat mobile) --}}
    <div class="lg:hidden text-center mb-8" data-aos="fade-down">
        <a href="/">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Ngadem"
                class="h-20 w-auto mx-auto drop-shadow-md hover:scale-105 transition-transform duration-300">
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 mt-4">
            Selamat Datang di <span class="text-yellow-600">Ngadem</span>
        </h1>
        <p class="text-gray-600 mt-1 text-sm">
            Masuk untuk mengelola kenyamanan AC Anda
        </p>
    </div>

    {{-- Kartu Form Login --}}
    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border border-gray-100 w-full max-w-md mx-auto"
        data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
            Masuk ke Akun Anda
        </h2>

        {{-- Status sesi login --}}
        <x-auth-session-status class="mb-4 text-green-600 text-center font-medium" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Alamat Email
                </label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username"
                        class="pl-10 pr-4 py-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('email') border-red-500 @enderror">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kata Sandi
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="pl-10 pr-4 py-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('password') border-red-500 @enderror">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            {{-- Remember Me & Lupa Password --}}
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-yellow-600 shadow-sm focus:ring-yellow-500">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="underline text-sm text-gray-600 hover:text-yellow-600 transition-colors">
                        Lupa Kata Sandi?
                    </a>
                @endif
            </div>

            {{-- CTA --}}
            <div
                class="flex flex-col sm:flex-row items-center justify-between mt-6 space-y-4 sm:space-y-0 sm:space-x-4">

                <a href="{{ route('register') }}"
                    class="text-sm text-gray-600 underline hover:text-yellow-600 transition-colors order-2 sm:order-1">
                    Belum punya akun?
                </a>

                <button type="submit"
                    class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105 order-1 sm:order-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                    Masuk
                </button>
            </div>
        </form>
    </div>

</x-guest-layout>
