<header id="header" class="">
    <nav
        class="  flex flex-wrap items-center justify-between w-full py-4 md:py-0
         px-4 text-lg text-gray-700 bg-gray-200" >

        <a class="flex title-font font-medium items-center text-white  md:mb-0">
            <img class="w-50 h-14 "src="{{asset('assets/Auto-Furze-Logo.png')}}" alt="" srcset="">
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-10 w-8 cursor-pointer md:hidden block"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
            <ul class=" pt-4 text-base font-bold text-gray-700 md:flex md:justify-between md:pt-0z">
                <li>
                    <a class="md:p-4 py-2 block "
                        href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block "
                        href="{{ url('/contact-us') }}">Contact Us</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block"
                        href="{{ url('/about-us') }}">About Us</a>
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
<!--            <img class="w-50 h-14 "src="{{asset('assets/Auto-Furze-Logo.png')}}" alt="" srcset="">-->
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

