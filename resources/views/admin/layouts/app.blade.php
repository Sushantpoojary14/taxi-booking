<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
    <title>Autofurze Taxi Booking</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js
            "></script>
    <script src="{{ asset('js/print.js') }}"></script>


    <script src="{{ asset('js/qrcode.min.js') }}"></script>
</head>

<body class="font-sans antialiased dark:bg-gray-900">
    <div class=" bg-gray-100 dark:bg-gray-900">
        @include('admin.layouts.navigation')
        

        <!-- Page Content -->
        <main>
            {{-- {{ $slot }} --}}
            @yield('content')
        </main>

        @yield('script')

        <script src="{{ asset('js/qr.js') }}"></script>
    </div>
</body>

</html>
