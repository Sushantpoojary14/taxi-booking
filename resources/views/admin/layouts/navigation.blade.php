<nav class="text-white bg-zinc-900 mb-4 p-5 md:flex lg:flex md:justify-between lg:justify-between" id="header">
    <div class="flex flex-row md:space-x-36 ">
        <div class="w-full m-auto text-base ">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="font-semibold text-lg">
                    Auto Furze Taxi Booking
                </h2>
            </a>
        </div>


        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-8 w-8 cursor-pointer md:hidden block"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </div>
    <div class="hidden transform w-full md:flex md:items-center md:w-auto"
        id="menu">
        <ul class=" pt-4 text-base text-bold text-gray-700 md:flex md:justify-between md:pt-0 space-x-2">
            <li>
                <a class=" hover:text-white">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Homepage') }}
                    </x-nav-link>
                </a>
            </li>
            <li>
                <a class=" hover:text-white">

                    <x-nav-link :href="route('admin.trip')" :active="request()->routeIs('admin.trip')">
                        {{ __('Trip ') }}
                    </x-nav-link>

                </a>
            </li>
             <li>
                <a class=" hover:text-white">

                    <x-nav-link :href="route('admin.billview')" :active="request()->routeIs('admin.billview')">
                        {{ __('Billing') }}
                    </x-nav-link>

                </a>
            </li>
            <li>
                <a class=" hover:text-white">

                    <x-nav-link :href="url('admin/queue')" :active="request()->routeIs('admin.queue')">
                        {{ __('Queue') }}
                    </x-nav-link>
                </a>
            </li>
            <li>

                <a class=" hover:text-white">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf

                        <x-nav-link : href="route('logout')"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-nav-link>
                    </form>
                </a>
            </li>
        </ul>
    </div>


</nav>
