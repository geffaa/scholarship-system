<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Beasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div class="flex items-center py-4">
                        <span class="font-semibold text-gray-500 text-lg">Sistem Beasiswa</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('scholarships.index') }}" class="py-4 px-2 text-gray-500 hover:text-blue-500">Home</a>
                        <a href="{{ route('scholarships.create') }}" class="py-4 px-2 text-gray-500 hover:text-blue-500">Daftar Beasiswa</a>
                        <a href="{{ route('scholarships.results') }}" class="py-4 px-2 text-gray-500 hover:text-blue-500">Hasil</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>