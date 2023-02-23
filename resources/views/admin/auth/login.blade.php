<x-admin-guest-layout>
    <!-- Session Status -->

    <div class="py-1  lg:w-2/4 m-auto">
        <div class="w-full mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:dark:text-gray-100 ">
                    <section class="text-gray-600 body-font">
                        <!-- Email Address -->
                        <div class=" py-6  w-full  ">

                                <h2 class="font-semibold text-2xl lg:ml-20 dark:text-gray-200 ">
                                    Admin
                                </h2>

                        </div>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="lg:w-9/12 w-full mx-auto font-medium text-xl ">
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                                        :value="old('email')" required autofocus />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4 w-full">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            name="remember">
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif

                                    <x-primary-button class="ml-3">
                                        {{ __('Log in') }}
                                    </x-primary-button>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </form>
</x-admin-guest-layout>
