<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <title>Autofurze Taxi Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @yield('style')
    <style>
        .body {
            background-image: url('{{ asset('assets/Parking Taxi Cars and City Background-3.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

    </style>

</head>

<body class="font-sans antialiased ">
    <div class="body flex flex-col min-h-screen">
        @include('admin.layouts.navigation')
        @yield('content')
        <img src="{{ asset('assets/airport_logo-removebg.png') }}" alt="" class="w-full m-auto">
    @include('driver.layouts.footer')
    </div>

    @yield('script')
    <script>
        const button = document.querySelector('#menu-button');
        const menu = document.querySelector('#menu');
        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
