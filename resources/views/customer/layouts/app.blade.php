<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite('resources/css/app.css') --}}

    <title> Autofurze Taxi Booking </title>

    @yield('css')
    <script src="https://code.jquery.com/jquery-1.12.4.js"
    integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
    crossorigin="anonymous"></script>
    <style>
        body{
            background-image: url('{{ asset('assets/Parking Taxi Cars and City Background.jfif')}}');

            background-repeat: no-repeat;

  background-size: cover;
        }

    </style>

</head>

<body class="" >
    @include('customer.layouts.navigation')

    @yield('content')

    @include('customer.layouts.footer')
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
