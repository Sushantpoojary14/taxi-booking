<x-app-layout>


    <div class="py-4">
        <div class="w-100 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-base dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    <div class="py-2">
                        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="py-3 text-white dark:text-gray-100">
                                    <section class="text-gray-600 body-font">
                                        <div class="container px-2 py-1 mx-auto">
                                            <div class=" text-center w-full mb-5">
                                                <div class="flex flex-row  px-4 justify-between ">
                                                    <h1
                                                        class=" block w-100 sm:text-lg text-base font-medium title-font  text-gray-900 dark:text-white ">
                                                        Queue List
                                                    </h1>

                                                    @foreach ($drivers as $relation)
                                                        @if ($relation->relation_id == $user->id)
                                                            <button id="button"
                                                                class=" text-white  bg-indigo-500 border-0 focus:outline-none  px-4 hover:bg-indigo-600 rounded "
                                                                onclick="window.location.href='{{ url('/exit') }}';"
                                                                {{ $relation->status == 1 ? '' : 'hidden' }}>Exit</button>
                                                        @endif
                                                    @endforeach

                                                </div>

                                            </div>
                                            <div class="w-ful  mx-auto overflow-auto text-sm">
                                                <table class="table-auto text-left whitespace-no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 bg-gray-100 rounded-tl rounded-bl">
                                                                Queue Id</th>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100 ">
                                                                Full Name</th>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                                Car Type</th>

                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                                Model</th>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900  bg-gray-100">
                                                                Car Number</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $id = 1;
                                                        @endphp
                                                        {{-- {{dd($data)}} --}}
                                                        @if ($data==null)

                                                        <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                            No data available
                                                        </td>
                                                        @else
                                                            @foreach ($data as $relation)
                                                                {{-- @foreach ($relation as $item) --}}

                                                                <tr>
                                                                    <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                                        {{ $id++ }}
                                                                    </td>
                                                                    <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                                        {{ $relation->driver->firstname . ' ' . $relation->driver->lastname }}
                                                                    </td>
                                                                    <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                                        {{ $relation->category->type }}
                                                                    </td>

                                                                    <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                                        {{ $relation->vehicles->vehicle_name }}
                                                                    </td>
                                                                    <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                                        {{ $relation->vehicles->car_number }}
                                                                    </td>
                                                                </tr>

                                                                {{-- @endforeach --}}
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
