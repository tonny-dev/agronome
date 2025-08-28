<div id="soil_test_report">

    <div class="md:flex gap-4 lg:mt-0 mb-2 md:mt-0 mt-0 md:justify-between">

        <!--Farm Name-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select wire:model="farm" name="farm" id="farm" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected value=''>Choose a Farm</option>
                @foreach($farms as $farm)
                <option value="{{$farm->id}}" type="hidden">{{$farm->name}}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>


        <!--Select Field-->
        <div class="relative inline-block md:w-64 hidden md:block">
            <select wire:model="field" name="field" id="field" class="block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="0">Field</option>
                @if ($fields !== 0)
                @foreach ($fields as $fieldOption)
                <option value="{{ $fieldOption->id }}">{{ $fieldOption->name }}</option>
                @endforeach
                @else
                <option value="{{ $mono_allocation }}">F-01-{{ $mono_allocation }}</option>
                @endif
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>

        <!--Field Size-->
        <div class="relative inline-block md:w-64 hidden md:block">
            <input wire:model="allocation" value="" id="allocation" class="block appearance-none w-full bg-white text-gray-700 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" readonly>
            <div>
                <span class="absolute appearance-none rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400">
                    <option value="">acres</option>
                </span>
            </div>
        </div>

        <!-- Mobile buttons -->

        <div class="grid grid-cols-2 gap-4 md:hidden">
            <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
                <select wire:model="field" name="field" id="mobile_field" class="block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="0">Field</option>
                    @if ($fields !== 0)
                    @foreach ($fields as $fieldOption)
                    <option value="{{ $fieldOption->id }}">{{ $fieldOption->name }}</option>
                    @endforeach
                    @else
                    <option value="{{ $mono_allocation }}">F-01-{{ $mono_allocation }}</option>
                    @endif
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>

            </div>

            <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
                <input wire:model="allocation" value="" id="mobile_allocation" class="block appearance-none w-full bg-white text-gray-700 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" readonly>
                <div>
                    <span class="absolute appearance-none rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400">
                        <option value="">acres</option>
                    </span>
                </div>
            </div>

        </div>

    </div>




    <!--second row starts here -->


    <div class="md:flex md:justify-between lg:mt-6 mb-2 md:mt-6 xl:mt-6 mt-2 gap-4" id="test_report_buttons">


        <!--TEST TYPE-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select wire:model="testTipo" name="testTipo" id="testTipo" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected value='' class="bg gray-300">Test Type</option>
                if $test_tipos
                @foreach($test_tipos as $testTipo)
                <option value="{{$testTipo->id}}" type="hidden">{{$testTipo->value}}</option>
                @endforeach
                endif
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="mgray h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill="white" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>


        <!--SELECT TEST-->
        <div class="relative inline-block md:w-64 hidden md:block" id="web_record_soil_test_name">
            <select wire:model="soilTest" name="soilTest" id="webSoilTest" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected value='666'>All Tests</option>
                if $soil_tests
                @foreach($soil_tests as $soilTest)
                <option value="{{$soilTest->id}}" type="hidden">{{$soilTest->value}}</option>
                @endforeach
                endif
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>


        <!--TEST DATE-->
        <div class="relative inline-block w-full md:w-64 hidden md:block" id="web_record_date">

            <input wire:model="test_date" readonly class="shadow appearance-xl border text-xs rounded-xl w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-10 hidden" id="test_date">

            <input readonly class="shadow appearance-xl border text-small rounded-xl w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-10 d-block" id="web_test_date" placeholder="Date" wire:ignore>

            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>


        </div>

        <div class="grid grid-cols-2 gap-4 md:hidden">
            <div class="relative inline-block w-full mt-4">
                <select wire:model="soilTest" name="soilTest" id="mobile_soil_test" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option selected value='666'>All Tests</option>
                    if $soil_tests
                    @foreach($soil_tests as $soilTest)
                    <option value="{{$soilTest->id}}" type="hidden">{{$soilTest->value}}</option>
                    @endforeach
                    endif
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>

            </div>



            <div class="relative inline-block w-full mt-4">
                <div id="mobile_test_date_container"></div>
                <input readonly class="shadow appearance-xl border text-small rounded-xl w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-10 md:d-none" id="test_date2" placeholder="Date" wire:ignore>

                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>


            </div>
        </div>
    </div>






    <script>
        let THROW_BALL = 1017;
        let DRY_CRUSH = 1019;
        let SQUEEZE_BALL = 1018;
        let BALL_RIBBON = 1014;


        $("#field, #allocation, #mobile_field, #mobile_allocation, #testTipo, #webSoilTest, #test_date2, #web_test_date, #test_date, #mobile_soil_test")
            .prop("disabled", true)
            .css("backgroundColor", "#e5e7eb");

        // sets the text value of soilTest option to All Tests
        $('#farm').change(
            function() {
                $("#allocation, #testTipo, #test_date, #test_date2, #mobile_soil_test, #webSoilTest, #web_test_date").attr("wire:ignore", "");

                $("#field, #allocation, #mobile_field, #mobile_allocation")
                    .prop("disabled", false)
                    .css("backgroundColor", "#fff");

                $("#testTipo, #webSoilTest, #test_date").prop("disabled", true).css("backgroundColor", "#e5e7eb");
                var allocation = $('#allocation').val();
                var field_select = $('#field option:selected').val();
            }
        )



        // // Checks if field value is changed and ables the testTipo

        $("#field, #mobile_field").on("change", function() {
            $("#testTipo").prop("disabled", false).css("backgroundColor", "#fff");
        });


        $('#testTipo').change(
            function() {
                $("#testTipo").css({
                    "background-color": "#168d4b",
                    "color": "white"
                });

                $("#webSoilTest, #test_date, #mobile_soil_test, #web_soil_result, #web_test_date").prop("disabled", false).css("backgroundColor", "#fff");

                $("#webSoilTest, #mobile_soil_test").removeAttr("wire:ignore");

                var tipo = $('#testTipo option:selected').val();


                if (tipo == 1011) {

                    div_toggle('div_physical_tests', 'div_instructions');
                    $('#webSoilTest option[value="666"]').text("All Tests");


                }

            }
        );

        function write_man_farm_details(location_id, date_id) {
            $(location_id).html($('#farm option:selected').text() + ',' + $('#field option:selected').text());
            $(date_id).html(String($('#test_date').val()));

        }

        function updateTestDateElements() {
            $('#web_test_date, #test_date2').hide();

            // Show the primary test date input
            $('#test_date').removeClass('hidden').addClass('block');

            // Clone the #test_date element and assign it to the mobile container
            $('#mobile_test_date_container')
                .empty()
                .append($('#test_date').clone().removeClass('hidden').addClass('block'));
        }

        $('#webSoilTest, #mobile_soil_test').change(
            function() {
                var tipo = $('#webSoilTest option:selected').val();
                var mobile_tipo = $('#mobile_soil_test option:selected').val();

                $("#web_soil_result").prop("disabled", true).css("backgroundColor", "#e5e7eb");

                updateTestDateElements();

                var showDiv;
                if (tipo == THROW_BALL || mobile_tipo == THROW_BALL) {
                    showDiv = 'div_throw_ball_summary';
                    write_man_farm_details('#span_location', '#span_date');

                } else if (tipo == SQUEEZE_BALL || mobile_tipo == SQUEEZE_BALL) {
                    showDiv = 'div_squeeze_ball_summary';
                    write_man_farm_details("#squeeze_ball_span_location", "#squeeze_ball_span_date");

                } else if (tipo == BALL_RIBBON || mobile_tipo == BALL_RIBBON) {
                    showDiv = 'div_mud_ball_summary';
                    write_man_farm_details('#mud_ball_span_location', '#mud_ball_span_date');

                } else if (tipo == DRY_CRUSH || mobile_tipo == DRY_CRUSH) {
                    showDiv = 'div_manipulative_summary';
                    write_man_farm_details('#man_span_location', '#man_span_date');

                }

                if (showDiv) {
                    div_toggle2(showDiv, 'div_physical_tests');
                }

            }
        );
    </script>




</div>