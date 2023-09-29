@extends('customer.layouts.app')
@section('css')
    <style>
        /* The Modal (background) */
        .modal {

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
    <div id="myModal" class="modal" class="md:w-8/12 lg:w-8/12">
        <div class="modal-content" id="modal-content" >
            <a class="close" href="{{ route('home') }}">&times;</a>
            <div class="h-full bg-gray-100 p-8 rounded mb-2 ">
                <p class="text-center text-2xl font-bold mb-3">Payment Failed ! </p>
                <p class="text-center text-sm mb-3">Please try again </p>
                <img src="{{ asset('assets/red-x-icon.png') }}" alt="" class="w-10 m-auto">
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

    document.getElementById('dataform').submit()
</script>
@endsection
