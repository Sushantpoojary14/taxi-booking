<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        img{
                width: 75%;
                margin:auto;
                padding-top:5%
        }

    </style>
</head>

<body>


    <div >
        <p id="qrcode" class="w-full  md:w-4/5 lg:w-2/5 m-12 ">

        </p>
    </div>

    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script>
        let qrcode = new QRCode("qrcode");



        code();

        async function code() {

            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < charactersLength) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }
            let p = document.createElement("p");

            // document.getElementById("random").value = result;

            let elText = result;
            qrcode.makeCode(elText);

            let result_data = {
                code: result
            }

            let url = "{{url('/api/qrcodeapi')}}"
            await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(result_data)
                })
                .then(response => response.json())
                .then(data => {
                   console.log(data);
                })
                .catch(error => console.error(error));
        }


           setInterval(function() {
                code();
            }, 1000000);


        // makeCode();
    </script>
</body>

</html>
