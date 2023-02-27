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
        <script>


// Defining async function
async function getapi() {
    const url =
      "http://localhost:8000/test3";
    // Storing response
    const response = await fetch(url);

    // Storing data in form of JSON
    var data = await response.json();

    console.log(data.qrcode);
    
    if (response) {
        document.getElementById('loading').innerHTML = data.qrcode;
    }
    // show(data);
}

        </script>
</body>
</html>
