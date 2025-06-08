<x-guest-layout>
    <!-- Tambahkan CSS kustom di sini -->
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 600;
            color: #334155;
        }

        input[type="email"],
        input[type="password"] {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px;
            font-size: 14px;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .block {
            display: block;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .ml-3 {
            margin-left: 0.75rem;
        }

        .underline {
            text-decoration: underline;
        }

        a:hover {
            color: #1e40af;
        }

        /* Tombol Login */
        button {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4338ca;
        }

        /* Remember me */
        label.inline-flex {
            cursor: pointer;
            user-select: none;
        }
    </style>

    <!-- Pesan status (misal: suksezs registrasi) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
