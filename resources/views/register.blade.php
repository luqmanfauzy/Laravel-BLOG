@extends('layouts.navbar')
@section('title', 'register')

@section('content')

    <body class="bg-gray-100">

        {{-- alert success --}}
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Centered and Responsive Alert</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>

        </html>

        {{-- body form --}}
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-bold text-center text-gray-900">Register</h2>
                <form class="mt-8 space-y-6" action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Username
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Your name" autofocus required />
                        @error('name')
                            <div class="text-red-700 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">  
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="YourName@example.com" required />
                        @error('email')
                            <div class="text-red-700 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="password" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Password
                        </label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                        @error('password')
                            <div class="text-red-700 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="confirmPassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Confirm your password
                        </label>
                        <input type="password" id="confirmPassword" name="confirmPassword"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                        @if (session('failed'))
                            <div class="text-red-700 text-sm mt-2">{{ session('failed') }}</div>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            <p>Already have an account?,
                                <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Sign in here
                                </a>
                            </p>

                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

@endsection
