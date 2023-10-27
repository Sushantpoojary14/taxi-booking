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
    <section class="text-white body-font font-bold ">
        <div class="container px-5 py-10 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">

                <h6 class="leading-relaxed mt-4 ">Need a ride? just call</h6>
                <h1 class="title-font font-medium text-3xl text-yellow-400">
                    8806224400
                </h1>
                <p class="leading-relaxed mt-4">
                    Whether you enjoy city breaks or extended holidays in the sun, you can always improve your travel
                    experiences by staying in a small.
                </p>


            </div>
            <div class="lg:w-2/6 md:w-1/2 bg-yellow-400 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Book Your Taxi Online!</h2>
                <form action="{{ route('payment') }}" method="post" id="c_data">
                    @csrf
                    <div class="relative mb-4">

                        {{-- <select name="text" id="c_vehicle" name="c_vehicle" --}}
                        <select id="c_vehicle" name="category"
                            class="w-full bg-white rounded border border-gray-300 focus:border-black text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out"
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
                            class=" w-full text-white border-0 py-2 px-8 focus:outline-none rounded text-lg transition ease-in-out delay-150 bg-black hover:bg-indigo-500 duration-300"
                            id="btn">Book Now</button>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    </div>
                    <p class="text-sm text-red-700 p-2 mt-5" >Disclaimer</p>
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
       <x-success-model/>

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
                            option.innerHTML = `${element.type}  -  ${element.fair}/per day` ;
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
