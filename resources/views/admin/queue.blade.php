@extends('admin.layouts.app')
@section('content')
    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-6 text-white dark:text-gray-100">
                    <section class="text-gray-600 body-font">
                        <div class="container px-2 py-1 items-center">
                            <div class="flex flex-row  items-center lg:space-x-16 lg:pl-56 my-10">
                                <div class="block w-full ">
                                    <h1 class="sm:text-2xl text-lg font-medium title-font  dark:text-white ">
                                        Queue List
                                    </h1>
                                </div>
                                <div class="block w-full text-1xl">
                                    <form action="{{ route('admin.queue') }}" method="post">
                                        @csrf
                                        <label for="car_type" class="leading-7  dark:text-gray-400 ">Car Type: </label>
                                        <select id="car_type" name="car_type"
                                            class="w-2/5  bg-white border-black dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1 lg:p-2 ">

                                            <option value="">Select</option>

                                            @foreach ($category as $item)
                                                <option
                                                    class="bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1"
                                                    value="{{ $item->id }}" {{ $item->id == $fillter ? 'selected' : '' }}>

                                                    {{ $item->type }}

                                                </option>
                                            @endforeach
                                        </select>
                                        <button id="button"
                                            class=" text-white bg-indigo-500 border-0 focus:outline-none py-2 px-7 hover:bg-indigo-600 rounded ">Filter</button>
                                    </form>
                                </div>
                            </div>
                            <script></script>
                            <div class="lg:w-4/5 w-full mx-auto overflow-auto text-1xl">
                                <table class="table-auto w-full text-left whitespace-no-wrap" id="myTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100 rounded-tl rounded-bl">
                                                Queue Id</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100 ">
                                                Full Name</th>
                                            {{-- <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Car Type</th> --}}

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Model</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Car Number</th>

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Arrive Time</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <span id="name"></span>
                                        @php
                                            $id = 1;
                                        @endphp

                                        @foreach ($data as $key => $da)
                                            @if ($da[0]->category_id == $fillter)
                                                <tr>


                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">

                                                        {{ $id++ }}
                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white" id="name">

                                                        {{ $da[0]->driver->firstname }}{{ ' ' . $da[0]->driver->lastname }}

                                                    </td>
                                                    {{-- <td class="px-4 py-3  td text-gray-900 dark:text-white">

                                                            {{ $da[0]->category->type }}

                                                    </td> --}}

                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white" id="vehicle_name">

                                                            {{ $da[0]->vehicles->vehicle_name }}

                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white" id="car_number">

                                                            {{ $da[0]->vehicles->car_number }}

                                                    </td>

                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white" id="time">
                                                        @foreach ($drivers as $item)
                                                            @if ($da[0]->id == $item->relation_id)
                                                                {{ $item->arrive_time }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class=" text-center">
                                                        <button
                                                            class="flex ml-auto td text-white bg-indigo-500 border-0 py-1 px-6 focus:outline-none m-1 hover:bg-indigo-600 rounded "
                                                            onclick="window.location.href='{{ url('/admin/printedit/' . $da[0]->id) }}';"
                                                            {{ $da[0]->status == 1 ? '' : 'disabled' }}>Dispatch</button>
                                                    </td>

                                                </tr>
                                                @elseif (count($data) == $key + 1)
                                                <td
                                                    class="px-4 py-3 td text-gray-900 dark:text-white table-cell col-span-4">
                                                    No data available
                                                </td>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="pagination " class="inline-flex items-center -space-x-px my-6 ">
                                    <button onclick="previousPage() " class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</button>
                                    <span id="currentPage" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></span>
                                    <button onclick="nextPage()" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</button>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        data()
       async function data(){
            const url =
            "http://localhost:8000/api/queuedata";
            // Storing response
            const response = await fetch(url);

            // Storing data in form of JSON
            var data = await response.json();
            let details = data[0]
            let queuedata = data[1]
            details.forEach(element => {
                document.getElementById("name").textContent = queuedata[0].driver.name
            });
        }

    </script>
    <script>
        var table = document.getElementById("myTable");
        var currentPage = 0;
        var rowsPerPage = 10;

        function showPage(page) {
            var startIndex = page * rowsPerPage;
            var endIndex = startIndex + rowsPerPage;
            var rows = table.rows;

            for (var i = 1; i < rows.length; i++) {
                if (i < startIndex || i >= endIndex) {
                    rows[i].style.display = "none";
                } else {
                    rows[i].style.display = "";
                }
            }

            document.getElementById("currentPage").textContent =  (currentPage + 1);
        }

        function previousPage() {
            if (currentPage > 0) {
                currentPage--;
                showPage(currentPage);
            }
        }

        function nextPage() {
            var rows = table.rows;
            if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage) - 1) {
                currentPage++;
                showPage(currentPage);
            }
        }

        showPage(currentPage);
    </script>
@endsection

