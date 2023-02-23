<header class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    <div class="container mx-auto flex flex-wrap p-1 flex-col md:flex-row items-center ">

        <nav
            class=" md:mr-auto md:ml-4 md:py-1 md:pl-4  text-gray-800 dark:text-gray-200	flex flex-wrap space-x-2  items-center text-base justify-center my-3">

            <div class="shrink-0 flex items-center mr-9 border-l border-r px-2">
                <a href="{{ route('dashboard') }}">
                    <h2 class="font-semibold text-lg  dark:text-gray-200 ">
                        Autofurze Taxi Booking
                    </h2>
                </a>
            </div>
            <div class="ml-10"> {{Auth::user()->firstname}}</div>
            <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-6 w-6 cursor-pointer md:hidden block"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
                <ul class=" pt-4 text-base text-bold text-gray-700 md:flex md:justify-between md:pt-0">
                    <li>
                        <a class="md:p-4 py-2 block dark:text-white hover:text-white" href="{{route('dashboard')}}" >
                                {{ __('Homepage') }}

                        </a>
                    </li>
                    <li>
                        <a class="md:p-4 py-2 block  dark:text-white hover:text-white"
                           href="{{route('profile.edit')}}" >
                                {{ __('Profile') }}

                        </a>
                    </li>
                    <li>
                        <a class="md:p-4 py-2 block  dark:text-white hover:text-white"
                           href="{{route('queue')}}" >
                                {{ __('Queue') }}

                        </a>
                    </li>
                    <li>

                        <a >
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="md:p-4 py-2 block dark:text-white hover:text-white" href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </a>


                    </li>
                </ul>
            </div>

            </nav>

    </div>
</header>
