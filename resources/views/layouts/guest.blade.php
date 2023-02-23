<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Autofurze Taxi Booking</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Scripts -->

</head>

<body class="font-sans text-gray-900 antialiased dark:bg-gray-900">
    <div class=" flex flex-col sm:justify-center items-center bg-gray-100 dark:bg-gray-900">
        {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}
        <header
            class="bg-white  dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 w-full  mb-8">

            <div class="container flex flex-wrap py-2 flex-col md:flex-row items-center  ">

                <nav
                    class="  md:m-auto md:ml-4 md:py-1 md:pl-4  text-gray-800 dark:text-gray-200	flex flex-wrap   items-center text-base justify-center my-3">

                    <div class="shrink-0  flex items-center m-auto border-l border-r px-2">

                        <h2 class="font-semibold text-2xl  dark:text-gray-200  ">
                            Autofurze Taxi Booking
                        </h2>

                    </div>


                </nav>

            </div>
        </header>

        <div>

            {{ $slot }}

        </div>
    </div>
    {{-- <script>
        var input = document.getElementById("car_number");

         function space() {
            if (input.value.length > 0) {

                if (input.value.length % 2 == 0) {
                    input.value += " ";
                }
            }
        }

    </script> --}}
</body>

</html>
