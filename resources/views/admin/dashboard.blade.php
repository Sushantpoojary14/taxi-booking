@extends('admin.layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-9xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:text-gray-100">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-2 mx-auto">
                            <div class=" text-center w-full mb-10">
                                <h1 class="sm:text-2xl text-lg font-medium title-font  dark:text-white ">Drivers and
                                    Vehicles List
                                </h1>

                            </div>
                            <div class="flex flex-col w-full mx-auto overflow-auto text-1xl ">
                                <table class="table-auto w-full text-left whitespace-no-wrap" id="myTable">
                                    <thead class="">
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100 rounded-tl rounded-bl">
                                                Full Name</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100">
                                                Car Category</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Model Name</th>

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium  text-gray-900  bg-gray-100">
                                                Car Number</th>

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Color</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                Status</th>

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900   bg-gray-100">
                                            </th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                            </th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $item)


                                            <tr>
                                                <td class="px-4 py-3  text-gray-900 dark:text-white">



                                                       {{ $item->driver->firstname . ' ' . $item->driver->lastname }}

                                                </td>

                                                <td class="px-4 py-3 text-gray-900 dark:text-white">

                                                        {{ $item->category->type  }}



                                                </td>
                                                <td class="px-4 py-3 text-gray-900 dark:text-white">



                                                    {{ $item->vehicles->vehicle_name }}


                                                </td>
                                                <td class="px-4 py-3 text-gray-900 dark:text-white">

                                                    {{ $item->vehicles->car_number }}

                                                </td>
                                                <td class="px-4 py-3 text-gray-900 dark:text-white">



                                                    {{ $item->vehicles->color }}


                                                </td>


                                                <td class="px-4 py-3 text-gray-900 {{ $item->active_status == 1 ? 'text-green-500' : 'text-red-500' }}">

                                                    {{ $item->active_status == 1 ? 'Online' : 'offline' }}

                                                </td>

                                                <td class=" text-center">

                                                    <form action="{{ url('admin/status/' . $item->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="status"
                                                            value="{{ $item->status == 1 ? '0' : '1' }}">
                                                        <button
                                                            class="flex ml-auto text-white  border-0 py-1 px-6 focus:outline-none m-1 hover:bg-indigo-600 rounded {{ $item->status == 1 ? 'bg-green-400 hover:bg-green-600' : 'bg-red-400 hover:bg-red-600' }}   ">
                                                            {{ $item->status == 1 ? 'Disable' : 'Enable' }}</button>

                                                    </form>

                                                </td>
                                                <td class=" text-center">
                                                    <button
                                                        class="flex ml-auto text-white bg-indigo-500 border-0 py-1 px-6 focus:outline-none m-1 hover:bg-indigo-600 rounded"
                                                        onclick="window.location.href='{{ url('/admin/showedit/' . $item->id) }}';">Edit</button>
                                                </td>
                                                <td class=" text-center">
                                                    <button
                                                        class="flex ml-auto text-white bg-indigo-500 border-0 py-1 px-6 m-1 focus:outline-none hover:bg-indigo-600 rounded"
                                                        onclick="window.location.href='{{ url('/admin/destroy/' . $item->id) }}';">Delete</button>
                                                </td>

                                            </tr>
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
