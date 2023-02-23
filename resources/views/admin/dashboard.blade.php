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
                                <table class="table-auto w-full text-left whitespace-no-wrap">
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
                                <div class="pagination py-10">
                                    {{ $data->links() }}
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

@endsection
