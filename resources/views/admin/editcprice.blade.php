@extends('admin.layouts.app')
@section('content')
    <section class="container px-5 py-2 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:3/5 bg-gray-300 rounded-lg p-8 flex flex-col w-full m-auto">
            <div class="flex flex-col text-center  mb-3 ">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2">Edit Price
                </h1>
            </div>
            <div class="w-9/12 mx-auto font-medium text-xl space-y-8 ">
                <form action="{{ route('admin.updatepriceedit') }}" method="post" class="m-0 p-0">
                    @csrf
                    {{-- <input type="hidden" name="id" value="{{ $data->id }}"> --}}
                    <div class="relative mb-4">
                        <x-input-label for="Price per day" />
                        <x-select-input id="car_type" name="car_type" class="w-full" required>
                        </x-select-input>
                    </div>
                    <div class="mt-4 w-full">
                        <x-input-label for="Price per day" />
                        <x-text-input type="text" id="price" name="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="flex mt-4 item-center">
                        <x-primary-button class="mx-auto " id="button">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <script>
        category()
        let c_data;
        let select = document.getElementById("car_type")
        let price = document.getElementById("price")

        async function category() {

            const url =
                "{{ url('api/category') }}";
            // Storing response
            const response = await fetch(url);
            // console.log(response);
            const data = await response.json();
            // console.log(data)
            // let category = data[0]
            c_data = data[0]
            data[0].forEach((element,index) => {

                let option = document.createElement("option");
                option.innerHTML = element.type
                option.value = element.id
                select.appendChild(option)
                if (index == 0) {
                    option.selected = "true"
                    // console.log(element.fair);
                    price.value = element.fair
                }
            });


        }

        // c_data
        select.addEventListener("change", function(e) {
            // console.log("67"+select.value);
            const c = c_data.find((item)=>item.id==select.value);
            price.value = c.fair
            // console.log(c);
        })
        // const inputField = document.getElementById("phone");
        // const button1 = document.getElementById("button");
        // inputField.addEventListener("input", function() {

        //     if (inputField.value.length > 10) {
        //         document.getElementById("err_phone").style.display = "block";
        //         return false;
        //     }
        //     if (inputField.value.length < 10) {
        //         document.getElementById("err_phone").style.display = "block";
        //         return false;
        //     }
        //     document.getElementById("err_phone").style.display = "none";
        // });

        // button1.addEventListener('click', (event) => {
        //     let checkboxes = document.querySelectorAll('input[name="checkbox"]:checked');
        //     let output = [];
        //     checkboxes.forEach((checkbox) => {
        //         output.push(checkbox.value);
        //     });
        //     document.getElementById('permit').value = output
        // })
    </script>
@endsection
