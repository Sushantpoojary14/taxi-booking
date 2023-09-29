@extends('driver.layouts.app')
@section('css')
    <style>
        #button1 {
            background-color: rgb(24 24 27);
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        #top {
            padding: 10px;
            font-size: 20px;
            font-weight: 500;
            background-color: rgb(24 24 27);
            color: white;

        }
    </style>
@endsection
@section('content')
    <section class="w-full mx-auto px-6 lg:px-8 text-bold">
        <div class="m-auto w-100 flex flex-col  bg-gray-300 my-10">
                <div id="reader">
                </div>
        </div>
        <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />
        <div id="result" class="my-6">
            <form action="{{ route('driver.status') }}" method="post" id="myForm">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">

                <button id="buttonId" class="bg-teal-600 rounded-full px-2 m-2 " style="display: none">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('script')
     <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
    <script type="text/javascript">
        let flag = false;

        onScanSuccess('dadadad').then((data) => {
            console.log(data);
        }).catch((err) => {
            console.log(err);
        });

        async function onScanSuccess(qrCodeMessage) {
            const url =
                "{{ url('api/qrcodeapi') }}";

            const response = await fetch(url);

            let data = await response.json();
            console.log("reponse " + data.qrcode);

            if (qrCodeMessage == data.qrcode) {
                console.log('inside')
                if (!flag) {
                    document.getElementById("myForm").submit();
                    flag = true;
                } else {
                    flag = false;


                }


            }

        }

        function onScanError(errorMessage) {

        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
@endsection
