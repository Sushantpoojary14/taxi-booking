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

        .modal2 {

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

                            <option disabled selected hidden>Vehicle/Fair</option>

                            @if ($data == null)
                                <option
                                    class=" border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 my-4 font-medium px-1 text-lgtransition-colors duration-200 ease-in-out"
                                    disabled>No Vehicles Available </option>
                            @else
                                @foreach ($data as $key => $item)
                                    @foreach ($category as $item2)
                                        @if ($item2 == $item->id)
                                            <option
                                                class=" border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none text-gray-700 my-4 font-medium px-1 text-lgtransition-colors duration-200 ease-in-out"
                                                value="{{ $item->id }}">
                                                {{ $item->type . ' - Rs.' . $item->fair . '/km' }}


                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        </select>

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
        @if ($message = Session::get('success'))
            <div id="model2" class="modal2">
                {{-- <div class="relative w-full h-full max-w-2xl md:h-auto"> --}}

                <div class=" .modal-content w-80 m-auto ">
                    <a class="close px-2">&times;</a>
                    <div class="h-full bg-gray-300 p-8 rounded ">
                        <p class="text-center text-2xl font-bold mb-3">Sucessfully Booked</p>
                        <p class="text-center text-sm mb-3">Thank you For Booking from AutoFurze</p>

                        <p class="text-4xl font-semibold"><svg class="m-auto " id="changeColor" fill="green" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" zoomAndPan="magnify" viewBox="0 0 375 374.9999" height="50" version="1.0"><defs><path id="pathAttribute" d="M 11.972656 11.972656 L 359.222656 11.972656 L 359.222656 359.222656 L 11.972656 359.222656 Z M 11.972656 11.972656 "></path></defs><g><path id="pathAttribute" d="M 185.597656 359.222656 C 89.675781 359.222656 11.972656 280.984375 11.972656 185.597656 C 11.972656 90.210938 89.675781 11.972656 185.597656 11.972656 C 281.519531 11.972656 359.222656 89.675781 359.222656 185.597656 C 359.222656 281.519531 280.984375 359.222656 185.597656 359.222656 Z M 185.597656 22.691406 C 95.570312 22.691406 22.691406 95.570312 22.691406 185.597656 C 22.691406 275.625 95.570312 348.503906 185.597656 348.503906 C 275.625 348.503906 348.503906 275.625 348.503906 185.597656 C 348.503906 95.570312 275.089844 22.691406 185.597656 22.691406 Z M 185.597656 22.691406 " fill-opacity="1" fill-rule="nonzero"></path></g><g id="inner-icon" transform="translate(85, 75)"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="199.8" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="199.8" preserveAspectRatio="xMidYMid meet" version="1.0" id="IconChangeColor"><defs><clipPath id="id1"><path d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 " clip-rule="nonzero" id="mainIconPathAttribute"></path></clipPath></defs><g clip-path="url(#id1)"><path fill="rgb(13.729858%, 12.159729%, 12.548828%)" d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 " fill-opacity="1" fill-rule="nonzero" id="mainIconPathAttribute"></path></g></svg></g></svg></p>

                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{-- </div> --}}
                </div>
            </div>
        @endif
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
                    </span></p>
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
    <script>
        function preventBack() {
            window.history.forward();

        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
    <script>
        // get_category()

        // async function get_category() {
        //     const url = "http://localhost:8000/api/availability";
        //     // Storing response
        //     const response = await fetch(url);

        //     // Storing data in form of JSON
        //     let data = await response.json();



        //     let arr = data[1]
        //     console.log(arr);
        //    for (let index = 0; index < arr.length; index++) {


        //         let category = data[0].filter(element => arr[index]==element.id)
        //     };
        //     console.log(arr);
        //     // foreach(arr as $item) {

        //         // let category = data[0].filter(element => data[1]==element->id)

        //         // foreach($category as $item2) {
        //         //     if ($item2 == $item - > id){

        //         //     }
        //         // }
        //     // }


        // }
        let span = document.getElementsByClassName("close")[0];
        let modal = document.getElementById("model2");
        span.onclick = function() {
            modal.style.display = "none";
        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbkfxLAeub3xTaYSuUUGH_Thhd-klQQCk&libraries=places">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{ asset('js/map.js') }}"></script>
@endsection
