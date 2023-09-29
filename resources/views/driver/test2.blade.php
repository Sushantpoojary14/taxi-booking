<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <button onclick="getapi()">click</button>
    <div id="loading"></div>
    {{-- <script>
        const options = {
            method: 'POST',
            headers: {
                accept: 'application/json',
                'content-type': 'application/json',
                Authkey: '391731AO32MxYY6401992cP1'
            },
            body: JSON.stringify({
                template: '6406d54ad6fc052a053a3c52',
                sender_id: 'aUtoFu',
                template_name: 'autofurze',
                dlt_template_id: '1234',
                smsType: 'NORMAL'
            })
        };

        fetch('https://control.msg91.com/api/v5/sms/addTemplate', options)
            .then(response => response.json())
            .then(response => console.log(response))
            .catch(err => console.error(err));
    </script> --}}
</body>

</html>
