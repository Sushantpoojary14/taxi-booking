@extends('admin.layouts.app')
@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ttext-white dark:text-gray-100">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-2 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-white ">Add new Driver
                                </h1>
                                {{-- <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo park
                                    skateboard authentic crucifix neutra tilde lyft biodiesel artisan direct trade
                                    mumblecore 3 wolf moon twee</p> --}}
                            </div>
                            <div class="lg:w-9/12 w-full mx-auto font-medium text-xl ">
                                <form action="{{route('admin.addnew')}}" method="post" class="m-0 p-0">
                                    @csrf
                                    <div class="lg:w-9/12 md:w-2/3 mx-auto">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="firstname" class="leading-7  text-gray-400">First Name</label>
                                                    <input type="text" id="firstname" name="firstname"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="lastname" class="leading-7 text-gray-400">Last Name</label>
                                                    <input type="text" id="lastname" name="lastname"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="email" class="leading-7  text-gray-400">Email</label>
                                                    <input type="email" id="email" name="email"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="phone" class="leading-7  text-gray-400">Phone No.</label>
                                                    <input type="number" id="phone" name="phone"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="car_type" class="leading-7  text-gray-400">Car Type</label>
                                                    <input type="text" id="car_type" name="car_type"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="car_Number" class="leading-7  text-gray-400">Car Number</label>
                                                    <input type="text" id="car_number" name="car_number"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('car_number')" class="mt-2" />
                                            </div>
                                            {{-- <input type="hidden" name="from" id="from"> --}}
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="fair" class="leading-7  text-gray-400">Fair</label>
                                                    <input type="text" id="fair" name="fair"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('fair')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="Password" class="leading-7 text-gray-400">Password</label>
                                                    <input type="password" id="password" name="password"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>

                                            <div class="p-2 w-1/2">
                                                <div class="relative">
                                                    <label for="status" class="leading-7 text-gray-400"></label>
                                                    <input type="hidden" id="status" name="status" value="1"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>


                                            <div class="p-2 w-full">
                                                <button
                                                    class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                                                    >
                                                    Submit
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
