<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Verify Email</title>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Verify Your Email</h2>

            <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                id="success-alert" role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>

            <form action="{{ route('verify.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="token" class="block text-sm font-medium text-gray-700">Enter Your 6-Digit
                        Verification Token</label>
                    <input type="text" name="token" id="token" required
                        class="mt-2 p-2 block w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @if ($errors->has('token'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('token') }}</p>
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                        Verify
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Didn't receive the email? <a href="#" class="text-indigo-600 hover:underline">Resend Verification Token</a>
            </p>
        </div>
    </div>

</body>

</html>
