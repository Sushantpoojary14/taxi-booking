@extends('admin.layouts.app')
@section('content')
    <section class="container px-5 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-8 flex flex-col w-full m-auto">
            <div class="text-center ">
                <h1 class="block w-100 text-2xl md:text-4xl lg:text-4xl font-bold title-font text-zinc-900">
                    Generate Customer Bill
                </h1>
            </div>
            <form  method="post" id="form">
                @csrf

                <div class="mt-4 w-full">
                    <x-input-label for="invoice_id" :value="__('Customer
                                    Invoice ID')" />
                    <x-text-input id="invoice_id" class="block mt-1 w-full" type="text" name="invoice_id"
                        value="{{$randomString}}" required  />
                    @if (Session::has('message'))
                        <p class="text-red-500 m-1">*{{ Session::get('message') }}</p>
                    @endif
                    <x-input-error :messages="$errors->get('c_token')" class="mt-2" />
                </div>

                <div class="flex items-center mt-4 space-x-2">
                    <x-primary-button id="e_btn" onclick="javascript: form.action='{{ route('admin.editdetails') }}';">
                        {{ __('Edit') }}
                    </x-primary-button>
                    {{-- <x-primary-button  id="g_btn" onclick="javascript: form.action='{{ route('admin.generatebill') }}';">
                        {{ __('Generate') }}
                    </x-primary-button> --}}
                </div>
            </form>

    </section>
@endsection

