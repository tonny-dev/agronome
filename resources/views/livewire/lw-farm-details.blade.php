<div>
    <!--Upper Second  Buttons-->
    <div class="px-0 mt-2">
        <div class="flex">
            <!--Farm Name-->
            <div class="w-1/2">
                <div class="relative w-64">
                    <input wire:model.defer="farm_name" name="farm_name" id="farm_name"
                        class="block appearance-none rounded-xl w-full bg-white border px-4 py-2 pr-8  w-32 py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="farm-name" type="text" placeholder="Farm Name" required>
                </div>
            </div>
            <!--Estimated Farm Size-->
            <div class="w-1/2">
                <div class="relative w-64">
                    <input wire:model.defer="farm_size" id="farm_size" name="farm_size"
                        class="block appearance-none w-full bg-white text-gray-700 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Farm Size" required>
                    <div class="">
                        <select
                            class="absolute appearance-none rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400"
                            required>
                            <option value="">acres</option>
                            <!-- <option value="acres">acres</option>
                                    <option value="ha">ha</option> -->
                        </select>
                    </div>
                </div>
            </div>
            <!--Farm Ownership-->
            <div class="">
                <div class="relative w-64">
                    <select name="ownership_type" wire:model.defer="ownership_type" id="ownership_type"
                        class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline"
                        required>
                        <option value=''>Farm Ownership</option>
                        @foreach($ownership_types as $ownership_type)
                        <option value="{{$ownership_type->id}}" input type="hidden">{{$ownership_type->value}}
                        </option>
                        @endforeach
                        </option>

                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Location Pin/Map-->
    <div class="mt-6">
        <h2 class="font-bold text-gray-900">Draw the farm boundary (Optional)</h2>
        <div class="pt-6">
            <div id="bounds_div">
            </div>
        </div>
    </div>


</div>