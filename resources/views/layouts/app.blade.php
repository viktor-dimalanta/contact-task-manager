<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Application')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <nav class="bg-gray-800 p-6">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <a href="{{ route('home') }}" class="text-white text-xl font-bold">Your App</a>
            </div>
            <div>
                <a href="{{ route('businesses.index') }}" class="text-white hover:text-gray-300 mr-4">Businesses</a>
                <a href="{{ route('people.index') }}" class="text-white hover:text-gray-300 mr-4">People</a>
                <!-- Add more navigation links as needed -->
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-4">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>