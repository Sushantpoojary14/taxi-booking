const defaultLocation = new google.maps.LatLng(15.7368, 73.8612);

let input = "Mopa Goa International Airport, Mopa, Goa, India";
let options = {
    componentRestrictions: { country: "in" },
};
let input2 = document.getElementById("c_to");
let autocomplete2 = new google.maps.places.Autocomplete(input2, options);

let myLatLng = { lat: 15.3752, lng: 73.8255 };
let mapOptions = {
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
    // let phone = document.getElementById("c_phone").value;
    // document.getElementById("err_phone").style.display = "none";
    // if (phone.length == 10) {
        calc();
        // return false;
    // }
    // document.getElementById("err_phone").style.display = "block";
});

async function get_category() {
    const url = "https://commcop.in/fleetmgmt/api/get_category";
    const response = await fetch(url);
    let data = await response.json();
    return data.category;
}

async function get_price() {
    const url = "https://commcop.in/fleetmgmt/api/price";
    const response = await fetch(url);
    let data = await response.json();
    // console.log(data.price);
    return data.price;
}

function calc() {
    let request = {
        origin: defaultLocation,
        destination: document.getElementById("c_to").value,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
    };

    directionsService.route(request, async function (result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            let destination = result.routes[0].legs[0].end_address;

            let encodedDestination  = destination.split(" ").join("+")
            console.log(
                `https://www.google.com/maps/dir/?api=1&origin=Manohar+International+Airport-Mopa,Goa,Airport+terminal,Casarvane+VP,Goa+403512,India&destination=${encodedDestination}&travelmode=Driving`
            );
            let url = `https://www.google.com/maps/dir/?api=1&destination=${encodedDestination}&travelmode=Driving`;

            document.getElementById("url").value = url

            document.getElementById("err_location").style.display = "none";

            document.getElementById("to_loaction").value =
                document.getElementById("c_to").value;

            document.getElementById("to").textContent =
                document.getElementById("c_to").value;

            document.getElementById("from_loaction").value = input;
            document.getElementById("from").textContent = input;

            const distanceText = result.routes[0].legs[0].distance.text;
            const distanceWithoutUnit = distanceText.replace("km", "");

            // document.getElementById("permit").value =
            // document.getElementById("c_permit").value;
            // console.log(distanceWithoutUnit);

            document.getElementById("distance").value = distanceWithoutUnit;

            document.getElementById("travel_distance").textContent =
                result.routes[0].legs[0].distance.text;

            document.getElementById("travel_time").value =
                result.routes[0].legs[0].duration.text;

            document.getElementById("travel_timing").textContent =
                result.routes[0].legs[0].duration.text;


            let token = Math.floor(Math.random() * 10000);
            document.getElementById("c_token").value = token;

            document.getElementById("category").value =
                document.getElementById("c_vehicle").value;

            let category = await get_category();

            let price = await get_price();

            const now = new Date();
            const cutoffTime = new Date();
            const cutoffTime2 = new Date();
            cutoffTime.setHours(19, 0, 0);
            cutoffTime2.setHours(6, 0, 0);
            let night_charges = 0;
            if (now > cutoffTime && cutoffTime2 < now) {
                night_charges = price.night_charges;
            }

            category.forEach((element) => {
                if (element.id == document.getElementById("c_vehicle").value) {
                    document.getElementById("car_type").textContent =
                        element.type;

                    let fair = Math.round(element.fair * distanceWithoutUnit);

                    let cgst = Math.round((price.cgst / 100) * fair);
                    let sgst = Math.round((price.sgst / 100) * fair);
                    let igst = Math.round((price.igst / 100) * fair);

                    let total_amount =
                        fair +
                        cgst +
                        sgst +
                        igst +
                        parseInt(price.booking_charges) +
                        parseInt(night_charges);
                    console.log(
                        "cgst: " + cgst + "  sgst: " + sgst + " igst: " + igst
                    );
                    console.log(fair);
                    console.log(total_amount);
                    document.getElementById("night_charges").value =
                        night_charges;
                    document.getElementById("total_amount").textContent =
                        total_amount;
                    document.getElementById("total_fair").value = total_amount;
                    document.getElementById("fair").value = fair;
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

            // console.log("Latitude:", lat);
            // console.log("Longitude:", lng);
            document.getElementById("coordinate").value = `${lat},${lng}`;
        } else {
            console.log(
                "Geocode was not successful for the following reason: " + status
            );
        }
    });

    //   document.getElementById("c_data").submit();
}
