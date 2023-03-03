@extends('customer.layouts.app')
@section('css')
    <style>
        #googleMap {
            width: 80%;
            height: 400px;
            margin: 10px auto;
        }

        /*output box*/
        #output {
            text-align: center;
            font-size: 2em;
            margin: 20px auto;
        }
    </style>
    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            transition-delay: 1s;
        }

        /* The Close Button */
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
    <section class="text-gray-600 body-font font-bold">
        <div class="container px-5 py-10 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <h6 class="leading-relaxed mt-4">Need a ride? just call</h6>
                <h1 class="title-font font-medium text-3xl text-gray-900">
                    911 999 911
                </h1>
                <p class="leading-relaxed mt-4">
                    Whether you enjoy city breaks or extended holidays in the sun, you can always improve your travel
                    experiences by staying in a small.
                </p>


            </div>
            <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Book Your Texi Online!</h2>
                <form id="my-form">

                    <div class="relative mb-4">

                        <input type="text" id="c_name" name="c_name"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            placeholder="Full Name" required>

                        {{-- <p class="text-sm text-red-700 p-2" id="err_name" style="display: none">*Name Field is reuired</p> --}}
                    </div>

                    <div class="relative mb-4">

                        <input type="text" id="c_phone" name="c_phone"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            placeholder="Phone Number" required>

                        {{-- <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none" >*Phone Number Field is reuired</p> --}}

                    </div>
                    <div class="relative mb-4">

                        <select name="text" id="c_vehicle" name="c_vehicle"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            required>

                            <option
                                class="w-1/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-200 py-1 px-1 transition-colors duration-200 ease-in-out"
                                value=""disabled selected hidden>Vehicle/Fair</option>
                            @foreach ($data as $item)
                                <option
                                    class="w-1/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-1 transition-colors duration-200 ease-in-out"
                                    value="{{ $item->id }}">{{ $item->type }} {{ ' Rs.' . $item->fair }}</option>
                            @endforeach
                        </select>
                        {{-- <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none">*Vehicle Field is reuired</p> --}}
                    </div>
                    <div class="relative mb-4">

                        <input type="text" id="c_to" name="c_to"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            placeholder="Location" required>

                        <p class="text-sm text-red-700 p-2" id="err_location" style="display: none">*No Location Found</p>
                    </div>

                    <button
                        class=" w-full text-white bg-indigo-800 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                        id="btn">Book Now</button>

            </div>
            </form>
        </div>
    </section>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="mx-2 text-lg font-medium space-y-1">
                <p>Name: <span id="fullname" class="font-normal">hell</span> </p>
                <p>Phone Number: <span id="phone_no" class="font-normal"></span></p>
                <p>Car Type: <span id="car_type" class="font-normal"></span></p>
                <p>From: <span id="from" class="font-normal">
                    </span></p>
                <p>To: <span id="to" class="font-normal">
                        Quis.</span></p>
                <p>Distance: <span id="travel_distance" class="font-normal"></span></p>
                <p>Travel Time: <span id="travel_timing" class="font-normal"></span></p>
                <p>Total Amount: <span id="total_amount" class="font-normal"></span></p>
                <form action="{{ route('payment') }}" method="post" id="c_data">
                    @csrf
                    <input type="hidden" id="from_loaction" name="from_loaction">
                    <input type="hidden" id="to_loaction" name="to_loaction">
                    <input type="hidden" id="distance" name="distance">
                    <input type="hidden" id="travel_time" name="travel_time">
                    <input type="hidden" id="name" name="name">
                    <input type="hidden" id="phone" name="phone">
                    <input type="hidden" id="category" name="category">
                    <input type="hidden" id="fair" name="fair">
                    <input type="hidden" id="coordinate" name="coordinate">
                    <input type="hidden" id="night_charges" name="night_charges">
                    <div class="flex justify-around mt-3 lg:mx-44 md:mx-44 sm:mx-44 ">
                        <a
                            class="text-white bg-red-500 border-0 py-1 px-4 lg:py-2 lg:px-8 md: focus:outline-none hover:bg-red-600 rounded text-sm lg:text-lg close hover:text-white">Cancel</a>

                        <button id="form"
                            class="text-white bg-indigo-800 border-0 py-1 px-5 lg:py-2 lg:px-8  focus:outline-none hover:bg-indigo-600 rounded text-sm lg:text-lg">Book</button>

                    </div>

                </form>
            </div>

        </div>

    </div>
@endsection


@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbkfxLAeub3xTaYSuUUGH_Thhd-klQQCk&libraries=places">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{ asset('js/map.js') }}"></script>
@endsection
