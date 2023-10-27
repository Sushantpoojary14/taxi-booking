<header id="header" class="mb-20 z-10">
    <nav class=" flex flex-wrap items-center justify-between w-full py-2 md:py-0
         px-4 text-lg text-gray-700 fixed h-20"
        style="background-color: #000000; ">

        <a class="flex title-font font-medium items-center text-white  md:mb-0">
            <img class="w-28 h-12  "src="{{ asset('assets/7-3.png') }}" alt="" srcset="">
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button"
            class="h-14 w-8 cursor-pointer text-white  md:hidden block" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <div class=" md:block hidden ">
            <ul class="pt-4 text-base font-bold text-white flex w-50 m-auto">
                <li>
                    <a class="md:p-4 py-2 " href="{{ url('/') }}">HOME</a>
                </li>
                <li>
                    <a class="md:p-4 py-2" href="{{ url('/contact-us') }}">CONTACT US</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 " href="{{ url('/about-us') }}">ABOUT US</a>
                </li>


            </ul>
        </div>

    </nav>
</header>
<!--<header id="header" class="flex flex-col space-y-3 ">-->
<!--    <nav-->
<!--        class="  flex flex-wrap items-center justify-between w-full py-4 md:py-0-->
<!--         px-4 text-lg text-gray-700 bg-gray-200" >-->

<!--        <a class="flex title-font font-medium items-center text-white  md:mb-0">-->
<!--            <img class="w-50 h-14 "src="{{ asset('assets/Auto-Furze-Logo.png') }}" alt="" srcset="">-->
<!--        </a>-->

<!--        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-10 w-8 cursor-pointer  block"-->
<!--            fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />-->
<!--        </svg>-->

<!--    </nav>-->
<!--        <div class="w-auto bg-gray-200  transition ease-in-out delay-150 -translate-y-1 scale-110 duration-300 px-16 " id="menu">-->
<!--            <ul class=" pt-4 text-base font-bold text-gray-700 flex flex-col  md:pt-0 ">-->
<!--                <li>-->
<!--                    <a class="md:p-4 py-2 block "-->
<!--                        href="{{ url('/') }}">Home</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a class="md:p-4 py-2 block "-->
<!--                        href="{{ url('/contact-us') }}">Contact Us</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a class="md:p-4 py-2 block"-->
<!--                        href="{{ url('/about-us') }}">About Us</a>-->
<!--                </li>-->


<!--            </ul>-->
<!--        </div>-->
<!--</header>-->
