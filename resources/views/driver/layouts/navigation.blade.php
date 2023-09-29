<nav class="text-white bg-zinc-900 mb-4 p-5 md:flex lg:flex md:justify-between lg:justify-between">
    <div class="flex flex-row md:space-x-36 ">
        <div class="w-full m-auto text-base ">
            <a href="{{ route('driver.dashboard') }}">
                <h2 class="font-semibold text-lg">
                    Auto Furze Taxi Booking
                </h2>
            </a>
        </div>
        <div class="text-right text-lg px-2 md:pt-4 lg:pt-4 md:text-center"> {{ Auth::user()->firstname }}</div>

        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-8 w-8 cursor-pointer md:hidden block"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </div>
    <div class="hidden transform w-full md:flex md:items-center md:w-auto"
        id="menu">
        <ul class=" pt-4 text-base text-bold text-gray-700 md:flex md:justify-between md:pt-0">
            <li>
                <a class="md:p-4 py-2 block text-white " href="{{ route('driver.dashboard') }}">
                    {{ __('Homepage') }}

                </a>
            </li>
            <li>
                <a class="md:p-4 py-2 block text-white" href="{{ url('driver/profile/edit/' . Auth::user()->id) }}">
                    {{ __('Profile') }}

                </a>
            </li>
            <li>
                <a class="md:p-4 py-2 block text-white " href="{{ route('driver.queue') }}">
                    {{ __('Queue') }}

                </a>
            </li>
            <li>

                <a>
                    <form method="POST" action="{{ route('driver.logout') }}">
                        @csrf
                        <a class="md:p-4 py-2 block text-white " href="route('driver.logout')"
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
