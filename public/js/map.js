const defaultLocation = new google.maps.LatLng(15.3752, 73.8255);
let input = "Mopa Goa International Airport, Mopa, Goa, India";

var input2 = document.getElementById("c_to");
var autocomplete2 = new google.maps.places.Autocomplete(input2);

var myLatLng = { lat: 15.3752, lng: 73.8255 };
var mapOptions = {
    center: myLatLng,
    zoom: 7,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
};

const myForm = document.getElementById("my-form");
let directionsService = new google.maps.DirectionsService();
const geocoder = new google.maps.Geocoder();

// Add an event listener to the form submission event
myForm.addEventListener("submit", function (event) {
    event.preventDefault();


    calc();
});
async function get_category() {
    const url = "http://localhost:8000/api/get_category";
    // Storing response
    const response = await fetch(url);

    // Storing data in form of JSON
    let data = await response.json();

    return data;
}

// function availability(params) {
//     const url = 'http://localhost:8000/api/availability';
//     const data =
//     {
//         category:   document.getElementById("c_vehicle").value,

//     };
//     const options = {
//       method: 'POST',
//       headers: { 'Content-Type': 'application/json' },
//       body: JSON.stringify(data)
//     };

//     fetch(url, options)
//       .then(response => response.json())
//       .then(data => console.log(data))
//       .catch(error => console.error(error));

// }

function calc() {



    //create request
    let request = {
        origin: defaultLocation,
        destination: document.getElementById("c_to").value,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
    };


    directionsService.route(request, async function (result, status) {

        if (status == google.maps.DirectionsStatus.OK) {
              document.getElementById("err_location").style.display = "none";

            document.getElementById("to_loaction").value =
                document.getElementById("c_to").value;

            document.getElementById("to").textContent =
                document.getElementById("c_to").value;

            document.getElementById("from_loaction").value = input;
            document.getElementById("from").textContent = input;

            const distanceText = result.routes[0].legs[0].distance.text;
            const distanceWithoutUnit = distanceText.replace("km", "");

            console.log(distanceWithoutUnit);

            document.getElementById("distance").value =
                    distanceWithoutUnit

            document.getElementById("travel_distance").textContent =
                result.routes[0].legs[0].distance.text;

            document.getElementById("travel_time").value =
                result.routes[0].legs[0].duration.text;

            document.getElementById("travel_timing").textContent =
                result.routes[0].legs[0].duration.text;

                document.getElementById("name").value =
                document.getElementById("c_name").value;

            document.getElementById("fullname").textContent =
                document.getElementById("c_name").value;

            document.getElementById("phone").value =
                document.getElementById("c_phone").value;

            document.getElementById("phone_no").textContent =
                document.getElementById("c_phone").value;

            document.getElementById("category").value =
                document.getElementById("c_vehicle").value;

            let category = await get_category();
            const now = new Date();
            const cutoffTime = new Date();
            const cutoffTime2 = new Date();
            cutoffTime.setHours(19, 0, 0);
            cutoffTime2.setHours(6, 0, 0);
            let night_charges = 0
            if (now > cutoffTime &&  cutoffTime2 < now) {
                night_charges = 300
            }


            category.forEach((element) => {
                if (element.id == document.getElementById("c_vehicle").value) {
                    document.getElementById("car_type").textContent =
                        element.type;

                    let fair =
                        element.fair * distanceWithoutUnit +
                        night_charges;
                      let gst = (5 / 100) * fair
                      let total_amount = fair + gst
                    console.log(fair);

                    document.getElementById("night_charges").value =night_charges
                    document.getElementById("total_amount").textContent=Math.round(total_amount)
                    document.getElementById("fair").value=Math.round(total_amount)

                }
            });

            let modal = document.getElementById("myModal");

            let span = document.getElementsByClassName("close")[0];

            modal.style.display = "block";

            span.onclick = function () {
                modal.style.display = "none";
            };

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };


        } else {
            document.getElementById("err_location").style.display = "block";
            return false;
        }
    });

    geocoder.geocode({ address: input2.value }, (results, status) => {
        if (status === "OK") {
            const location = results[0].geometry.location;
            const lat = location.lat();
            const lng = location.lng();

            console.log("Latitude:", lat);
            console.log("Longitude:", lng);
            document.getElementById("coordinate").value = `${lat},${lng}`;
        } else {
            console.log(
                "Geocode was not successful for the following reason: " + status
            );
        }
    });

    //   document.getElementById("c_data").submit();
}






