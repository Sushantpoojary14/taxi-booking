@extends('driver.layouts.app')
@section('content')
    <section class="text-black body-font  mx-2 ">
        <div class=" text-center w-full mb-5 px-2 py-1 mx-auto md:w-9/12 lg:w-9/12">
            <div class="flex flex-row  px-4 justify-between ">
                <h1 class="block w-100 sm:text-lg text-base font-medium title-font text-white">
                    Queue List
                </h1>
                @foreach ($data as $relation)
                    @if ($relation->relation_id == $user->id)
                        <button id="button" class=" text-white bg-zinc-900 px-4 py-1 focus:outline-none rounded "
                            onclick="window.location.href='{{ route('driver.exit') }}';"
                            {{ $relation->status == 1 ? '' : 'hidden' }}>Exit</button>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="mx-auto overflow-auto text-sm md:text-base bg-gray-300 md:w-9/12 lg:w-9/12">
            <table class="text-left table-auto w-full">
                <thead>
                    <tr>
                        <x-table-th :value="__('Queue Id')" />
                        <x-table-th :value="__('Full Name')" />
                        <x-table-th :value="__('Car Type')" />
                        <x-table-th :value="__('Model')" />
                        <x-table-th :value="__('Car Number')" />
                    </tr>
                </thead>
                <tbody>
                   

                    @if ($data == null)
                    <x-table-td :value="__('No data available')" />
                    @else
                        @foreach ($data as $key => $relation)
                            <tr class="{{ $relation->relation->driver_id == Auth::user()->id ? 'text-green-600' : 'text-zinc-900' }} ">
                                <x-table-td :value="__($key+1)" />
                                <x-table-td :value="__($relation->relation->driver->firstname.' '.
                                 $relation->relation->driver->lastname)" />
                                <x-table-td :value="__($relation->relation->category->type)" />
                                <x-table-td :value="__($relation->relation->vehicles->vehicle_name)"/>
                                <x-table-td :value="__($relation->relation->vehicles->vehicle_number)"/>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </section>
@endsection
