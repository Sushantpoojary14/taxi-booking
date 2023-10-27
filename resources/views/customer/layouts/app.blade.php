<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">

    <title> YOHTAXI </title>

    @yield('css')

    <style>
        #mainSection {
            background-image: url('{{ asset('assets/CParking Taxi Cars and City Background-2.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.9;
        }

        /* #mainSection::after {
            content: "";
            position: absolute;
            top: 10%;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            opacity: 0.3;
            background-color: #f1f1f1;
        } */

        .sidebar {
            height: 148%;
            /* width: 0; */
            position: absolute;
            z-index: 20;
            top: 0;
            left: 0;
            right: 100%;
            bottom: 0;
            background-color: transparent;
            overflow-x: hidden;
            /* padding-top: 60px; */
            display: flex;
            transition: 0.5s;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 1.2rem;
            color: black;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }
    </style>

</head>

<body>
    <div id="mySidebar" class="sidebar">
        <div class="h-full w-full bg-white">
            <p id="closebtn" class="closebtn w-44 h-14 p-3 text-left">X</p>
            <ul class="pt-4 text-base font-bold text-gray-700 md:justify-between md:pt-0 space-y-4">
                <li>
                    <a class="md:p-4 py-2 block " href="{{ url('/') }}">HOME</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block " href="{{ url('/contact-us') }}">CONTACT US</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block" href="{{ url('/about-us') }}">ABOUT US</a>
                </li>


            </ul>
        </div>
        <div class="h-full w-full bg-white opacity-20 closebtn ">

        </div>
    </div>
    <div class="body flex flex-col min-h-screen " id="mains">

        @include('customer.layouts.navigation')
        <div id="mainSection">

            @yield('content')
        </div>
        {{-- <img src="{{asset('assets/airport_logo-removebg.png')}}" alt=""> --}}
        @include('customer.layouts.footer')
    </div>

    @yield('script')

    <script>
        const button = document.querySelector('#menu-button');
        const menu = document.querySelector('#menu');

        const closebtn = document.querySelectorAll('.closebtn');
        console.log(closebtn);
        const closebtnArray = Array.from(closebtn);
        closebtnArray.forEach(element => {
            element.addEventListener('click', () => {
                // console.log(closebtn);
                document.getElementById("mySidebar").style.right = "100%";
                // document.getElementById("main").style.marginLeft ="0";

            });
        });


        button.addEventListener('click', () => {
            document.getElementById("mySidebar").style.right = "0%";
            // document.getElementById("main").style.marginLeft = "250px";

        });
    </script>
</body>

</html>
