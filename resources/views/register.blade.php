<x-guest-layout>
    <div class="py-1  lg:w-full md:w-full">
        <div class="w-full mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:dark:text-gray-100 ">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-0 mx-auto ">
                            <div class="flex flex-col text-center  mb-6 ">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 dark:text-white ">Register
                                </h1>

                            </div>
                            <div class="lg:w-9/12 w-full mx-auto font-medium text-xl ">
                                <form action="{{route('register')}}" method="post" class="m-0 p-0">
                                    @csrf
                                    <div class="lg:w-9/12 md:w-2/3 mx-auto  ">
                                        <div class="flex flex-col flex-wrap -m-2">
                                            <div class="p-2 4/5">
                                                <div class="relative">
                                                    <label for="firstname" class="leading-7  text-gray-400">First Name</label>
                                                    <x-text-input type="text" id="firstname" name="firstname"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"/>
                                                </div>
                                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="lastname" class="leading-7 text-gray-400">Last Name</label>
                                                    <x-text-input type="text" id="lastname" name="lastname"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"/>
                                                </div>
                                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="email" class="leading-7  text-gray-400">Email</label>
                                                    <x-text-input type="email" id="email" name="email"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="phone" class="leading-7  text-gray-400">Phone No.</label>
                                                    <x-text-input type="text" id="phone" name="phone"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="car_type" class="leading-7  text-gray-400">Car Type</label>
                                                    <select  id="car_type" name="car_type"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <option value="">Select</option>
                                                        @foreach ($category as $item )
                                                        <option class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:hover:indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{$item->type}}">{{$item->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="model" class="leading-7  text-gray-400">Model</label>
                                                    <x-text-input type="text" id="model" name="model"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="car_number" class="leading-7  text-gray-400">Car Number</label>
                                                    <x-text-input type="text" id="car_number" name="car_number"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" oninput="space()"/>
                                                </div>
                                                <x-input-error :messages="$errors->get('car_number')" class="mt-2" />
                                            </div>
                                            <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="color" class="leading-7  text-gray-400">Car Color</label>
                                                    <x-text-input type="text" id="color" name="color"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                                <x-input-error :messages="$errors->get('color')" class="mt-2" />
                                            </div>
                                            {{-- <input type="hidden" name="from" id="from"> --}}

                                            {{-- <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="Password" class="leading-7 text-gray-400">Password</label>
                                                    <x-text-input type="password" id="password" name="password"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div> --}}

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

</x-guest-layout>
