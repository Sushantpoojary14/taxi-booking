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
                <form action="{{ url('/create') }}" method="post">
                    @csrf
                    <div class="relative mb-4">
                        {{-- <label for="firstname" class="leading-7 text-sm text-gray-600">Full Name</label> --}}
                        <input type="text" id="firstname" name="firstname"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="Full Name">
                    </div>

                    <div class="relative mb-4">
                        {{-- <label for="phone" class="leading-7 text-sm text-gray-600">Phone</label> --}}
                        <input type="text" id="phone" name="phone"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="Phone Number">
                    </div>
                    <div class="relative mb-4">
                        {{-- <label for="vehicle" class="leading-7 text-sm text-gray-600">Vehicle/Fair</label> --}}
                        <select name="text" id="vehicle" name="vehicle"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" >

                            <option class="w-1/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-200 py-1 px-1 transition-colors duration-200 ease-in-out" value=""disabled selected hidden>Vehicle/Fair</option>
                            @foreach ($data as $item)
                            <option class="w-1/5 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-1 transition-colors duration-200 ease-in-out" value="">{{$item->type}} {{" Rs.".$item->fair}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="relative mb-4">
                        {{-- <label for="location" class="leading-7 text-sm text-gray-600">Location</label> --}}
                        <input type="text" id="to" name="to"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="Location">
                    </div>
                    {{-- <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div> --}}
                    <input type="hidden" id="from" name="from">
                    <button
                        class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" onclick="calcRoute();">Submit</button>

            </div>
            </form>
        </div>
    </section>
@endsection


@section('script')
    <script>
        // let data = @json($json);
        // let data2 = JSON.parse(data);
        // // console.log(data2[0])
        // for (item in data2) {
        //     let option = document.createElement("option");

        //     option.value = data2[item].driver[0].id;
        //     option.text = data2[item].driver[0].type_of_car + ` -  Rs. ` + data2[item].driver[0].fair;
        //     document.getElementById("vehicle").appendChild(option);
        // };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBxQyF9Te6OipCOdRON1li2m6e1_CMkTo&libraries=places">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection
