@extends('admin.layouts.app')
@section('style')
    {{-- <STYLE>
        li,
        p,
        td {
            font-size: 12px;
            padding: 1px;
        }

        td,
        th,
        tr,
        table {

            border-top: 1px solid black;
            border-collapse: collapse;
            padding: 2px;
            margin: auto;
            width: 100%;
        }

        td.description,
        th.description {
            width: 80px;

            max-width: 120px;
        }

        td.quantity,
        th.quantity {
            width: 30px;
            max-width: 60px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 60px;
            max-width: 60px;
            word-break: break-all;
        }



        .ticket {
            width: 100%;
            margin: auto;
            /* max-width: 155px; */
        }



        @media print {

            .hidden-print,
            #header,
            h1,
            #btnprn,
            #edit,
            #footer,
            img,
            .hidden-print * {
                display: none !important;
            }

            .print-80mm {
                width: 80mm;
              }
            article {
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            @page: first {
                margin: 0cm;
            }

            @page: last {
                margin: 0.5cm;
            }

            @page: left {
                margin: 0.1cm 0.1cm 0.1cm 0.1cm;
            }

            @page: right {
                margin: 0.1cm 0.1cm 0.1cm 0.1cm;
            }
        }
    </STYLE> --}}
    <style>
        .modal {
            /* display: none; */
            position: fixed;
            z-index: 3;
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
<section class=" text-black body-font mx-2 md:mx-auto lg:mx-auto  bg-gray-300 print-80mm">
        {{-- <div class=" w-full mb-5  py-1 mx-auto ">
            <div class=" px-4 space-y-5 my-5">
                <h1 class="block w-100 text-xl sm:text-2xl font-bold title-font text-center text-zinc-900">Edit/Print Details
                </h1>

            </div>
            <div class=" w-full mx-auto text-sm bg-gray-300 text-zinc-900">
                <div class="mx-auto ">
                    <div class="flex flex-row flex-wrap mx-5">
                        <div class="ticket font-medium">
                            <h2 class="text-center text-lg">Auto Furze Travel Solutions Pvt Ltd
                            </h2>
                            <p class="text-center text-sm mb-4">Manohar International Airport, Mopa
                                Goa
                            </p>
                            <ul>
                                <li>GST Number: {{ ' ' . $price->gst_number }}</li>
                                <li>Booking ID: {{ ' ' . $customer->id }}</li>
                                <li>Invoice ID: {{ ' ' . $customer->invoice_id }}</li>
                                <li>Date/Time:
                                    {{ ' ' . $customer->booking_date . ' ' . $customer->booking_time }}
                                <li>Guest Name: {{ ' ' . $customer->fullname }}</li>
                                </li>
                                <li>Guest Mobile: {{ ' ' . $customer->phone }}</li>
                                </li>
                                <li>Vechicle Number:{{ ' ' . $data->vehicles->vehicle_number }}</li>
                                <li>Chauffeur Name:
                                    {{ ' ' . $data->driver->firstname . ' ' . $data->driver->lastname }}
                                </li>

                                <li>Vehcile Type:{{ ' ' . $data->category->type }}</li>

                                <li>From: Mopa Goa International Airport, Mopa-Goa </li>
                                <li>To: {{ ' ' . $customer->location }}</li>
                                <li>Distance: {{ ' ' . $customer->distance }} KM</li>
                            </ul>
                            <table class="my-4 ">
                                <thead class="text-left">
                                    <tr>
                                        <th class="quantity"></th>
                                        <th class="description">Description</th>
                                        <th class="price text-center">Price (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="quantity">A</td>
                                        <td class="description">Fair Charges </td>
                                        <td class="price  text-center">
                                            {{ $customer->amount }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="quantity">B</td>
                                        <td class="description">Night Charges </td>
                                        <td class="price text-center">
                                            {{ $customer->night_charges }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">*CGST @ {{ $price->cgst }}% on A & B
                                        </td>
                                        <td class="price text-center">
                                            {{ round(($price->cgst / 100) * $customer->amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">*SGST @ {{ $price->sgst }}% on A & B
                                        </td>
                                        <td class="price text-center">
                                            {{ round(($price->sgst / 100) * $customer->amount) }}</td>
                                    </tr>

                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">Parking/Toll </td>
                                        <td class="price text-center">
                                            {{ $price->booking_charges }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">TOTAL</td>
                                        <td class="price text-center">Rs. {{ $customer->total_amount }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul>
                                <li>Amount Paid: Rs.{{ ' ' . $customer->total_amount }}</li>
                                <li>Mode of Payment: {{ ' ' . $customer->payment_mode }}</li>
                                <p class=" mt-2">
                                    Any extra KM due to change of route or drop location will be paid
                                    separately to the driver </p>
                            </ul>
                            <p>
                                Helpdesk Number: +91 8806224400
                            </p>

                            <p class=" mt-2">
                                Travel Securely with Us -
                                www.autofurze.com</p>

                            Thank You For Booking From Auto Furze</p>
                            <p class=" mt-2">
                        </div>

                        <div class="w-full flex justify-center  space-x-5 ">

                            <button
                                class=" text-white bg-green-500 border-0 py-2 px-8  focus:outline-none mt-8 hover:bg-green-700 rounded text-lg"
                                class="btnprn" id="btnprn">
                                Print
                            </button>

                        </div>

                    </div>
                </div>
                </form>
            </div>

        </div> --}}
    </section>
{{-- <script>
        document.getElementById("btnprn").addEventListener("click", function() {
            window.print();
            // window.location.href = "{{ route('admin.queue') }}"
        });
    </script> --}}

@endsection

@section('script')
    {{-- <script src="{{ asset('js/print.js') }}"></script> --}}
@endsection
