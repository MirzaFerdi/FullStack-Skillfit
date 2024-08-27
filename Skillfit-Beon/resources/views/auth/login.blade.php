<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    @vite('resources/css/app.css')
    <title>Login - Sistem Pengelolaan Perumahan</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl w-full">
        <!-- Gambar di sebelah kiri -->
        <div class="w-1/2">
            <img src="{{ asset('images/perumahan.jpg')}}" alt="Login Image" class="w-full h-[35rem] object-cover">
        </div>

        <!-- Form login di sebelah kanan -->
        <div class="w-1/2 p-8 mt-14 ">
            <x-bladewind::notification />
            <h2 class="text-2xl font-bold mb-12 text-center">Login Sistem Pengelolaan Perumahan</h2>

            <!-- Form login -->
            <form method="POST" action="{{ route('auth') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required autofocus
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        @if (session('error login'))
            showNotification("Login Gagal", "Email atau Password Salah", "error");
        @endif
    </script>

</body>
</html>
