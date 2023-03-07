@extends('admin.layouts.app')
@section('content')
    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-6 text-white dark:text-gray-100">
                    <section class="text-gray-600 body-font">
                        <div class="container px-2 py-1 items-center">
                            <div class="flex flex-row  items-center  lg:pl-36 my-10">
                                <div class="w-2/5">
                                    <h1 class="sm:text-2xl text-lg font-medium title-font  dark:text-white ">
                                        Trip History List
                                    </h1>
                                </div>
                                <form action="{{ route('admin.trip') }}" method="post">
                                    <div class=" w-full text-1xl flex flex-row space-x-2 ">

                                        @csrf
                                        <div>
                                            <label for="car_type" class="leading-7  dark:text-gray-400 ">Car Type: </label>
                                            <select id="car_type" name="car_type"
                                                class="w-40 bg-white border-black dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1 lg:p-2 ">

                                                <option value="">Select</option>

                                                @foreach ($category as $item)
                                                    <option
                                                        class="bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1 "
                                                        value="{{ $item->id }}"
                                                        {{ $item->id == $fillter ? 'selected' : '' }}>

                                                        {{ $item->type }}

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>

                                            <label for="car_type" class="leading-7  dark:text-gray-400 ">Date: </label>
                                            <input type="date" name="date"
                                                class="w-40  bg-white border-black dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1 lg:p-2 "
                                                value="{{ $current }}">

                                            <button
                                                class=" text-white bg-indigo-500 border-0 focus:outline-none py-2 px-7 hover:bg-indigo-600 rounded ">
                                                Submit</button>

                                        </div>


                                    </div>
                                </form>
                            </div>

                            <div class="flex flex-col w-full mx-auto overflow-auto text-1xl m-">
                                {{-- {{dd(var_dump($data))}} --}}
                                {{-- @if (array_sum($data) == 0) --}}
                                <table class="table-auto w-full text-left whitespace-no-wrap " id="myTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100 rounded-tl rounded-bl">
                                                Sr No.</th>
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
                                                Location </th>
                                                <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Payment Mode</th>

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Amount</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Booking Time</th>
                                            {{-- <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                            </th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <span id="name"></span>
                                        @php
                                            $id = 1;
                                        @endphp
                                        {{-- {{dd($data)}} --}}
                                        @foreach ($data as $key => $item)

                                            @if ($item->category_id == $fillter)
                                                <tr>


                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">

                                                        {{ $id++ }}
                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">

                                                        {{ $item->driver->firstname }}{{ ' ' . $item->driver->lastname }}

                                                    </td>
                                                    {{-- <td class="px-4 py-3  td text-gray-900 dark:text-white">

                                                        {{ $item[0]->category->type }}

                                                    </td> --}}

                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">

                                                        {{ $item->vehicles->vehicle_name }}

                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">

                                                        {{ $item->vehicles->car_number }}

                                                    </td>

                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">
                                                        {{ $drivers[$key]->location }}
                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">
                                                        {{ $drivers[$key]->payment_mode }}
                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">
                                                        {{ $drivers[$key]->amount }}
                                                    </td>
                                                    <td class="px-4 py-3 td text-gray-900 dark:text-white">
                                                        {{ $drivers[$key]->booking_time }}
                                                    </td>
                                                    {{-- <td> <button
                                                            class="flex ml-auto td text-white bg-indigo-500 border-0 py-1 px-6 focus:outline-none m-1 hover:bg-indigo-600 rounded "
                                                            onclick="window.location.href='{{ url('/admin/tripview' . $item[0]->id) }}';">View</button>
                                                    </td> --}}
                                                {{-- @elseif (count($data) == $key + 1)
                                                    <td
                                                        class="px-4 py-3 td text-gray-900 dark:text-white table-cell col-span-4">
                                                        No data available
                                                    </td> --}}
                                            @endif

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div id="pagination " class="inline-flex items-center -space-x-px my-6 ">
                                    <button onclick="previousPage() " class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</button>
                                    <span id="currentPage" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></span>
                                    <button onclick="nextPage()" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</button>
                                </div>
                                {{-- @else
                                    <h1 class="sm:text-2xl text-lg font-medium title-font text-center dark:text-white ">
                                        No data
                                    </h1>
                                @endif --}}

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
