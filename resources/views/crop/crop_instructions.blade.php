<div class="headers mt-12 mb-12 "> @include('crop.disabled-crop-button-headers') </div>


<div class="card_crop_instructions mt-12 mb-8 ">

    <div id="card_content" class="ml-2 mt-12">
        <strong>
            <h3 class="text-center mb-8">READ THE GUIDE BELOW BEFORE YOU PROCEED!</h3>
        </strong><br>


        <p>This is an area to select and compare different types of crops and their
            different varieties and add your crop of choice to your farm or field on your farm ...</p><br>



        <ul class="pb-12">

            <li>
                <div class="flex">
                    Use <span class="inline ml-4 mr-2"> <img src="{{ asset('images/farm_btn.png') }}" width="150"
                            height="150"></span> to select your registered farm or switch between your farms.
                </div>
            </li>


            <li class="mt-2">
                <div class="flex">
                    Use <span class="inline ml-2"> <img src="{{ asset('images/crop_btn.png') }}" width="180"
                            height="150"></span> to search for a crop of interest.
                </div>
            </li>

            <li class="mt-2">
                <div class="flex">
                    Use <span class="inline ml-3 mr-1"> <img src="{{ asset('images/versus_btn.png') }}" width="150"
                            height="150"></span> to compare your crop against other crops listed under
                    <span class=" mx-2 font-bold underline text-green-500 text-center"> ADVANCED SEARCH </span>
                </div>
            </li>


            <li class="mt-2">
                <div class="flex">
                    Use <span class="inline ml-3 mr-1"> <img src="{{ asset('images/varieties_btn.png') }}" width="150"
                            height="150"></span> to compare your crop against other crops listed under <span
                        class=" mx-2 font-bold underline text-green-500 text-center"> ADVANCED SEARCH </span>
                </div>
            </li>



        </ul>

    </div>

</div>


<div class="flex justify-center" >
    <button id="btn_crop_instructions_proceed"
        class="bg-green-600 hover:bg-green-800 text-white text-sm font-semibold hover:text-white py-2 px-4 rounded-full w-48 mt-4 ">
        Click Here To Continue
    </button>
</div>

