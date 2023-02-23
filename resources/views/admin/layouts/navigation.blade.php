<header class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700" id="header">

    <div class="container mx-auto flex flex-wrap p-2 flex-col md:flex-row items-center ">

        <nav
            class=" md:mr-auto md:ml-4 md:py-1 md:pl-4 text-gray-800 dark:text-gray-200	flex flex-wrap space-x-2 items-center justify-center my-3 text-xl">

            <div class="shrink-0 flex items-center mx-10 border-l border-r px-10 text-center">
                <a href="{{ route('admin.dashboard') }}">
                    <h2 class="font-semibold text-2xl  dark:text-gray-200 ">
                        Autofurze Taxi Booking
                    </h2>
                </a>
            </div>


            <a class="mr-6 hover:text-white">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Homepage') }}
                </x-nav-link>
            </a>
            {{-- <a class="mr-6 hover:text-white">

                    <x-nav-link :href="route('admin.add')" :active="request()->routeIs('admin.add')">
                        {{ __('Add ') }}
                    </x-nav-link>

            </a> --}}
            <a class="mr-6 hover:text-white">

                <x-nav-link :href="url('admin/queue')" :active="request()->routeIs('admin.queue')">
                    {{ __('Queue') }}
                </x-nav-link>
            </a>

            <a class="mr-5 hover:text-white">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf

                    <x-nav-link : href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </a>


        </nav>

    </div>
</header>
