@extends('admin.layouts.app')
@section('style')
<style>
    .tr{
        margin:7px;
    }
</style>
@endsection
@section('content')
    <section class="text-black body-font  mx-2 ">
        <div class=" text-center w-full mb-5 px-2 py-1 mx-auto ">
            <div class="flex  flex-col md:flex-row  lg:flex-row  px-4 justify-between space-y-5 my-5 items-center">
                <h1 class="block w-100 text-lg sm:text-2xl font-medium title-font text-white">
                    Drivers and
                    Vehicles List
                </h1>
                <div class="relative w-72">
                    <x-text-input type="text" Placeholder="Search..." oninput="search()" id="search"/>
                </div>
            </div>
            <div class="mx-auto overflow-auto text-sm md:text-base bg-gray-300 w-full ">
                <table class="text-center table-auto w-full">
                    <thead>
                        <tr>
                            <x-table-th :value="__('Sr. No')" />
                            <x-table-th :value="__('Full Name')" />
                            <x-table-th :value="__('Phone Number')" />
                            <x-table-th :value="__('Car Category')" />
                            <x-table-th :value="__('Car Model')" />
                            <x-table-th :value="__('Car Number')" />
                            <x-table-th :value="__('Car Color')" />
                            <x-table-th  />
                            <x-table-th  />
                        </tr>
                    </thead>

                    <tbody id="tbody" class="p-2 space-y-6 text-center ">

                    </tbody>
                </table>
                <div id="pagination " class="inline-flex items-center -space-x-px my-6 ">
                    <button onclick="previousPage() "
                        class="font-medium bg-zinc-900 text-white p-3  rounded-l-lg">Previous</button>
                    <span id="currentPage"
                        class="font-medium bg-zinc-900 text-white p-3"></span>

                    <button onclick="nextPage()"
                        class="font-medium bg-zinc-900 text-white p-3 rounded-r-lg">Next</button>

                </div>

            </div>

        </div>
    </section>
@endsection
@section('script')
    <script>
        let table2 = document.getElementById("tbody");
        let currentPage = 0;
        let rowsPerPage = 10;

        function showPage(page) {
            let startIndex = page * rowsPerPage;
            let endIndex = startIndex + rowsPerPage;
            let rows = table2.rows;

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
            let rows = table2.rows;
            if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage) - 1) {
                currentPage++;
                showPage(currentPage);
            }
        }

        showPage(currentPage);

        async function status(n, id) {
            const data = {
                status: n,
                id: id
            };
            // console.log(data);
            await fetch("{{ url('api/status') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error(error));

            search();
            showPage(currentPage);
        }

        search();
        async function search() {
            // e.preventDefault()
            let table = document.getElementById("myTable")
            const tbody = document.getElementById('tbody');


            const url = "{{ url('api/index') }}";
            const response = await fetch(url);
            let data = await response.json();

            let details = data;
            let number = 1;



            if (details.length === 0) {
                let tr = document.createElement("tr");
                let td = document.createElement("td");
                td.colSpan = 2
                td.style.margin = "auto"
                td.textContent = "No data available"
                tr.appendChild(td);
                tbody.appendChild(tr);
            }
            
            console.log(details)    
            let newdetails = details.filter(element => {
                let input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("search");
                filter = input.value.toUpperCase();
                for (i = 0; i < details.length; i++) {
                    txtValue = element.driver.firstname;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        return element;
                    }
                }
            })
            // console.log(newdetails);
            tbody.innerHTML = '';

            newdetails.forEach((element, index) => {
                let tr = document.createElement("tr");
                let td0 = document.createElement("td");
                let td1 = document.createElement("td");
                let td2 = document.createElement("td");
                let td3 = document.createElement("td");
                let td4 = document.createElement("td");
                let td5 = document.createElement("td");
                let td6 = document.createElement("td");
                let td7 = document.createElement("td");
                let td8 = document.createElement("td");
                tr.classList.add("tr");
                td0.textContent = number++;
                td1.textContent = element.driver.firstname + " " + element.driver.lastname;
                td2.textContent = element.driver.phone;
                td3.textContent = element.category.type;
                td4.textContent = element.vehicles.vehicle_name;
                td5.textContent = element.vehicles.vehicle_number;
                td6.textContent = element.vehicles.vehicle_color;
                td7.innerHTML = `
            <button class="flex ml-auto text-white border-0 py-1 px-6 focus:outline-none m-1 rounded ${element.status == 1 ? 'bg-green-400 hover:bg-green-600' : 'bg-red-400 hover:bg-red-600'}" onclick="status(${element.status == 1 ? '0' : '1'},${element.id});" id="td5">
            ${element.status == 1 ? 'Disable' : 'Enable'}</button>`;


                td8.innerHTML = `
            <button class="flex ml-auto td text-white bg-zinc-900 border-0 py-1 px-6 focus:outline-none m-1 hover:bg-zinc-600 rounded"
            onclick="window.location.href='{{ url('/admin/showedit/${element.id}') }}';">Edit</button>`;

                tr.appendChild(td0);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tr.appendChild(td8);
                tbody.appendChild(tr);
            })
            showPage(currentPage);
        }
    </script>
@endsection
