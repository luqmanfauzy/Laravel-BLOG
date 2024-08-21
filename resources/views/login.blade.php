@extends('layouts.navbar')
@section('title', 'login')

@section('content')

    <body class="bg-gray-100">
        <div class="bg">

        </div>

        {{-- alert success created an account --}}
        @if (session('success'))
            <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                id="success-alert" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- alert if user is unauthenticate --}}
        @if (session('message-unauthenticate'))
            <div class="text-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-green-400"
                id="failed-alert" role="alert">
                <span class="font-medium">{{ session('message-unauthenticate') }}</span>
            </div>
        @endif

        {{-- alert if user email not verified /token expired and email password incorrect --}}
        @if (session('error'))
            <div class="text-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-green-400"
                id="error-alert" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @if (session('status'))
            <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                id="status-alert" role="alert">
                <span class="font-medium">{{ session('status') }}</span>
            </div>
        @endif

        {{-- body form --}}
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-bold text-center text-gray-900">Sign in to your account</h2>
                <form class="mt-8 space-y-6" action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="email@example.com" required autofocus />
                        @error('email')
                            <div class="text-red-700 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Password
                        </label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                        @error('password')
                            <div class="text-red-700 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Don't have an account?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            //alert will be hide after 5s
            setTimeout(function() {
                var alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);

            setTimeout(function() {
                var alert = document.getElementById('failed-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);

            setTimeout(function() {
                var alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);

            setTimeout(function() {
                var alert = document.getElementById('status-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);
        </script>

    </body>

@endsection
