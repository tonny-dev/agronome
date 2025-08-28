<div>
    <div class="md:flex flex-col md:flex-row mt-6">
        {{-- farm button --}}
        <div class="md:w-1/2 md:pr-2 lg:w-1/2 pb-4 md:pb-0 lg:pb-0">
            <div class="relative md:w-64 w-full">
                <button class="block bg-green-600 active w-full border px-4 py-2 rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline hover:shadow-lg" type="button"><span class=" float-left">
                    <i class="fa fa-plus"></i>

                    </span><span class="pr-36 text-white">Farm</span></button>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-white">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>




        {{-- Field button --}}
        <div class="md:w-1/2 lg:w-1/2 md:pr-2 pb-4 md:pb-0 lg:pb-0">
            <div class="relative md:w-64 w-full">
                <button class="w-full cursor-not-allowed text-green-700 bg-white border px-4 py-2 rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline" type="button" disabled><span class="float-left"><i class="fa fa-plus"></i></span><span class="pr-36 text-green-700">Field</span></button>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>

        {{-- crop button --}}
        <div class="pb-4 md:pb-0 lg:pb-0">
            <div class="relative md:w-64 w-full">
                <button id="cropbutton" class="cursor-not-allowed w-full bg-white text-green-700 border px-4 py-2 rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline" type="button" disabled><span class="float-left"><i class="fa fa-plus"></i></span><span class="pr-36 text-green-700">Crop</span></button>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
</div>