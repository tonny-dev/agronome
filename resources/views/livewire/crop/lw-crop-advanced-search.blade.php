<div>

    <!-- ADVANCED SEARCH -->

    @if ($show_advanced_search)

        <div id="advanced_search_section" class="d-block ml-2">

            <div id="field_selection" class=" ">
                <div class="relative w-full  ">



                    <select wire:model="field" name="field" id="field_name_adv"
                        class="appearance-none w-64 bg-white border px-2  py-2  rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline"
                        required>
                        <option selected value='0'>Field</option>
                        if $fields
                        @foreach ($fields as $field)
                            <option value="{{ $field->id }}" type="hidden">{{ $field->name }}</option>
                        @endforeach
                        endif
                    </select>


                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                        <svg class="  h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill="#000000"
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="text-green-700 font-bold mt-4 text-center"> ADVANCED SEARCH </div>
            <div class="bg-green-900 mt-2 h-1"> </div>


            @if ($show_advanced_alternatives)

                <div id="div_alternatives_advanced_search" class="d-block">

                    <div class="w-full">
                        <div>
                            <button wire:click="filterCrops" id="`"
                                class="bg-green-800 border border-gray-300 hover:bg-red-800 text-white 
                py-1 px-4 rounded-full w-64 mt-2 hover:bg-green-200 hover:text-white ">
                                filter by class 
                            </button>
                        </div>
                    </div>

                    <div id="check_boxes_filter" class="grid grid-cols-2 gap-4 content-center mt-4">



                        <label class="inline-flex  ">
                            <input wire:model="selectedClasses" type="checkbox"
                                class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600"
                                value="{{ $cereals_checked }}" checked>
                            <span class="ml-2 mb-4 font-semibold">Cereals</span>
                        </label>



                        <label class="inline-flex  ">
                            <input wire:model="selectedClasses" type="checkbox"
                                class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600"
                                value="{{ $legumes_checked }}" checked>
                            <span class="ml-2 mb-4 font-semibold">Legumes</span>
                        </label>


                        <label class="inline-flex  ">
                            <input wire:model="selectedClasses" type="checkbox"
                                class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600"
                                value="{{ $tubers_checked }}" checked>
                            <span class="ml-2 mb-4 font-semibold">Tubers</span>
                        </label>



                        <label class="inline-flex  ">
                            <input wire:model="selectedClasses" type="checkbox"
                                class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600"
                                value="{{ $vegetables_checked }}" checked>
                            <span class="ml-2 mb-4 font-semibold">Vegetables</span>
                        </label>

                    </div>


                    
                    <div class="w-full">
                        <div>
                            <button  id="btn_sort_crops"
                                class="bg-green-800 border border-gray-300 hover:bg-red-800 text-white 
                py-1 px-4 rounded-full w-64 mt-2 hover:bg-green-200 hover:text-white ">
                                Sort By
                            </button>
                        </div>
                    </div>

                    <div id="sort_crops" class="grid grid-cols-2 gap-4 content-center mt-4 mb-4">




          <select wire:model='cropYieldSortOrder' 
                class="appearance-none w-full bg-white border px-2 py-2 rounded-xl shadow leading-tight border border-gray-800 text-xs
                    focus:outline-none focus:shadow-outline"    
                required>
            @foreach ($yieldSortOrders as $key => $value)
                <option value="{{ $key }}" {{ $yieldSortOrders == $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
          </select>





                    <select wire:model='cropMaturitySortOrder'
                        class="appearance-none w-full bg-white border px-2  py-2  rounded-xl shadow leading-tight border border-gray-800 text-xs
                     focus:outline-none focus:shadow-outline"
                        required>
                        <option selected value='0'>Maturity Duration</option>
                            @foreach ($maturitySortOrders as $key => $value)
                                <option value={{ $key }} type="hidden">{{ $value }}</option>
                            @endforeach
                    </select>


                    </div>

                    <div id="mini_crop_card_container">

                        {{-- @if ($filteredCrops) --}}

                            @foreach ($allCrops as $crop)
                                <div class="mb-2 ">
                                    <div class="grid  mb-2 w-full">
                                        <div class="relative w-22 ">
                                            <button
                                                class="block appearance-none w-full bg-white border  py-2 pr-1 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                                                <label> {{ $crop->name }}</label>
                                            </button>



                                            <button wire:click="minicard_clicked('{{ $crop->name }}')"
                                                class="accordion bg-green-600 rounded-xl  absolute inset-y-0 right-0 border-l
                                                 border-white flex items-center text-white font-semibold">
                                                <span class="pb-2">...</span>
                                            </button>

                                        </div>
                                    </div>



                                    @if ($crop_to_show == $crop->name)
                                        <div class="mini_card grid grid-cols-2 gap-4 content-center">
                                            <div class="font-semibold text-sm">Alt Names:</div>
                                            <div class="">{{ $crop->name }}</div>
                                            <div class="font-semibold text-sm">Classification:</div>
                                            <div class="">{{ $crop->class }}</div>
                                            <div class="font-semibold text-sm">Altitude:</div>
                                            <div class="">{{ $crop->alt_min }} to
                                                {{ $crop->alt_max }}</div>
                                            <div class="font-semibold text-sm">Duration to Maturity:</div>
                                            <div class="">{{ $crop->name }}</div>
                                            <div class="font-semibold text-sm">Estimated yield:</div>
                                            <div class="">
                                                {{ ($crop->yield_max + $crop->yield_min) / 2 }}</div>
                                        </div>
                                    @endif



                                </div>
                            @endforeach

                        {{-- @endif --}}

                    </div>
                </div>
            @endif


            @if ($show_advanced_varieties)
                <button
                    class="bg-green-800 border border-gray-300 hover:bg-red-800 text-white 
                    py-1 px-4 rounded-full w-64 mt-2 hover:bg-green-200 hover:text-white ">
                    Sort 
                </button>

                <div id="sort_varieties" class="grid grid-cols-2 gap-2  content-center mt-4 mb-4">

                    <select wire:model='yieldSortOrder' id=""
                        class="appearance-none w-full bg-white border px-2  py-2  rounded-xl shadow leading-tight border border-gray-800 text-xs
                     focus:outline-none focus:shadow-outline"
                        required>
                        @foreach ($yieldSortOrders as $key => $value)
                            <option value={{ $key }} type="hidden">{{ $value }}</option>
                        @endforeach
                    </select>



                    <select wire:model='maturitySortOrder' id=""
                        class="appearance-none w-full bg-white border px-2  py-2  rounded-xl shadow leading-tight border border-gray-800 text-xs
                     focus:outline-none focus:shadow-outline"
                        required>
                        <option selected value='0'>Duration to  Maturity</option>
                        @foreach ($maturitySortOrders as $key => $value)
                            <option value={{ $key }} type="hidden">{{ $value }}</option>
                        @endforeach
                    </select>


                    {{-- <button wire:click="toggle_maturity_sort" id="btn_sort_maturity"
                        class=" text-center border border-green-700  w-24  px-1 text-gray-800">Maturity
                        <i class="fa fa-sort-desc pb-2" aria-hidden="true"></i></button>

                    <button wire:click="toggle_yield_sort" id="btn_sort_yield"
                        class="text-center border border-green-600 w-24  px-1 text-gray-700">Yield
                        <i class="fa fa-sort-desc pb-2" aria-hidden="true"></i>
                    </button> --}}


                </div>


                <div id="filter_varieties_section">

                    <div class="w-full">
                        <div>
                            <button wire:click="filterVarieties" id=""
                                class="bg-green-800 border border-gray-300  text-white 
                                py-1 px-4 rounded-full w-64 mt-2 ">
                               {{$filter_varieties_button_text}} 
                            </button>
                        </div>
                    </div>



               

                <div id="varieties_check_boxes_filter" class="grid grid-cols-2 gap-4 content-center mt-8">



                    <label class="inline-flex  ">
                        <input wire:model="selectedXtics" type="checkbox"
                            class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600 text-xs"
                            value="{{ $pest_checked }}" unchecked>
                        <span class="ml-2 mb-4 font-semibold text-sm">Pest Resistance</span>
                    </label>



                    <label class="inline-flex  ">
                        <input wire:model="selectedXtics" type="checkbox"
                            class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600 text-xs"
                            value="{{ $drought_checked }}" unchecked>
                        <span class="ml-2 mb-4 font-semibold text-sm">Drought Resistance</span>
                    </label>


                    <label class="inline-flex  ">
                        <input wire:model="selectedXtics" type="checkbox"
                            class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-600 text-xs"
                            value="{{ $disease_checked }}" unchecked>
                        <span class="ml-2 mb-4 font-semibold text-sm">Disease Resistance</span>
                    </label>



                    <label class="inline-flex  ">
                        <input  type="checkbox"
                            class="h-4 w-4 mt-1 rounded-sm checked:bg-green-600 text-green-60 text-xs"
                            value="0" disabled>
                        <span class="ml-2 mb-4 font-semibold text-sm">market</span>
                    </label>

                </div>

            </div>

                <div id="mini_crop_card_container" class="overflow-y-auto h-96">

                    @if (!is_null($varieties))
                        @foreach ($varieties as $key => $value)
                            <div class="mb-2 ">
                                <div class="grid  mb-2 w-full">
                                    <div class="relative w-64">
                                        <button
                                            class="block appearance-none w-full bg-white border  py-2 pr-1 text-sm text
                                            rounded-xl shadow leading-tight focus:outline-none focus:shadow-outliPne">
                                            <label> {{ $value['name'] }}</label>
                                        </button>


                                        <button wire:click="variety_minicard_clicked('{{ $value['name'] }}')"
                                            class="accordion bg-green-600 rounded-xl  absolute inset-y-0 right-0 border-l border-white flex items-center px-4
                                             text-white font-semibold">
                                            <span class="pb-2">...</span>
                                        </button>

                                    </div>


                                    @if ($variety_to_show == $value['name'])
                                        <div class="mini_card grid grid-cols-2 gap-4 content-center">
                                            <div class="font-semibold text-sm">Alt Names:</div>
                                            <div class="">{{ $value['name'] }}</div>
                                            <div class="font-semibold text-sm">Altitude:</div>
                                            <div class="">{{ $value['alt_min'] }} to
                                                {{ $value['alt_max'] }}</div>
                                            <div class="font-semibold text-sm">Duration to Maturity:</div>
                                            <div class="">{{ ($value['maturity_min'] + $value['maturity_max'])/2 }}</div>
                                            <div class="font-semibold text-sm">Estimated yield:</div>
                                            <div class="">{{ $value['yield_max'] }}</div>
                                        </div>
                                    @endif

                                </div>
                        @endforeach
                    @endif
                </div>
          </div>
    @endif

</div>
@endif
</div>