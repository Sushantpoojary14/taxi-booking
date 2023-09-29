@extends('admin.layouts.app')
@section('content')
    <section class="container px-5 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-8 flex flex-col w-full m-auto">
            <div class="flex flex-col text-center  mb-3 ">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2">Edit Profile
                </h1>
            </div>
            <div class="w-9/12 mx-auto font-medium text-xl space-y-8 ">
                <form action="{{ route('admin.edit') }}" method="post" class="m-0 p-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="mt-4 w-full">
                        <x-input-label for="firstname" :value="__('FirstName')" />
                        <x-text-input type="text" id="firstname" name="firstname"
                            value="{{ $data->driver->firstname }}" />
                        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="lastname" :value="__('Last Name')" />
                        <x-text-input type="text" id="lastname" name="lastname" value="{{ $data->driver->lastname }}" />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>

                    <div class="mt-4 w-full">
                        <x-input-label for="phone" :value="__('Phone No.')" />
                        <x-text-input type="text" id="phone" name="phone" value="{{ $data->driver->phone }}" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none">
                            *Invalid Number</p>
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="car_type" :value="__('Car Type')" />
                        <x-select-input id="car_type" name="car_type"  >
                            <option value="">Selects</option>
                            @foreach ($category as $item)
                                <option v value="{{ $item->id }}"
                                    {{ $item->type == $data->category->type ? 'selected' : '' }}>

                                    {{ $item->type }}
                                </option>
                            @endforeach
                        </x-select-input>

                        <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                    </div>

                    <div class="mt-4 w-full">
                        <x-input-label for="permit" :value="__('Permit ( optional )')" />
                        @foreach ($permit as $item)
                            <div class="flex flex-row space-x-2  my-2">
                                <input id="{{ $item->id }}" type="checkbox" name="checkbox"
                                    class="w-6 h-6 text-black border-gray-300 rounded " value="{{ $item->id }}"
                                    @foreach ($permit_id as $item2) {{ $item->id == $item2 ? 'checked' : '' }} @endforeach>
                                <label for="{{ $item->id }}"
                                    class="ml-2 text-base font-medium text-black ">{{ $item->permit_place }} </label>
                            </div>
                        @endforeach
                        <input type="hidden" name="vehicle_permit" id="permit">
                    </div>

                    <div class="mt-4 w-full">
                        <x-input-label for="model" :value="__('Model')" />
                        <x-text-input type="text" id="model" name="vehicle_name"
                            value="{{ $data->vehicles->vehicle_name }}" />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="vehicle_number" :value="__('Car Number')" />
                        <x-text-input type="text" id="vehicle_number" name="vehicle_number"
                            value="{{ $data->vehicles->vehicle_number }}" />
                        <x-input-error :messages="$errors->get('vehicle_number')" class="mt-2" />
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="color" :value="__('Car Color')" />
                        <x-text-input type="text" id="color" name="vehicle_color"
                            value="{{ $data->vehicles->vehicle_color }}" />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>

                    <div class="flex mt-4 item-center">
                        <x-primary-button class="mx-auto " id="button">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <script>
        const inputField = document.getElementById("phone");
        const button1 = document.getElementById("button");
        inputField.addEventListener("input", function() {

            if (inputField.value.length > 10) {
                document.getElementById("err_phone").style.display = "block";
                return false;
            }
            if (inputField.value.length < 10) {
                document.getElementById("err_phone").style.display = "block";
                return false;
            }
            document.getElementById("err_phone").style.display = "none";
        });

        button1.addEventListener('click', (event) => {
            let checkboxes = document.querySelectorAll('input[name="checkbox"]:checked');
            let output = [];
            checkboxes.forEach((checkbox) => {
                output.push(checkbox.value);
            });
            document.getElementById('permit').value = output
        })
    </script>
@endsection
