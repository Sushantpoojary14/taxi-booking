@extends('admin.layouts.guest')
@section('content')
    <section class="container px-5 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-8 flex flex-col w-full m-auto">
            <div class="text-center ">
                <h1 class="block w-100 text-2xl md:text-4xl lg:text-4xl font-bold title-font text-zinc-900">
                    Admin
                </h1>
            </div>
            <form method="POST" action="{{ route('admin.store') }}">
                @csrf
                <div class="mt-4 w-full">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email"
                        :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center mt-4 justify-between">

                    <x-primary-button class=" ">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
@endsection
