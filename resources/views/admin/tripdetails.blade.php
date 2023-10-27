@extends('admin.layouts.app')
@section('content')
    <section class="text-black body-font mx-2 ">
        <div
            class=" text-center w-full md:mb-5 lg:mb-5 px-2 py-1 mx-auto md:flex lg:flex md:justify-between lg:justify-between space-y-5 md:space-y-0 lg:space-y-0">
            <div class="flex flex-col md:flex-row  lg:flex-row  px-4 justify-between space-y-5 md:my-5 lg:my-5 items-center">
                <h1 class="block w-100 text-lg sm:text-2xl font-medium title-font text-white">
                    History Details
                </h1>
            </div>
            <div class="flex flex-col lg:flex-row space-y-8 lg:space-x-2">
                <form action="{{ url('admin/viewdetail/' . $driver->id . '') }}" method="post"
                    class="flex flex-col lg:flex-row items-center space-x-2 m-auto space-y-5">
                    @csrf
                    <ul class="flex space-x-3 ">
                        <li>
                            <input id="week" type="radio" value="week" name="time" class="peer/week hidden ">
                            <label for="week"
                                class="bg-zinc-700 text-white px-3 py-2 border-2 border-zinc-900 p-2 rounded-md w-1/2 peer-checked/week:border-red-800">Week</label>

                        </li>
                        <li>
                            <input id="month" type="radio" value="month" name="time" class="peer/month hidden ">
                            <label for="month"
                                class=" bg-zinc-700 border-2 text-white px-3 md:px-6 lg:px-6 py-2 border-zinc-900 p-2 rounded-md w-1/2 peer-checked/month:border-red-800 ">Month</label>
                        </li>
                        <li>
                            <input id="day" type="radio" value="day" name="time" class="peer/day hidden ">
                            <label for="day"
                                class=" bg-zinc-700 border-2 text-white px-3 md:px-6 lg:px-6 py-2 border-zinc-900 p-2 rounded-md w-1/2 peer-checked/day:border-red-800 ">Day</label>
                        </li>
                    </ul>

                    <input type="date" name="date"
                        class="w-36  rounded border border-gray-300 text-base outline-none text-zinc-900 p-1 m-4 md:m-0 lg:m-0 leading-8 transition-colors duration-200 ease-in-out"
                        value="{{ $current }}">
                    <div>

                        <x-primary-button class="md:ml-3 lg:ml-3" id="button">
                            {{ __('Submit') }}
                        </x-primary-button>

                        <a class="inline-flex items-center  px-6 py-2  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-zinc-900 focus:bg-gray-700  active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 lg:8px text-center"
                            onclick="exportTableToExcel()">
                            Export
                        </a>
                    </div>

            </div>

        </div>
            <div class="w-full flex flex-col md:flex-row lg:flex-rows my-5 text-center">
                <p for="month" class="  text-white px-3 md:px-6 lg:px-6  p-2  md:w-96 lg:w-96">Full Name :
                    {{ $driver->driver->firstname . ' ' . $driver->driver->lastname }} </p>
                <p for="month" class="  text-white px-3 md:px-6 lg:px-6 p-2 md:w-96 lg:w-96">Car Number :
                    {{ $driver->Vehicles->vehicle_number }} </p>
            </div>
        <div class="mx-auto overflow-auto text-sm md:text-base bg-gray-300 w-full ">
            <table class="text-center table-auto w-full" id="t_table">
                <thead>
                    <tr>
                        <x-table-th :value="__('Sr. No')" />
                        <x-table-th :value="__('Customer Name')" />
                        <x-table-th :value="__('Customer Number')" />
                        {{-- <x-table-th :value="__('Invoice id')" /> --}}
                        {{-- <x-table-th :value="__('Time Taken')" /> --}}
                        {{-- <x-table-th :value="__('Distance (km)')" /> --}}
                        {{-- <x-table-th :value="__('Location')" /> --}}
                        <x-table-th :value="__('Payment Mode')" />
                        <x-table-th :value="__('Amount')" />
                        <x-table-th :value="__('Booking Time')" />
                    </tr>
                </thead>
                <tbody id="tbody">
                    @php

                        $total = 0;
                    @endphp


                    @foreach ($customer as $key => $item)
                        @php
                            $total_trip = 0;
                            $d_total = 0;

                        @endphp

                        <tr>
                            <x-table-td :value="__($key + 1)" />
                            <x-table-td :value="__($item->fullname)" />
                            <x-table-td :value="__($item->phone)" />
                            {{-- <x-table-td :value="__($item->invoice_id)" /> --}}
                            {{-- <x-table-td :value="__($item->time_taken)" /> --}}
                            {{-- <x-table-td :value="__($item->distance)" /> --}}
                            {{-- <x-table-td :value="__($item->location)" /> --}}
                            <x-table-td :value="__($item->payment_mode)" />
                            <x-table-td :value="__($item->total_amount)" />
                            <x-table-td :value="__($item->booking_time)" />


                        </tr>
                        @php
                            $total += $item->total_amount;
                        @endphp
                    @endforeach


                </tbody>
            </table>
            <div class="w-full flex justify-between px-10 space-x-10 my-2 ">
                <div id="pagination " class="inline-flex items-center space-x-px my-6 ">
                    <button onclick="previousPage() "
                        class="font-medium bg-zinc-900 text-white p-3  rounded-l-lg">Previous</button>
                    <span id="currentPage" class="font-medium bg-zinc-900 text-white p-3"></span>

                    <button onclick="nextPage()" class="font-medium bg-zinc-900 text-white p-3 rounded-r-lg">Next</button>

                </div>
                <div class="w-full md:w-2/5 lg:w-2/5 m-auto">
                    <h3
                        class="sm:text-sm w-full py-1 px-7 lg:py-3 title-font tracking-wider font-medium text-white bg-zinc-900 rounded">
                        Total Amount: {{ number_format($total) }}</h3>
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
        function exportTableToExcel(tableID, filename = '') {
            let downloadLink;
            let dataType = 'application/vnd.ms-excel';
            let tab = document.getElementById('t_table');

            let rows = tab.rows;
            console.log(rows);
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = "";
            }

            let tableSelect = document.getElementById('t_table');
            let tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                let blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                downloadLink.download = filename;

                downloadLink.click();
                showPage(currentPage);
            }
        }
    </script>
@endsection
