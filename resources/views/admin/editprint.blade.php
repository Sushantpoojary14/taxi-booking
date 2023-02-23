@extends('admin.layouts.app')
@section('content')
    <div class="py-1  lg:w-full md:w-full mt-10">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white dark:dark:text-gray-100 ">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-0 mx-auto ">
                            <div class="flex flex-col text-center  mb-6 ">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 dark:text-white ">Add Dispatch
                                    Details
                                </h1>

                            </div>
                            <div class="lg:w-11/12 w-full mx-auto font-medium text-xl ">
                                <form action="{{ route('admin.print') }}" method="post" class="m-0 p-0">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="c_id" value="{{$detail==null?'':$detail['id']}} ">
                                    <div class="lg:w-11/12 md:w-2/3 mx-auto  ">

                                        <div class="flex flex-row flex-wrap -m-2">
                                            <div class="p-2 w-2/4">
                                                <div class="relative">
                                                    <label for="firstname" class="leading-7  text-gray-400 my-2">Customers
                                                        Name</label>

                                                        <x-text-input type="text" id="fullname" name="fullname"
                                                        {{-- {{ $name = $item->firstname}} --}}
                                                            class="" value="{{$detail==null?'':$detail['fullname']}}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                                            </div>


                                            <div class="p-2 w-2/4">
                                                <div class="relative">
                                                    <label for="location" class="leading-7  text-gray-400 my-2">Destination </label>

                                                        <x-text-input type="text" id="location" name="location"
                                                            class="" value="{{$detail==null?'':$detail['location']}}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                            </div>

                                            <div class="p-2 w-2/4">
                                                <div class="relative">
                                                    <label for="fair" class="leading-7  text-gray-400 my-2">Fair Charge</label>

                                                        <x-text-input type="text" id="fair" name="fair"
                                                            class="" value="{{$detail==null?'':$detail['fair']}}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('fair')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-2/4">
                                                <div class="relative">
                                                    <label for="night_fair" class="leading-7  text-gray-400 my-2">Night Charge</label>

                                                        <x-text-input type="text" id="night_fair" name="night_fair"
                                                            class="" value="{{$detail==null?'':$detail['night_fair']}}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('night_fair')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-2/4">
                                                <div class="relative">
                                                    <label for="payment" class="leading-7  dark:text-gray-400 my-2">Mode of Payment: </label>
                                                    <select id="payment" name="payment"
                                                        class="w-full block bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2 lg:text-xl ">

                                                        <option >Select</option>


                                                            <option value="cash"
                                                                class="bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1"
                                                                {{$detail==null?'':($detail['payment']=='cash'?'selected':'')}}>Cash



                                                            </option>
                                                            <option value="upi"
                                                                class="bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1"
                                                                {{$detail==null?'':($detail['payment']=='upi'?'selected':'')}}>UPI



                                                            </option>
                                                            <option value="card"
                                                                class="bg-white border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-1"
                                                                {{$detail==null?'':($detail['payment']=='card'?'selected':'')}}>Card



                                                            </option>

                                                    </select>

                                                </div>
                                                <x-input-error :messages="$errors->get('payment')" class="mt-2" />
                                            </div>
                                            <div class="p-2 w-2/4">
                                                <div class="relative">
                                                    <label for="parking_charges" class="leading-7  text-gray-400 my-2">Parking Charges</label>

                                                        <x-text-input type="text" id="parking_charges" name="parking_charges"
                                                            class="" value="{{$detail==null?'':$detail['parking_charges']}}" />

                                                </div>
                                                <x-input-error :messages="$errors->get('parking_charges')" class="mt-2" />
                                            </div>



                                            <div class="p-2 w-full flex px-60">
                                                <button
                                                    class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none mt-8 hover:bg-indigo-600 rounded text-lg">
                                                    Submit
                                                </button>

                                                <button
                                                    class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none mt-8 hover:bg-indigo-600 rounded text-lg"
                                                    onclick="window.location.href='{{ url('/admin/queue') }}';">
                                                    Cancel
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

