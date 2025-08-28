<div>
    <div class="border relative bottom-2 hidden border-gray-200 border-b-2 border-t-0 md:mt-6 mt-2 border-l-1 border-r-1 shadow shadow-lg" id="to_farm_history">
        <h2 class="font-bold text-gray-900 px-6 pb-6"><span class="uppercase"> Farm History</span></h2>

        <div class="md:flex flex-col md:flex-row md:mx-4 mx-2 md:pb-4 pb-2">
            {{-- Season input --}}
            <div class="md:w-1/2 pb-2 md:pb-0">
                <div class="relative md:w-64 w-full">
                    <select class="block appearance-none w-full nav_color text-white border  px-4 py-2 pr-8 rounded-xl shadow shadow-xl leading-tight focus:outline-none focus:shadow-2xl" required>
                        <option selected value=''>Season</option>
                        <option value="long_rains">Long Rains</option>
                        <option value="long_rains">short Rains</option>
                        <option value="long_rains">Dry Season</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Crop grown input --}}
            <div class="md:w-1/2">
                <div class="relative md:w-64 w-full">
                    <span class="absolute px-4 inset-y-0 left-0 flex items-center pl-2">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>

                    <input type="text" class="w-full shadow shadow-xl border-none pl-10 py-2 rounded-xl leading-tight focus:outline outline-green-600 placeholder-gray-900 focus:shadow-outline" placeholder="Crop grown" />
                </div>
            </div>
        </div>


        <div class="md:flex md:flex-row flex-col mx-4 pb-4">
            {{-- Estimated Area grown --}}
            <div class="md:w-1/2 md:pr-2 lg:w-1/2 pb-2 md:pb-0">
                <div class="relative md:w-64 w-full">
                    <input type="number" class="w-full border-none px-4 py-2 pr-8 rounded-xl shadow shadow-xl leading-tight focus:outline focus:shadow-outline placeholder-gray-900 outline-green-600" placeholder="Estimated area grown" />
                    <div class="absolute inset-y-0 right-0 border-l border-green-700 flex items-center px-2 text-green-600">
                        acres
                    </div>
                </div>
            </div>

            {{-- Estimated yield --}}
            <div class="md:w-1/2 md:pr-2 lg:w-1/2">
                <div class="relative md:w-64 w-full">
                    <input type="number" class="w-full border-none px-4 py-2 pr-8 rounded-xl shadow shadow-xl leading-tight outline outline-offset-2 outline-blue-500 placeholder-gray-900" placeholder="Estimated Yield" />
                    <div class="absolute inset-y-0 right-0 border-l border-green-700 flex items-center px-2 text-green-600">
                        kg
                    </div>
                </div>
            </div>
        </div>


        <div class="md:flex md:flex-row flex-col mx-4 pb-4">
            {{-- Planting Date input --}}
            <div class="md:w-1/2 md:pr-2 md:pb-0 pb-2">
                <label class="text-green-900 px-2">Planting Date</label>
                <div class="relative md:w-64 w-full">
                    <input type="month" class="w-full border-none px-4 py-2 pr-8 rounded-xl shadow shadow-xl outline-none leading-tight focus:outline-none focus:shadow-outline placeholder-gray-900" />
                </div>
            </div>

            {{-- Harvesting Date input --}}
            <div class="md:w-1/2 md:pr-2 lg:w-1/2">
                <label class="pl-2 text-green-900">Harvesting Date</label>
                <div class="relative md:w-64 w-full">
                    <input type="month" class="w-full border-none px-4 py-2 pr-8 rounded-xl shadow shadow-xl outline-none leading-tight focus:outline outline-green-600 focus:shadow-outline placeholder-gray-900"  />
                </div>
            </div>
        </div>

        {{-- Add crop record Button Div --}}
        <div class="md:pt-10 pt-8">
            <button class="bg-white absolute bottom-2 text-gray-900 inline-flex text-sm md:text-normal items-center py-1 px-2 border border-green-900 font-light rounded-xl right-6 hover:bg-green-400 hover:text-white">
                <i class="bi bi-plus-lg"></i>
                <span class="pl-2">Add Crop Record</span>
            </button>
        </div>
    </div>

    <div class="border relative bottom-2 border-gray-200 border-b-2 border-t-0 md:mt-6 mt-2 border-l-1 border-r-1 shadow shadow-lg pb-4" id="farm_history_guide">
        <h2 class="font-bold text-gray-900 px-6 pb-6"><span class="uppercase"> Farm History</span> (Optional)</h2>

        <div class="text-center text-gray-900">
            <p>Do you wish to provide your farm history details?</p>
            <p>(Farming activities upto a year prior to this registration)</p>
        </div>

        <div class="pl-4 mt-4 font-medium">
            <p class="pr-4">If yes, click
                <button class="bottom-2 active inline-flex text-sm md:text-normal items-center py-0.5 px-2 border outline-none border-green-600 font-light rounded-lg" id="add_farm_history">
                    <i class="bi bi-plus-lg"></i>
                    <span class="pl-2">Add Farm History</span>
                </button>

            </p>

            <p class="pr-4 pt-6">If No, click <span> <button class="bottom-2 inline-flex text-sm md:text-normal items-center py-0.5 px-2 border outline-none border-green-600 font-light rounded-lg" id="add_farm_history">
                        <span class="pl-2 pr-2">Next</span>
                    </button></span> below to continue
            </p>
        </div>

    </div>

    <script>
        $('#add_farm_history').on('click', function() {
            //    console.log("Clicked add farm history button") 
            $('#farm_history_guide').hide();
            $('#to_farm_history').show();
        })

        const monthControl = document.querySelector('input[type="month"]');
        current_month = new Date();
        monthControl.value = current_month.toISOString().slice(0, 7);
    </script>
</div>