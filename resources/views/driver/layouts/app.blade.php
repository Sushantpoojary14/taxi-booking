<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <title>YOHTAXI</title>
    @yield('css')
    <style>
        .body {
         background-image: url('{{asset('assets/Parking Taxi Cars and City Background-3.jpg')}}');
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            background-size:cover;
        }

    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
    <body class="">
        <div class="body flex flex-col min-h-screen">
            @include('driver.layouts.navigation')
            @yield('content')
                {{-- <img src="{{asset('assets/airport_logo-removebg.png')}}" alt=""> --}}
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
          <script>

        const inputField = document.getElementById("phone");

        inputField.addEventListener("input", function() {
            const regex =  /^(0|91)?[6-9][0-9]{9}$/;
            if (!regex.test(inputField.value)) {
                document.getElementById("err_phone").style.display = "block";
                return false;
            }

            document.getElementById("err_phone").style.display = "none";
        });
    </script>
    </body>
</html>
