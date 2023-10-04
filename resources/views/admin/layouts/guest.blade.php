<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Autofurze Taxi Booking</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            margin: 0%;
            padding: 0%;
        }

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

<body class="font-sans  antialiased ">
     <div class="body flex flex-col min-h-screen">

        <nav class="text-gray-800 bg-black flex flex-wrap mb-4 p-5 ">
            <div class="w-full m-auto  text-base  px-2">
                <h2 class="font-semibold text-2xl text-center text-white">
                    YOHTAXI
                </h2>
            </div>
        </nav>

        @yield('content')

        {{-- <img src="{{ asset('assets/airport_logo-removebg.png') }}" alt=""> --}}

        @include('driver.layouts.footer')
    </div>

</body>

</html>
