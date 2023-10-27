@extends('admin.layouts.app')
@section('content')
    <section class="text-black body-font mx-2 ">
        <div
            class=" text-center w-full md:mb-5 lg:mb-5 px-2 py-1 mx-auto md:flex lg:flex md:justify-between lg:justify-between ">
            <div class="flex flex-col md:flex-row  lg:flex-row  px-4 justify-between space-y-5 md:my-5 lg:my-5 items-center">
                <h1 class="block w-100 text-lg sm:text-2xl font-medium title-font text-white">
                    Billing History
                </h1>
            </div>
            <div class="flex flex-col lg:flex-row space-y-8 lg:space-x-2">
                <form action="{{ route('admin.trip') }}" method="post"
                    class="flex flex-col lg:flex-row items-center space-x-2 m-auto space-y-5">
                    @csrf
                    <x-input-label for="car_type" class="text-xl mt-4 text-white" :value="__('Car Type:')" />
                    <x-select-input id="car_type" class="w-44" name="car_type">
                        <option value="">Select</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $filter ? 'selected' : '' }}>
                                {{ $item->type }}
                            </option>
                        @endforeach
                    </x-select-input>


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
                </form>

            </div>

        </div>
        <div class="mx-auto overflow-auto text-sm md:text-base bg-gray-300 w-full ">
            <table class="text-center table-auto w-full" id="t_table">
                <thead>
                    <tr>
                        <x-table-th :value="__('Sr. No')" />
                        <x-table-th :value="__('Full Name')" />
                        <x-table-th :value="__('Phone Number')" />
                        <x-table-th :value="__('Car Model')" />
                        <x-table-th :value="__('Car Number')" />

                        {{-- @if ($data != null) --}}
                        <x-table-th :value="__('Total Trip')" />
                        <x-table-th :value="__('Total Amount')" />
                        <x-table-th :value="__('')" />
                        {{-- @else
                            <x-table-th :value="__('Location')" />
                            <x-table-th :value="__('Payment Mode')" />
                            <x-table-th :value="__('Amount')" />
                            <x-table-th :value="__('Booking Time')" />

                        @endif --}}
                    </tr>
                </thead>
                <tbody id="tbody">
                    @php

                        $total = 0;
                    @endphp

                    @if (count($drivers) == 0)
                        <x-table-td :value="__('No data available')" />
                    @else
                        @foreach ($drivers as $key => $item)
                            @php
                                $total_trip = 0;
                                $d_total = 0;

                            @endphp

                            <tr>
                                <x-table-td :value="__($key + 1)" />
                                <x-table-td :value="__($item->driver->firstname . ' ' . $item->driver->lastname)" />
                                <x-table-td :value="__($item->driver->phone)" />
                                <x-table-td :value="__($item->vehicles->vehicle_name)" />
                                <x-table-td :value="__($item->vehicles->vehicle_number)" />
                                @foreach ($data as $item2)
                                    @if ($item2->relation_id == $item->id)
                                        @php
                                            $total_trip += 1;
                                            $d_total += $item2->total_amount;
                                        @endphp
                                    @endif
                                @endforeach
                                <x-table-td :value="__($total_trip)" />
                                <x-table-td :value="__(number_format($d_total))" />
                                <x-table-td :value="__()" class="">
                                    <x-primary-button class="ml-3 td_btn" id="button"
                                        onclick="window.location.href='{{ url('/admin/viewdetail/' . $item->id . '') }}';">
                                        {{ __('view Details') }}
                                    </x-primary-button>
                                </x-table-td>

                            </tr>
                            @php
                                $total += $d_total;
                            @endphp
                        @endforeach
                    @endif

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
            let td_btn = document.getElementsByClassName('td_btn');

            for (let i = 0; i < td_btn.length; i++) {
                td_btn[i].style.display = "none";
            }

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
            }

            for (let i = 0; i < td_btn.length; i++) {
                td_btn[i].style.display = "";
            }
            showPage(currentPage);
        }
    </script>
@endsection
