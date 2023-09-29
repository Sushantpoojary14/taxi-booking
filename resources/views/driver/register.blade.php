@extends('driver.layouts.guest')
@section('content')
    <section class="container px-5 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-8 flex flex-col w-full m-auto">
            <div class="flex flex-col text-center  mb-3 ">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2">Register
                </h1>
            </div>
            <div class="w-9/12 mx-auto font-medium text-xl space-y-8 ">
                <form action="{{ route('driver.register') }}" method="post" class="m-0 p-0">
                    @csrf
                    <div class="mt-4 w-full">

                        <x-input-label for="firstname" :value="__('First
                                                                                    Name')" />

                        <x-text-input type="text" id="firstname" name="firstname" />

                        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-full">

                        <x-input-label for="lastname" :value="__('Last Name')" />
                        <x-text-input type="text" id="lastname" name="lastname" c />

                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>
                    {{-- <div class="p-2 5/6">
                                                <div class="relative">
                                                    <label for="email" class="leading-7  text-gray-400">Email</label>
                                                    <x-text-input type="email" id="email" name="email"
                                                        class="w-full dark:bg-gray-800 bg-opacity-40 rounded border dark:border-gray-700 dark:focus:border-indigo-500 dark:focus:bg-gray-900 focus:ring-2 dark:focus:ring-indigo-900 text-base outline-none dark:dark:text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div> --}}
                    <div class="mt-4 w-full">

                        <x-input-label for="phone" :value="__('Phone No.')" />
                        <x-text-input type="text" id="phone" name="phone" maxlength="10"/>

                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none">
                            *Invalid Number</p>
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="car_type" :value="__('Car Type')" />
                        <x-select-input id="car_type" name="car_type">
                            <option value="">Selects</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->type }}</option>
                            @endforeach
                        </x-select-input>

                        <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                    </div>

                    <div class="mt-4 w-full">
                        <x-input-label for="permit" :value="__('Permit ( optional )')" />
                        @foreach ($permit as $item)
                            <div class="flex flex-row space-x-2  my-2">
                                <input id="{{ $item->id }}" type="checkbox" name="checkbox"
                                    class="w-6 h-6 text-black border-gray-300 rounded " value="{{ $item->id }}">
                                <label for="{{ $item->id }}"
                                    class="ml-2 text-base font-medium text-black ">{{ $item->permit_place }} </label>
                            </div>
                        @endforeach
                        <input type="hidden" name="permit" id="permit">
                    </div>

                    <div class="mt-4 w-full">
                        <x-input-label for="model" :value="__('Model')" />
                        <x-text-input type="text" id="model" name="model" />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="vehicle_number" :value="__('Car
                                                                                    Number')" />
                        <x-text-input type="text" id="vehicle_number" name="vehicle_number" />

                        <x-input-error :messages="$errors->get('vehicle_number')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-full">

                        <x-input-label for="color" :value="__('Car Color')" />
                        <x-text-input type="text" id="color" name="color" />

                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>

                    <div class="flex items-center mt-4 justify-between">

                        <a class="underline text-sm text-black hover:text-gray-900  rounded-md  "
                            href="{{ route('driver.login') }}">
                            {{ __('Login') }}
                        </a>


                        <x-primary-button class="ml-3" id="button">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>



                </form>
            </div>

        </div>
    </section>

    <script>
    
        const button = document.getElementById("button");
      

        button.addEventListener('click', (event) => {
            let checkboxes= document.querySelectorAll('input[name="checkbox"]:checked');
            let output= [];
            checkboxes.forEach((checkbox) => {
                output.push(checkbox.value);
            });
           document.getElementById('permit').value=output
        })

    </script>
      <script>

        const inputField = document.getElementById("phone");

        inputField.addEventListener("input", function() {
            const regex =  /^(0|91)?[6-9][0-9]{9}$/;
            if (!regex.test(inputField.value)) {
                document.getElementById("err_phone").style.display = "block";
                return false;
            }
           
            document.getElementById("err_phone").style.display = "none";
        });
    </script>
@endsection
