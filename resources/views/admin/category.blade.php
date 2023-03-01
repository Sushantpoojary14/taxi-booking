@extends('admin.layouts.app')
@section('content')
    <div class="py-1  lg:w-full md:w-full mt-10">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:dark:text-gray-100 ">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-0 mx-auto ">
                            <div class="flex flex-col text-center  mb-6 ">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 dark:text-white ">Edit Driver
                                </h1>

                            </div>
                            <div class="lg:w-11/12 w-full mx-auto font-medium text-xl ">
                                <form action="{{ route('admin.edit') }}" method="post" class="m-0 p-0">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    @csrf
                                    <div class="lg:w-11/12 md:w-2/3 mx-auto  ">
                                        <div class="flex flex-row flex-wrap -m-2">
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="firstname" class="leading-7  text-gray-400">First
                                                        Name</label>

                                                        <x-text-input type="text" id="firstname" name="firstname"
                                                            class=""
                                                            value="{{ $data->driver[0]->firstname }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="lastname" class="leading-7 text-gray-400">Last Name</label>

                                                        <x-text-input type="text" id="lastname" name="lastname"
                                                            class=""
                                                            value="{{ $data->driver[0]->lastname }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="email" class="leading-7  text-gray-400">Email</label>
                                                      <x-text-input type="email" id="email" name="email"
                                                            class=""
                                                            value="{{ $data->driver[0]->email }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="phone" class="leading-7  text-gray-400">Phone No.</label>

                                                        <x-text-input type="text" id="phone" name="phone"
                                                            class=""
                                                            value="{{ $data->driver[0]->phone }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="car_type" class="leading-7  text-gray-400 ">Car Type</label>
                                                    <select id="car_type" name="car_type"
                                                        class="w-full block bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm px-4 py-2">

                                                            <option value="">Select</option>

                                                        @foreach ($category as $item)
                                                            <option
                                                                class="bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-4"
                                                                value="{{ $item->type }} "
                                                                {{ $data->category[0]->type == $item->type ? 'selected' : '' }}>

                                                                {{ $item->type }}

                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="model" class="leading-7  text-gray-400">Model</label>

                                                        <x-text-input type="text" id="model" name="model"
                                                            class=""
                                                            value="{{ $data->vehicles[0]->vehicle_name }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="car_number" class="leading-7  text-gray-400">Car
                                                        Number</label>

                                                        <x-text-input type="text" id="car_number" name="car_number"
                                                            class=""
                                                            value="{{ $data->vehicles[0]->car_number }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('car_number')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-1/4">
                                                <div class="relative">
                                                    <label for="color" class="leading-7  text-gray-400">Car Color</label>

                                                        <x-text-input type="text" id="color" name="color"
                                                            class=""
                                                            value="{{ $data->vehicles[0]->color }}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('color')" class="mt-2" />
                                            </div>


                                            <div class="p-2 w-full">
                                                <button
                                                    class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none mt-8 hover:bg-indigo-600 rounded text-lg">
                                                    Update
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
