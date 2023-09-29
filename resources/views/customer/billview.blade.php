@extends('customer.layouts.app')
@section('css')
<STYLE>
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
        width: 80%;
        border-top: 1px solid black;
        border-collapse: collapse;
        padding: 2px;
    }

    td.description,
    th.description {
        width: 120px;
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
        width: 500px;
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
        .hidden-print * {
            display: none !important;
        }
    }

    @media screen {
        p.bodyText {
            font-family: verdana, arial, sans-serif;
        }
    }

    @media print {
        p.bodyText {
            font-family: georgia, times, serif;
        }
    }

    @media screen,
    print {
        p.bodyText {
            font-size: 10pt
        }
    }

    .modal2 {
            /* display: none; */
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
</STYLE>
@endsection
@section('content')
    <section class="text-indigo-900 body-font relative mx-5  my-16 lg:my-60 md:my-60 border-b">
        <div class="bg-gray-50 rounded-lg p-2 flex flex-col w-full m-auto md:w-8/12 lg:w-8/12">
            <div class="flex flex-col text-center w-full my-5">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-indigo-900">Booking
                    Details
                </h1>

            </div>
            <div class="w-full  mx-auto text-sm text-indigo-900">

                <div class="w-full mx-auto text-indigo-900">

                    <div class="flex flex-row flex-wrap p-3 w-full">

                        <div class="ticket font-medium ">

                            <h2 class="text-center text-lg">Auto Furze Travel Private Limited Solutions
                            </h2>
                            <p class="text-center text-sm mb-4">Manohar International Airport, Mopa Goa
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
                                <li>Distance: {{ ' ' . $customer->distance }}</li>
                            </ul>
                            <table class="my-4">
                                <thead>
                                    <tr>
                                        <th class="quantity"></th>
                                        <th class="description">Description</th>
                                        <th class="price text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="quantity">A</td>
                                        <td class="description">Fair Charges (Rs)</td>
                                        <td class="price  text-center">
                                            {{ $customer->amount }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="quantity">B</td>
                                        <td class="description">Night Charges (Rs)</td>
                                        <td class="price text-center">
                                            {{ $customer->night_charges }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">*CGST @ {{ $price->cgst }}% on A & B (Rs)
                                        </td>
                                        <td class="price text-center">
                                            {{ round(($price->cgst / 100) * $customer->amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">*SGST @ {{ $price->sgst }}% on A & B (Rs)
                                        </td>
                                        <td class="price text-center">
                                            {{ round(($price->sgst / 100) * $customer->amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">*IGST @ {{ $price->igst }}% on A & B (Rs)
                                        </td>
                                        <td class="price text-center">
                                            {{ round(($price->igst / 100) * $customer->amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">Parking/Toll (Rs)</td>
                                        <td class="price text-center">
                                            {{ $price->booking_charges }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="quantity"></td>
                                        <td class="description">TOTAL(Rs)</td>
                                        <td class="price text-center">Rs. {{ $customer->total_amount }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul>
                                <li>Amount Paid(Rs): Rs.{{ ' ' . $customer->total_amount }}</li>
                                <li>Mode of Payment:{{ ' ' . $customer->payment_mode }}</li>
                            </ul>
                            <p>
                               Helpdesk Number:+91 8806224400
                            </p>

                            <p class=" mt-2">
                                Tavel Securely with Us -
                                www.autofurze.com</p>
                        </div>

                        <div class="w-full flex justify-center  space-x-5">

                            <button
                                class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none mt-8 hover:bg-green-700 rounded text-lg"
                                class="btnprn" id="btnprn">
                                Download
                            </button>


                        </div>

                    </div>
                </div>
                </form>
            </div>

        </div>
        @if (Session('success'))
            <div id="model2" class="modal2">
                {{-- <div class="relative w-full h-full max-w-2xl md:h-auto"> --}}
                <div class=" .modal-content w-80 m-auto ">
                    <a class="close px-2" id="close">&times;</a>
                    <div class="h-full bg-gray-300 p-8 rounded ">
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
                let modal2 = document.getElementById("model2");
                span.onclick = function() {
                    modal2.style.display = "none";
                };
            </script>
        @endif
    </section>
    <script>
        document.getElementById("btnprn").addEventListener("click", function() {
            window.print();
        });

        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>

@endsection
