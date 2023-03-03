@extends('customer.layouts.app')
@section('css')
    <style>
        /* The Modal (background) */
        .modal {
            /* display: none; */
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
    <div class="h-96">
        <form action="{{route('billview')}}" method="post" id="dataform">
        @csrf
        <input type="hidden" name="customer" value="{{json_encode($customer)}}">
        <input type="hidden" name="transaction_details" value="" id="transaction_details">
        </form>
    </div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <a class="close" href="http://localhost:8000/">&times;</a>
            <div class="h-full bg-gray-100 p-8 rounded mb-2">
                <p class="text-center font-medium">Total Amount To Pay:</p>

                <p class="text-4xl font-semibold text-center">₹ {{ $payment_details->notes->fair }}</p>

            </div>

            <button id="rzp-button1"
                class="w-full text-white bg-indigo-800 border-0 py-3 px-5 lg:py-2 lg:px-8  focus:outline-none hover:bg-indigo-600 text-lg">Pay</button>
        </div>

    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

        let options = {
            "key": "rzp_test_Pd1uy6stEdFpMs",
            "amount": "{{ $payment_details->amount }}",
            "currency": "INR",
            "name": "Autofurze Taxi Booking",
            "description": "Test Transaction",
            "image": "https://example.com/your_logo",
            // "order_id": "order_9A33XWu170gUtm",
            "handler": function(response){
                    document.getElementById('transaction_details').value=JSON.stringify(response)
                    document.getElementById('dataform').submit()
                    document.getElementById('myModal').style.display="none"
           }
            ,
            "prefill": {
                "name": "{{ $payment_details->notes->name }}", //your customer's name
                "email": "",
                "contact": "{{ $payment_details->notes->phone }}"
            },
            "notes": {
                "address": "Razorpay Corporate Office"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
@endsection
