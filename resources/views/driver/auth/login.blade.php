@extends('driver.layouts.guest')
@section('content')
    <section class="container px-5 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-8 flex flex-col w-full m-auto">
            <form method="POST" action="{{ route('driver.login') }}">
                @csrf
                <div class="mt-4 w-full">
                    <x-input-label for="phone" :value="__('User ID')" />

                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center mt-4 justify-between">
                    <a class="underline text-sm text-black hover:text-gray-900 dark:hover:text-gray-100 rounded-md  "
                        href="{{ route('driver.register') }}">
                        {{ __('New Register') }}
                    </a>
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
            </form>
        </div>
    </section>
@endsection
