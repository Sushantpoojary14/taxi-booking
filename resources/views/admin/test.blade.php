<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img{
                width: 30%;
                margin:auto;
                padding-top:5%

        }
    </style>
</head>

<body>

    <form action="{{ route('random') }}" method="post" id="form" name="form">
        @csrf
        <input id="random" type="hidden" name='code' />

    </form>


        <div id="qrcode" >

        </div>







    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    {{-- <script>
        var qrcode = new QRCode("qrcode");

        let code = @json($code)

        if (code == null) {
            var auto_refresh = setInterval(function() {
                random();
            }, 10000);

        }
        samecode(code);

        function random(code) {


            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < charactersLength) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }


            document.getElementById("random").value = result

            var elText = result;

            if (!elText) {
                alert("Input a text");
                elText.focus();
                return;
            }
            qrcode.makeCode(elText);

            let form = document.querySelector('form');
            HTMLFormElement.prototype.submit.call(form);

        }

        function samecode(code) {


            var elText = code;

            if (!elText) {

                elText.focus();
                return;
            }
            qrcode.makeCode(elText);

            var auto_refresh = setInterval(function() {
                random();
            }, 100000);
        }




        makeCode();


    </script> --}}
    <script>
        let currentPage = 0;
        let rowsPerPage = 10;
        test(1)
        async function test(page) {
            let startIndex = page * rowsPerPage;
            let endIndex = startIndex + rowsPerPage;
            let data
            const page_data = {
                start: startIndex,
                last: endIndex

            };
            console.log(page_data);
            await fetch("{{ url('api/test') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(page_data)
                })
                .then(response => response.json())
                .then(data2 => {
                    console.log(data2);
                   data =data2
                })
                .catch(error => console.error(error));
        }
    </script>
</body>

</html>
