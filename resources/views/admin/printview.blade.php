@extends('admin.layouts.app')
@section('style')
    <STYLE>
        li,
        p,
        td {
            font-size: 12px;
        }

        td,
        th,
        tr,
        table {

            border-top: 1px solid black;
            border-collapse: collapse;
            padding: 2px;
        }

        td.description,
        th.description {
            width: 85px;
            max-width: 85px;
        }

        td.quantity,
        th.quantity {
            width: 60px;
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
            width: 283.46px;
            margin: auto;
            /* max-width: 155px; */
        }



        @media print {

            .hidden-print,
            #header,
            h1,
            #btnprn,#edit,
            .hidden-print * {
                display: none !important;
            }
        }
    </STYLE>
@endsection
@section('content')
    <div class="py-1  lg:w-full md:w-full ">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:dark:text-gray-100 ">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-0 mx-auto ">
                            <div class="flex flex-col text-center  mb-6 ">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 dark:text-white  pb-3">Print
                                    Details
                                </h1>

                            </div>
                            <div class="lg:w-11/12 w-full mx-auto  text-sm ">
                                {{-- <form action="" method="post" class="m-0 p-0"> --}}
                                {{-- <input type="hidden" name="id" value="{{ $data->id }}"> --}}
                                {{-- @csrf --}}
                                <div class="lg:w-11/12 md:w-2/3 mx-auto  ">

                                    <div class="flex flex-row flex-wrap -m-2">
                                        <div class="ticket dark:text-green-50 font-medium">

                                            <h2 class="text-center text-lg mb-4">AutoFurze Taxi Counter
                                                {{-- <br>Address line 1
                                                    <br>Address line 2 --}}
                                            </h2>
                                            <ul>

                                                <li>Customer Name: {{ ' ' . $customer->fullname }}</li>
                                                <li>Booking ID: {{ ' ' . $customer->id }}</li>
                                                <li>Date: {{ ' ' . $currentDate }}</li>


                                                @foreach ($data->vehicles as $item)
                                                    <li>Vechicle Number:{{ ' ' . $item->car_number }}</li>
                                                @endforeach
                                                @foreach ($data->driver as $item)
                                                    <li>Driver Name:
                                                        {{ ' ' . $item->firstname . ' ' . $item->lastname }}
                                                    </li>
                                                    <li>Driver Contact: {{ ' ' . $item->phone }}</li>
                                                @endforeach
                                                @foreach ($data->category as $item)
                                                    <li>Vehcile Type:{{ ' ' . $item->type }}</li>
                                                @endforeach

                                                <li>From: Mopa Goa International Airport, Mopa-Goa </li>
                                                <li>To: {{ ' ' . $customer->location }}</li>
                                            </ul>
                                            <table class="my-4">
                                                <thead>
                                                    <tr>
                                                        <th class="quantity"></th>
                                                        <th class="description">Description</th>
                                                        <th class="price">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="quantity">A</td>
                                                        <td class="description">Fair Charges (Rs)</td>
                                                        <td class="price">{{ $detail['fair'] }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="quantity">B</td>
                                                        <td class="description">Night Charges (Rs)</td>
                                                        <td class="price">
                                                            {{ $detail['night_fair'] == 0 ? '0' : $detail['night_fair'] }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="quantity"></td>
                                                        <td class="description">*GST @5% on A & B (Rs)</td>
                                                        <td class="price">{{ $gst }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="quantity"></td>
                                                        <td class="description">Parking Charges (Rs)</td>
                                                        <td class="price">
                                                            {{ $detail['parking_charges'] }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="quantity"></td>
                                                        <td class="description">TOTAL</td>
                                                        <td class="price">Rs.{{ $total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <ul>
                                                <li>Amount Paid(Rs): Rs{{ ' ' . $total }}</li>
                                                <li>Mode of Payment:{{ ' ' . $detail['payment'] }}</li>
                                            </ul>
                                            <p>
                                                helpdesk Number:
                                            </p>
                                            <p>
                                                helpdesk Email:
                                            </p>
                                            <p>
                                                GSTIN:
                                            </p>
                                        </div>

                                        <div class="p-2 w-full flex px-96   justify-evenly space-x-3">
                                            <form action="{{ url('admin/dispatch/' . $id) }}" method="/get" id="myForm">
                                                {{-- <input type="hidden" name="id" value="{{ $id }}"> --}}
                                            </form>


                                            <button
                                                class="flex mx-auto text-white bg-green-500 border-0 py-1 px-6 focus:outline-none mt-8 hover:bg-indigo-600 rounded text-base mr-4"
                                                class="btnprn" id="btnprn" onclick="myFunction()">
                                                Print
                                            </button>

                                            <form action="{{ url('/admin/printedit/' . $id) }}" method="post" >
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $customer->id }}">
                                                <input type="hidden" name="fullname" value="{{ $customer->fullname }}">
                                                <input type="hidden" name="fair" value="{{ $detail['fair'] }}">
                                                <input type="hidden" name="night_fair"
                                                    value="{{ $detail['night_fair'] }}">
                                                <input type="hidden" name="location" value="{{ $customer->location }}">
                                                <input type="hidden" name="payment" value="{{ $detail['payment'] }}">
                                                <input type="hidden" name="parking_charges"
                                                    value="{{ $detail['parking_charges'] }}">

                                                <button
                                                    class="flex mx-auto text-white bg-red-500 border-0 py-1
                                                px-6 focus:outline-none mt-8 hover:bg-indigo-600 rounded text-lg" id="edit">
                                                    Edit
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            document.getElementById("btnprn").addEventListener("click", function() {
                window.print();
                document.getElementById("myForm").submit();
            });

        };
        window.onload = function() {
            document.forms['reload'].submit();
        }
    </script>
@endsection
