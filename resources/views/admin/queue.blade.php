@extends('admin.layouts.app')
@section('content')
    <section class="text-black body-font  mx-2 ">
        <div class=" text-center w-full mb-5 px-2 py-1 mx-auto ">
            <div class="flex  flex-col md:flex-row  lg:flex-row  px-4 justify-between space-y-5 my-5 items-center">
                <h1 class="block w-100 text-lg sm:text-2xl font-medium title-font text-white">
                    Queue List
                </h1>
                <div class="relative w-72 md:flex lg:flex md:space-x-2 lg:space-x-2">

                    <x-input-label for="car_type" class="text-white my-2" :value="__('Car Type: ')" />
                    <x-select-input  id="car_type"  name="car_type"
                        onchange="data()">
                        <option value="">Select</option>
                    </x-select-input>

                </div>
            </div>

            <div class="mx-auto overflow-auto text-sm md:text-base bg-gray-300 w-full ">
                <table class="text-center table-auto w-full">
                    <thead>
                        <tr>
                            <x-table-th :value="__('Queue Id')" />
                            <x-table-th :value="__('Full Name')" />
                            <x-table-th :value="__('Car Model')" />
                            <x-table-th :value="__('Car Number')" />
                            <x-table-th :value="__('Arrive Time')" />
                            <x-table-th />
                        </tr>
                    </thead>

                    <tbody id="tbody" class="p-2 space-y-3 text-center ">


                    </tbody>
                </table>
                <div id="pagination " class="inline-flex items-center -space-x-px my-6 ">
                    <button onclick="previousPage() "
                        class="font-medium bg-zinc-900 text-white p-3  rounded-l-lg">Previous</button>
                    <span id="currentPage" class="font-medium bg-zinc-900 text-white p-3"></span>

                    <button onclick="nextPage()" class="font-medium bg-zinc-900 text-white p-3 rounded-r-lg">Next</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let table = document.getElementById("tbody");
        let currentPage = 0;
        let rowsPerPage = 10;

        function showPage(page) {
            let startIndex = page * rowsPerPage;
            let endIndex = startIndex + rowsPerPage;
            let rows = table.rows;

            for (let i = 0; i < rows.length; i++) {
                if (i < startIndex || i >= endIndex) {
                    rows[i].style.display = "none";
                } else {
                    rows[i].style.display = "";
                }
            }

            document.getElementById("currentPage").textContent = (currentPage + 1);
        }

        function previousPage() {
            if (currentPage > 0) {
                currentPage--;
                showPage(currentPage);
            }
        }

        function nextPage() {
            let rows = table.rows;
            if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage) - 1) {
                currentPage++;
                showPage(currentPage);
            }
        }

        showPage(currentPage);
    </script>

    <script>
        data().then(response => {

        }).catch(error => {
            console.log("data error");
        });

        category().then(response => {

        }).catch(error => {
            console.log("category error");
        });

        setInterval(() => {
            data().then(response => {

            }).catch(error => {
                console.log("data error");
            });
        }, 5000);

        

        async function data(page) {
            // e.preventDefault()
            let table = document.getElementById("myTable")
            const tbody = document.getElementById('tbody');
            let car_type = document.getElementById("car_type").value
            if (!(car_type)) {
                car_type = 2
            }
            let data
            const car_data = {
                id: car_type,

            };

            await fetch("{{ url('api/queuedata') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(car_data)
                })
                .then(response => response.json())
                .then(data2 => {
                    data = data2
                })
                .catch(error => console.error(error));

            // let data = await response.json();

            console.log(data);

            let details = data[0]
            let number = 1


            tbody.innerHTML = '';

            let newdetails = details.filter(element => element.relation.category_id == car_type)
            if (newdetails.length === 0) {
                let tr = document.createElement("tr");
                let td = document.createElement("td");
                td.colSpan = 2
                td.style.margin = "auto"
                td.textContent = "No data available"
                tr.appendChild(td);
                tbody.appendChild(tr);
            }


            newdetails.forEach((element, index) => {
                let tr = document.createElement("tr");
                let td0 = document.createElement("td");
                let td1 = document.createElement("td");
                let td2 = document.createElement("td");
                let td3 = document.createElement("td");
                let td4 = document.createElement("td");
                let td5 = document.createElement("td");

                td0.textContent = number++
                td1.textContent = element.relation.driver.firstname + " " + element.relation.driver.lastname
                td2.textContent = element.relation.vehicles.vehicle_name
                td3.textContent = element.relation.vehicles.vehicle_number
                td4.textContent = element.arrive_time

                td5.innerHTML = `
                <button class="flex ml-auto td text-white bg-zinc-900 border-0 py-1 px-6 focus:outline-none m-1 hover:bg-zinc-600 rounded" onclick="window.location.href='{{ url('admin/printedit/${element.relation.id}') }}';">
                     Dispatch
                 </button>
                        `;

                tr.appendChild(td0);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tbody.appendChild(tr);

                // }
                showPage(currentPage);

            })
        }



        async function category() {
            let select = document.getElementById("car_type")

            const url =
                "{{ url('api/category') }}";
            // Storing response
            const response = await fetch(url);
            const data = await response.json();
            console.log(data)
            let category = data[0]

            category.forEach((element, index) => {

                let option = document.createElement("option");
                option.innerHTML = element.type
                option.value = element.id
                select.appendChild(option)
                if (element.id == 2) {
                    option.selected = "true"
                }
            });


        }
    </script>
@endsection
