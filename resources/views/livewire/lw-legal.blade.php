<div>

    <div class="hidden md:block">
        <div class="px-6">
            <div class="mt-6">
                <h3 class="text-green-500 uppercase font-semibold">More Information</h3>
            </div>

            <div class="mt-6">
                <div class="border shadow bg-white px-2 rounded-lg py-1">
                    {{$subcounty_name ?? "Subcounty"}}
                </div>

                <div class="mt-2 border shadow bg-white px-2 rounded-lg py-1">
                    {{$ward_name ?? "Ward"}}
                </div>
            </div>

        </div>


        <!--======Disclaimer Scroll template-->
        <div class="mt-4">
            <div class="border-t-2 border-b-2 border-gray-100 w-full">
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 mx-4 md:hidden">
        <div class="grid place-self-center grid-cols-2 text-center divide-x-2 divide-gray-300 bg-white shadow shadow-lg w-full">
            <p class="p-4"> {{$subcounty_name ?? "Subcounty"}}</p>

            <p class="p-4">{{$ward_name ?? "Ward"}}</p>
        </div>
    </div>




</div>