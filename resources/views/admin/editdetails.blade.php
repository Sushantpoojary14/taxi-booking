@extends('admin.layouts.app')
@section('content')
    <section class="container px-4 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-7 flex flex-col w-full m-auto">
            <div class="text-center ">
                <h1 class="block w-100 text-2xl md:text-4xl lg:text-4xl font-bold title-font text-zinc-900">
                    Edit Customer Bill
                </h1>
            </div>
            <form method="post" id="form" action='{{ route('admin.updatedetails') }}' class="w-full">
                @csrf
                <input type="hidden" id="fair" name="fair">
                <input type="hidden" id="total_fair" name="total_fair">
                <input type="hidden" id="id" name="id" value="{{ $customer->relation_id }}">
                <input type="hidden"  name="invoice_id" value="{{ $customer->invoice_id }}">
                <div class="mt-4 w-full text-lg font-medium flex flex-col space-y-3">
                    <p>Full Name: <span class="font-normal">{{ $customer->fullname }}</span></p>
                    <p>Invoice Id: <span class="font-normal">{{ $customer->invoice_id }}</span></p>
                    <p>Car Type:
                        <x-select-input id="car_type" onchange="available()" >
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $data->category_id ? 'selected' : '' }}>
                                    {{ $item->type }}
                                </option>
                            @endforeach
                        </x-select-input>
                    </p>
                    <p>Vehicles: 
                            <x-select-input id="Vehicle" onclick="driver()" class="w-32 px-2">
                            </x-select-input>
                    </p>
                    <p>To: <span id="to" class="font-normal">{{ $customer->location }}</span></p>

                    <p>Total Amount: <span id="total_amount" class="font-normal">{{ $customer->total_amount }}</span></p>
                </div>
                <div class="flex items-center mt-4 space-x-2">
                    <x-primary-button id="e_btn">
                        {{ __('Print') }}
                    </x-primary-button>
                    <a class ="inline-flex items-center  px-6 py-2  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-zinc-900 focus:bg-gray-700  active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 lg:8px text-center" onclick="window.location.href='{{ url('admin/generatebill') }}">
                        cancel
                    </a>
                </div>
            </form>

    </section>
@endsection
@section('script')
    <script>
         let select = document.getElementById('car_type');
         available()
        async function available() {
            let vehicle = document.getElementById('Vehicle');
            let data = {
                car_type: select.value
            }
            try {
                const response = await fetch("{{ url('/api/adminavailabilityapi') }}", {
                    method: "POST", // or 'PUT'
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });

                while (vehicle.options.length > 0) {
                    vehicle.remove(0);
                }

                const result = await response.json();
                if (result.driver.length != 0) {
                    result.driver.forEach(element => {
                        let option = document.createElement('option');
                        option.value = element.id;
                        option.innerHTML = element.vehicles.vehicle_number;
                        vehicle.appendChild(option);
                    });
                }
                else {
                    let option = document.createElement("OPTION");
                    option.innerHTML = "No Vehicle Available";
                    option.disabled = true;
                    vehicle.appendChild(option);
                    document.getElementById('id').value = {{$customer->relation_id}}
                }


                    result.category.forEach(element => {
                     if(select.value == element.id){
                                let fair = Math.round(element.fair * parseFloat({{$customer->distance}}));
                                let cgst = Math.round((result.price.cgst / 100) * fair);
                                let sgst = Math.round((result.price.sgst / 100) * fair);
                                let igst = Math.round((result.price.igst / 100) * fair);
                                let total_amount =
                                    fair +
                                    cgst +
                                    sgst +
                                    igst +
                                    parseInt(result.price.booking_charges) +
                                    parseInt(result.price.night_charges);
                                    document.getElementById('total_amount').innerHTML=total_amount;
                                    document.getElementById('fair').value = fair;
                                    document.getElementById('total_fair').value =total_amount;

                        }
                    });



            } catch (error) {
                console.error("Error:", error);
            }

        }

        function driver()
        {
            let vehicle = document.getElementById('Vehicle');
            console.log(vehicle.value);
                    if(vehicle.value){
                        document.getElementById('id').value = vehicle.value
                        }

        }

    </script>
@endsection
