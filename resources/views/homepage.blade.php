<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="m-auto w-100 flex flex-col">
                        <div class="m-auto  w-full"  id="camera">

                            <div class="w-full md:w-100 lg:w-100 " id="reader">

                            </div>
                        </div>
                        {{-- <div id="time"></div><br>
                        <div id="date"></div> --}}
                        <x-input-error :messages="$errors->get('driver_id')" class="mt-2" />

                        <div class="m-auto  w-100 ">
                            <div id="result" class="my-10">
                                <form action="{{ route('driver.store') }}" method="post" id="myForm">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="time" id="time" value="">
                                    {{-- <input type="hidden" name="date" id="date" value=""> --}}

                                    <button id="buttonId" class="bg-teal-600 rounded-full px-2 m-2 "
                                        style="display: none">Submit</button>
                                </form>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function displayTime() {
            var currentTime = new Date().toLocaleString();
            document.getElementById("time").value = currentTime;

        }

        // var auto_refresh = setInterval(function() {
        //     window.location.reload();
        //     }, 100000);

        displayTime();
        // setInterval(displayTime, 1000);
        let flag = false;

        function onScanSuccess(qrCodeMessage) {
            console.log(qrCodeMessage)
            console.log(@json($code->qrcode))
            if (qrCodeMessage == @json($code->qrcode)) {
                if (!flag) {

                    document.getElementById("myForm").submit();
                    flag = true;
                } else {
                    flag = false;
                    // document.getElementById('result').innerHTML = '<span class="result">' + "Not match" + '</span>';

                }


            }

        }

        function onScanError(errorMessage) {
            //handle scan error
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
</x-app-layout>
