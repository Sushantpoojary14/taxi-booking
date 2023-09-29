<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">

    <title> Autofurze Taxi Booking </title>

    @yield('css')
  
    <style>
        body{
            background-image: url('{{asset('assets/Parking Taxi Cars and City Background-2.jpg')}}');

            background-repeat: no-repeat;
            background-size: cover;

        }
        
    </style>

</head>

<body class="" >
     <div class="body flex flex-col min-h-screen">
        @include('customer.layouts.navigation')
        @yield('content')
        <img src="{{asset('assets/airport_logo-removebg.png')}}" alt="">
        @include('customer.layouts.footer')
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
