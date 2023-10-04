@extends('admin.layouts.app')
@section('style')
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            transition-delay: 1s;
        }


        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <section class="text-black body-font  mx-2 ">
        <div class="text-center w-full px-2 py-1 mx-auto ">
            <div
                class="flex flex-col md:flex-row md:w-9/12 lg:w-9/12 lg:flex-row  px-4  space-y-5 my-5 items-center mx-auto">
                <h1 class="block w-100 text-lg sm:text-2xl font-medium title-font text-white text-center">
                    Add Dispatch Details
                </h1>

            </div>
            <div class="w-9/12 mx-auto font-medium text-xl space-y-8 ">
                <form id="my-form">


                    <input type="hidden" name="c_vehicle" id="c_vehicle" value="{{ $data->category_id }}">
                    <input type="hidden" name="c_permit" id="c_permit" value="3">
                    <div class="mt-4 w-full">
                        <x-text-input type="text" id="c_to" name="c_to" class="" />
                        <x-input-error :messages="$errors->get('c_to')" class="mt-2" placeholder="Location" required />
                        <p class="text-sm text-red-700 p-2" id="err_location" style="display: none">
                            *No Location Found</p>
                    </div>
                    <x-input-error :messages="$errors->get('c_phone')" class="mt-2" />
                    <x-input-error :messages="$errors->get('c_name')" class="mt-2" />
                    <x-input-error :messages="$errors->get('c_payment')" class="mt-2" />



                    <div class="w-full flex justify-center  space-x-5">
                        <div class="flex mt-4 item-center">
                            <x-primary-button class="mx-auto px-7 py-3" id="button">
                                {{ __('Book') }}
                            </x-primary-button>
                        </div>
                        <div class="flex mt-4 item-center">
                            <a class="inline-flex items-center  px-6 py-2  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:bg-gray-700  active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 lg:8px text-center bg-red-500"
                                id="button" href='{{ url('/admin/queue') }}'>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <form action="{{ route('admin.print') }}" method="post" id="c_data">
                <div class="mx-2 text-lg font-medium space-y-1">

                    @csrf

                    <x-text-input type="text" id="name" name="name" placeholder="Customers Name" required />
                    <x-text-input type="text" id="phone" name="phone" class="" placeholder="Phone Number"
                        required maxlength="10" />
                    <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none">*Invalid Number
                    </p>
                   <x-select-input id="c_payment" name="c_payment" class="w-full" required>
                       <option ption selected disabled hidden value="">Select</option>
                        <option value="cash"> Cash </option>
                        <option value="upi"> UPI </option>
                        <option value="card"> Card </option>
                    </x-select-input>
                    <x-text-input type="text" id="discount" placeholder="Discount" />
                    <p>Car Type: <span id="car_type" class="font-normal"></span></p>
                    <p>From: <span id="from" class="font-normal"> </span></p>
                    <p>To: <span id="to" class="font-normal"></span></p>
                    <p>Distance: <span id="travel_distance" class="font-normal"></span></p>
                    <p>Travel Time: <span id="travel_timing" class="font-normal"></span></p>
                    <p>Total Amount: <span id="total_amount" class="font-normal"></span></p>

                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="hidden" name="invoice" value="{{ $randomString }}">
                    <input type="hidden" id="from_loaction" name="from_loaction">
                    <input type="hidden" id="to_loaction" name="to_loaction">
                    <input type="hidden" id="distance" name="distance">
                    <input type="hidden" id="travel_time" name="travel_time">
                    <!--<input type="hidden" id="name" name="name">-->
                    <!--<input type="hidden" id="phone" name="phone">-->
                    <input type="hidden" id="url" name="url">
                    <input type="hidden" id="permit" name="permit">
                    <!--<input type="hidden" id="c_payment" name="c_payment">-->
                    <input type="hidden" id="category" name="category">
                    <input type="hidden" id="fair" name="fair">
                    <input type="hidden" id="total_fair" name="total_fair">
                    <input type="hidden" id="coordinate" name="coordinate">
                    <input type="hidden" id="night_charges" name="night_charges">
                    <input type="hidden" id="c_token" name="c_token">

                    <div class="flex justify-around mt-3 lg:mx-44 md:mx-44 sm:mx-44 ">
                        <a
                            class="text-white bg-red-500 border-0 py-1 px-4 lg:py-2 lg:px-8 md: focus:outline-none hover:bg-red-600 rounded text-sm lg:text-lg close hover:text-white">Cancel</a>

                        <button id="form"
                            class="text-white bg-indigo-800 border-0 py-1 px-5 lg:py-2 lg:px-8  focus:outline-none hover:bg-indigo-600 rounded text-sm lg:text-lg">Book</button>

                    </div>

                </div>
            </form>

        </div>

    </div>
@endsection
@section('script')
    <script>
        const inputField = document.getElementById("phone");
        const discountField = document.getElementById("discount");
        let temp_total_fair = 0;
        let temp_fair = 0;

        discountField.addEventListener("input", function() {
            let total_fair = parseInt(document.getElementById("total_fair").value);
            let fair = parseInt(document.getElementById("fair").value);
            if(temp_total_fair == 0 && temp_fair == 0){
                temp_total_fair = total_fair;
                temp_fair = fair;
            }
            let discount = parseInt(discountField.value) || 0;
            total_fair = temp_total_fair - discount;
            console.log("discount " + discount);
            fair = temp_fair - discount;
            console.log("fair " + fair);
            console.log("tfair " + total_fair);
            document.getElementById("total_fair").value = total_fair;
            document.getElementById("fair").value = fair;
            document.getElementById("total_amount").textContent = total_fair;
        });


        inputField.addEventListener("input", function() {
            const regex = /^(0|91)?[6-9][0-9]{9}$/;
            if (!regex.test(inputField.value)) {
                document.getElementById("err_phone").style.display = "block";
                return false;
            }

            document.getElementById("err_phone").style.display = "none";
        });
    </script>
    <script>
        let span = document.getElementsByClassName("close")[0];
        let modal = document.getElementById("model2");
        span.onclick = function() {
            modal.style.display = "none";
        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbkfxLAeub3xTaYSuUUGH_Thhd-klQQCk&libraries=places">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{ asset('js/map10.js') }}"></script>
@endsection
