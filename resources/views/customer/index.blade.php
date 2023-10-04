@extends('customer.layouts.app')
@section('css')
    <style>
        #googleMap {
            width: 80%;
            height: 400px;
            margin: 10px auto;
        }

        #output {
            text-align: center;
            font-size: 2em;
            margin: 20px auto;
        }
    </style>
    <style>
        .modal {
            /* display: none; */
            /* display: block; */
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
    <section class="text-indigo-900 body-font font-bold ">
        <div class="container px-5 py-10 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">

                <h6 class="leading-relaxed mt-4">Need a ride? just call</h6>
                <h1 class="title-font font-medium text-3xl text-gray-900">
                    8806224400
                </h1>
                <p class="leading-relaxed mt-4">
                    Whether you enjoy city breaks or extended holidays in the sun, you can always improve your travel
                    experiences by staying in a small.
                </p>


            </div>
            <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Book Your Taxi Online!</h2>
                <form action="{{ route('payment') }}" method="post" id="c_data">
                    @csrf
                    <div class="relative mb-4">

                        {{-- <select name="text" id="c_vehicle" name="c_vehicle" --}}
                        <select  id="c_vehicle" name="category"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            required>

                            <option disabled selected hidden value="" id="default"></option>
                        </select>

                    </div>
                    <div class="relative mb-4">
                        <p>
                            <x-text-input type="text" id="name" name="name" placeholder="Customers Name"
                                required />
                        </p>

                    </div>

                    <div class="relative mb-4">
                        <x-text-input type="text" id="phone" name="phone" class="" placeholder="Phone Number"
                            required maxlength="10" />
                        <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none">*Invalid Number
                        </p>


                    </div>
                    <div class="relative mb-4">
                        <x-text-input type="text" id="days" name="days" class="" placeholder="Days"
                            required maxlength="10" />

                    </div>
                    <div class="relative mb-4">
                        <x-select-input id="payment" name="payment" class="w-full" required>
                            <option ption selected disabled hidden value="">Payment Option</option>
                            <option value="cash"> Cash </option>
                            <option value="upi"> UPI </option>
                            <option value="card"> Card </option>
                        </x-select-input>
                    </div>

                    {{-- <div class="relative mb-4">
                        <input type="text" id="c_to" name="c_to"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            placeholder="Location" required>

                        <p class="text-sm text-red-700 p-2" id="err_location" style="display: none">*No Location Found</p>
                    </div> --}}
                    <div class="relative mb-4">
                        <button
                            class=" w-full text-white border-0 py-2 px-8 focus:outline-none rounded text-lg transition ease-in-out delay-150 bg-blue-500 hover:bg-indigo-500 duration-300"
                            id="btn">Book Now</button>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

            </div>

            </form>

        </div>


    </section>
    {{-- <div id="myModal" class="modal">
        <div class="modal-content">
            <form action="{{ route('payment') }}" method="post" id="c_data">
                @csrf
                <div class="mx-2 text-lg font-medium space-y-2">

                    <p>
                        <x-text-input type="text" id="name" name="name" placeholder="Customers Name" required />
                    </p>
                    <p>
                        <x-text-input type="text" id="phone" name="phone" class="" placeholder="Phone Number"
                            required maxlength="10" />
                    <p class="text-sm text-red-700 p-2" id="err_phone" style="display: none">*Invalid Number
                    </p>
                    <p>Car Type: <span id="car_type" class="font-normal"></span></p>
                    <p>From: <span id="from" class="font-normal">
                        </span></p>
                    <p>To: <span id="to" class="font-normal">
                        </span></p>
                    <p>Distance: <span id="travel_distance" class="font-normal"></span></p>
                    <p>Travel Time: <span id="travel_timing" class="font-normal"></span></p>
                    <p>Total Amount: <span id="total_amount" class="font-normal"></span></p>

                    <input type="hidden" id="from_loaction" name="from_loaction">
                    <input type="hidden" id="to_loaction" name="to_loaction">
                    <input type="hidden" id="distance" name="distance">
                    <input type="hidden" id="travel_time" name="travel_time">
                    <input type="hidden" id="url" name="url">
                    <input type="hidden" id="permit" name="permit">
                    <input type="hidden" id="category" name="category">
                    <input type="hidden" id="fair" name="fair">
                    <input type="hidden" id="total_fair" name="total_fair">
                    <input type="hidden" id="c_token" name="c_token">
                    <input type="hidden" id="coordinate" name="coordinate">
                    <input type="hidden" id="night_charges" name="night_charges">
                    <div class="flex justify-around mt-3 lg:mx-44 md:mx-44 sm:mx-44 ">
                        <a
                            class="text-white bg-red-500 border-0 py-1 px-4 lg:py-2 lg:px-8 md: focus:outline-none hover:bg-red-600 rounded text-sm lg:text-lg close hover:text-white">Cancel</a>

                        <button id="form"
                            class="text-white bg-indigo-800 border-0 py-1 px-5 lg:py-2 lg:px-8  focus:outline-none hover:bg-indigo-600 rounded text-sm lg:text-lg">Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection
@if (Session('success'))
    <div id="myModal" class="modal">
        {{-- <div class="relative w-full h-full max-w-2xl md:h-auto"> --}}
        <div class=" .modal-content w-80 m-auto ">
            <a class="close px-2" id="close">&times;</a>
            <div class=" bg-gray-300 p-8 rounded ">
                <p class="text-center text-2xl font-bold mb-3">Sucessfully Booked</p>
                <p class="text-center text-sm mb-3">Thank you For Booking from AutoFurze</p>

                <p class="text-4xl font-semibold"><svg class="m-auto " id="changeColor" fill="green"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50"
                        zoomAndPan="magnify" viewBox="0 0 375 374.9999" height="50" version="1.0">
                        <defs>
                            <path id="pathAttribute"
                                d="M 11.972656 11.972656 L 359.222656 11.972656 L 359.222656 359.222656 L 11.972656 359.222656 Z M 11.972656 11.972656 ">
                            </path>
                        </defs>
                        <g>
                            <path id="pathAttribute"
                                d="M 185.597656 359.222656 C 89.675781 359.222656 11.972656 280.984375 11.972656 185.597656 C 11.972656 90.210938 89.675781 11.972656 185.597656 11.972656 C 281.519531 11.972656 359.222656 89.675781 359.222656 185.597656 C 359.222656 281.519531 280.984375 359.222656 185.597656 359.222656 Z M 185.597656 22.691406 C 95.570312 22.691406 22.691406 95.570312 22.691406 185.597656 C 22.691406 275.625 95.570312 348.503906 185.597656 348.503906 C 275.625 348.503906 348.503906 275.625 348.503906 185.597656 C 348.503906 95.570312 275.089844 22.691406 185.597656 22.691406 Z M 185.597656 22.691406 "
                                fill-opacity="1" fill-rule="nonzero"></path>
                        </g>
                        <g id="inner-icon" transform="translate(85, 75)"> <svg xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="199.8" zoomAndPan="magnify"
                                viewBox="0 0 30 30.000001" height="199.8" preserveAspectRatio="xMidYMid meet"
                                version="1.0" id="IconChangeColor">
                                <defs>
                                    <clipPath id="id1">
                                        <path
                                            d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 "
                                            clip-rule="nonzero" id="mainIconPathAttribute"></path>
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#id1)">
                                    <path fill="rgb(13.729858%, 12.159729%, 12.548828%)"
                                        d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 "
                                        fill-opacity="1" fill-rule="nonzero" id="mainIconPathAttribute"></path>
                                </g>
                            </svg></g>
                    </svg></p>
                <p class="border-b-2 my-3"></p>

            </div>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{-- </div> --}}
        </div>

    </div>
    <script>
        let span = document.getElementById("close");
        let modal = document.getElementById("myModal");
        span.onclick = function() {
            modal.style.display = "none";
        };
    </script>
@endif

@section('script')
    <script>
        const myForm = document.getElementById("my-form");

        const inputField = document.getElementById("phone");

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
        let permit = document.getElementById('c_permit');
        // let select2 = document.getElementById('c_vehicle');
        let select2 = document.getElementById('c_vehicle');

        index();

        async function index(para) {

            let optional = para ? para : null;
            const url = "{{ url('api/availabilityapi') }}";
            const json = {
                optional: optional
            }
            await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(json)
                })
                .then(response =>
                    response.json()
                )
                .then(data => {
                    console.log(data);
                    let data2 = data.category
                    let data3 = data.optional

                    while (select2.options.length > 0) {
                        select2.remove(0);
                    }


                    let option2 = document.createElement("OPTION");

                    option2.innerHTML = "Vehicle";
                    option2.value = "";
                    option2.disabled = true;
                    option2.selected = true;
                    option2.hidden = true;
                    select2.appendChild(option2);


                    if (data2.length != 0) {
                        data2.forEach((element, index) => {
                            let option = document.createElement("OPTION");
                            option.innerHTML = element.type;
                            option.value = element.id;
                            select2.appendChild(option);
                        })

                    } else {
                        let option = document.createElement("OPTION");
                        option.innerHTML = "No Vehicle Available";
                        option.disabled = true;
                        select2.appendChild(option);
                    }

                })
                .catch(error => console.error(error));


        }
        index()
    </script>
    {{-- <script>
        let span = document.getElementsByClassName("close")[0];
        let modal = document.getElementById("myModal");
        span.onclick = function() {
            modal.style.display = "none";
        };
    </script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbkfxLAeub3xTaYSuUUGH_Thhd-klQQCk&libraries=places">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="{{ asset('js/map11.js') }}"></script>
@endsection
