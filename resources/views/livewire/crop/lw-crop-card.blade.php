<div>

    <div class="grid grid-cols-3 gap-4 content-center mt-12">

        <!--Farm Name-->
        <div class="w-1/3 ">
            <div class="relative w-64">
                <select wire:model="farm" name="farm" id="farm"
                    class="block appearance-none w-full bg-green-800 
                  text-white  px-4 py-2 pr-8 
                      rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option selected value=''>Choose a Farm</option>
                    @foreach ($farms as $farm)
                        <option value="{{ $farm->id }}" type="hidden">{{ $farm->name }}</option>
                    @endforeach
                </select>
                <div
                    class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="  h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill="#FFFFFF"
                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>


        <!--County-->
        <div class="w-1/2">
            <div class="relative w-64">
                <input wire:model.defer="county" name="county" id="county"
                    class="block appearance-none rounded-xl w-full bg-white border  px-4 py-2 pr-8  w-32 py-2 px-2 
                text-green-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="farm-name" type="text" placeholder="County" required>
            </div>
        </div>


        <!--Constituency-->

        <div class="w-1/2">
            <div class="relative w-64">
                <input wire:model.defer="constituency" name="constituency" id="constituency"
                    class="block appearance-none rounded-xl w-full bg-white border  px-4 py-2 pr-8  w-32 py-2 px-2 
                text-green-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="farm-name" type="text" placeholder="Constituency" required>
            </div>
        </div>

        <!--CROP-->

        <div class="w-1/3">
            <div class="relative w-64">
                <select wire:model="crop" name="crop" id="crop"
                    class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 mt-2
                 rounded-xl shadow leading-tight 
                focus:outline-none focus:shadow-outline"
                    required>
                    <option selected value=null>Select Crop</option>
                    @foreach ($crops as $crop)
                        <option value="{{ $crop->id }}" type="hidden">{{ $crop->name }}</option>
                    @endforeach
                </select>
                <div
                    class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>

            </div>

        </div>



        <!--VARIETIES-->

        <div class="w-1/3">
            <div>
                <button wire:click="varieties_clicked" id="btn_crop_vars"
                    class="border {{ $varieties_clicked
                        ? 'bg-green-800 text-white hover:text-white'
                        : 'bg-white  text-gray-600 hover:text-white ' }}  
                 border-gray-300 
                py-2 px-2 rounded-full w-64 mt-2 hover:bg-green-800  ">
                    Varieties
                </button>
            </div>
        </div>


        <!--ALTERNATIVES-->

        <div class="w-1/3">
            <div>
                <button wire:click="alternatives_clicked" id="btn_crop_alts"
                    class="border  {{ $alternatives_clicked
                        ? 'bg-green-800 text-white hover:text-white'
                        : 'bg-white  text-gray-600 hover:text-white ' }}  
            border-gray-300
            py-2 px-2 rounded-full w-64 mt-2 hover:bg-green-800 hover:text-white ">
                    Alternatives
                </button>
            </div>
        </div>


    </div>

    <div class="bg-gray-200 rounded-full border border-gray-100  shadow shadow-lg   w-full h-2 mt-2"></div>


    @if ($crop_name)
        <div id="crop_details_card" class="crop_details_card mt-2 pb-2 shadow-lg ">

            <div id="crop_card_header" class="uppercase text-xl">{{ $crop_name }}</div>

            <div class="gen_info_card flex">

                <div class="font-semibold">Alt Names :</div>
                <div class="">{{ $alternative_name }}</div>

                <div class="font-semibold">&nbsp;&nbsp;Classification:</div>
                <div class="">{{ $class_blurb }}</div>

            </div>

            <div wire:ignore id="crop_altitude_card" class="crop_altitude_card mt-4">

                <div class="font-semibold">Crop Altitude </div>


                <div id="alt_graphic_div" class="pb-4" style="width: 900px; overflow: scroll; z-index:-1;">

                    <canvas id="cnv_altitude_graphic" class="ml-10  mt-5 mb-2"></canvas>

                </div>


            </div>


            <div id="crop_calendar_card" class="crop_altitude_card mt-4 ">

                <div class="flex ">
                    <div class="font-semibold">
                        <p>Crop Calendar:&nbsp; </p>
                    </div>
                    <!--All Seasons Button-->
                    <div class="space-3">
                        <div class="px-0  ">
                            <div class="relative w-22">
                                <select
                                    class="block appearance-none w-full active border  px-3 py-2 pr-12 rounded-2xl shadow leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">All Seasons</option>
                                    <option value="">Long Rains</option>
                                    <option value="">Short Rains</option>

                                </select>
                                <div
                                    class="   pointer-events-none absolute inset-y-0 right-0 border-l border-white flex items-center px-2 text-white">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex m-3">
                        <div class="py-3"
                            style="width: 30px; height: 30px; background-color: #0665A9;margin-left:220px;margin-right: 4px;">
                        </div>
                        Long Rains
                    </div>
                    <div class="flex m-3">
                        <div style="width: 30px; height: 30px; background-color: #414141;margin-right: 4px;">
                        </div>
                        Short Rains
                    </div>
                    <div class="flex m-3">
                        <div style="width: 30px; height: 30px; background-color: #E5DB24;margin-right: 4px;">
                        </div>
                        Harvest Season
                    </div>



                </div>

                <div class="flex m-2">
                    <table class="min-w-full shadow-md rounded border-collapse mb-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-2 border border-gray-300 text-center font-bold">Jan</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Feb</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Mar</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Apr</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">May</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Jun</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Jul</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Aug</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Sep</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Oct</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Nov</th>
                                <th class="p-2 border border-gray-300 text-center font-bold">Dec</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <tr>
                                <td class="p-2" style="background-color: #0665A9;"></td>
                                <td class="p-2" style="background-color: #0665A9;"></td>
                                <td class="p-2" style="background-color: #0665A9;"></td>
                                <td class="p-2" style="background-color: #0665A9;"></td>
                                <td class="p-2" style="background-color: #0665A9;"></td>
                                <td class="p-2" style="background-color: #FFF;"></td>
                                <td class="p-2" style="background-color: #FFF;"></td>
                                <td class="p-2" style="background-color: #FFF;"></td>
                                <td class="p-2" style="background-color: #FFF;"></td>
                                <td class="p-2" style="background-color: #414141;"><span
                                        style="color: #414141;">.</span>
                                </td>
                                <td class="p-2" style="background-color: #414141;"></td>
                                <td class="p-2" style="background-color: #414141;"></td>
                            </tr>
                            <tr>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2 text-white" style="background-color: #168D4B;">Planting </td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2 text-white" style="background-color: #168D4B;"> Planting </td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                            </tr>
                            <tr>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2" style="background-color: #E5DB24;"><span
                                        style="color: #E5DB24;">.</span>
                                </td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                                <td class="p-2" style="background-color: #E5DB24;"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <div wire:ignore id="crop_soil_card" class="crop_altitude_card mt-4 mb-4">

                <div class="font-semibold">Soil information </div>

                <div class="mb-4">
                    <div
                        class="bg-gray-100 mt-4 flex items-center justify-center space-x-12 shadow py-3 px-6 rounded-2xl ">
                        <div class="bg-red-400 w-6 h-6 rounded-full"></div>
                        <div class="bg-blue-300 w-6 h-6 rounded-full"></div>
                        <div class="bg-green-500 w-6 h-6 rounded-full"></div>
                        <div class="bg-gray-400 w-6 h-6 rounded-full"></div>
                        <div class="bg-yellow-300 w-6 h-6 rounded-full"></div>
                        <div class="bg-red-700 w-6 h-6 rounded-full"></div>
                    </div>

                    <div class=" bg-white center flex items-center justify-center py-2 mb-2 px-6  ">
                        <div class="">CLICK <a href="{{ route('soil_dashboard') }}"
                                class="text-green-400 underline mb-2">SOIL TEST</a> TO FIND OUT SOIL TYPE !
                        </div>
                    </div>
                </div>



            </div>

            <div id="yield_calculator" class="crop_altitude_card mb-2 pb-4">

                <div class="font-semibold">Yield calculator</div>
                <div class=" mt-5 pb-2 bg-white rounded-xl shadow-xl">
                    <div class="flex space-2">
                        <div class="mt-2 flex-1 mr-4">

                            <input class="w-full px-5 py-2 px-2 text-gray-700 bg-gray-100 rounded " id="seed"
                                name="seed" type="number" required="" placeholder="Amount of Seed">

                        </div>
                        <div class="mt-2 flex-2 p-2 mr-4 ">
                            <p>to</p>
                        </div>
                        <div class="mt-2 flex-1">

                            <input class="w-full px-5  py-2 text-gray-700 bg-gray-100 rounded" id="yield" name="yield"
                                type="number" required="" placeholder="Yield from Seed">
                        </div>
                    </div>
                </div>

            </div>


            <div id="action_card" class="crop_altitude_card" onmouseover="write_field_name()">

                <div class="font-semibold">Plant Crop</div>
                <div class="grid grid-cols-3 gap-4 content-center mt-2 pb-4 ml-16">


                    <!--FARM-->

                    <div class="w-1/3">
                        <div>
                            <button id="btn_confirm_farm"
                                class="bg-green-800 border border-gray-300  text-white
                                  py-2 px-4 rounded-full w-64  ">
                                Farm : {{ $farm->name }}
                            </button>
                        </div>
                    </div>

                    <!--FIELD-->

                    <div class="w-1/3">
                        <div>
                            <button id="btn_confirm_field"
                                class="bg-green-800 border border-gray-300  text-white
              py-2 px-4 rounded-full w-64 mt-2  hover:text-white ">
                                Field : <span id="span_field"></span>
                            </button>
                        </div>
                    </div>

                    <!--PLANT-->

                    <div class="w-1/3">
                        <div>
                            <button id="btn_action_plant"
                                class="bg-green-800 border border-gray-300 hover:bg-red-800 text-white 
              py-2 px-4 rounded-full w-64 mt-2 hover:bg-red-800 hover:text-white ">
                                Plant : {{ $crop_name }}
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    @endif


    
    <script>
        function write_field_name() {

            // $("#soilTest").val("1014").change();

            $('#span_field').html($('#field_name_adv option:selected').text());
            // $('#span_date').html(String($('#test_date').val()));

        }
    </script>

</div>