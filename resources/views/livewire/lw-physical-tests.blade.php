<div class="bg-white shadow-xl border-green-200 h-96 border-l-1 border-b-4 border-r-1 rounded-lg overflow-y-scroll">
    <!--Graphic area-->

    <!--DRY CRUSHING-->
    <div class="shadow-lg flex justify-between rounded border my-2 mx-4">
        <div class="ml-2">
            <div class="my-2 flex-1">
                <p class="text-xs font-semibold underline" id="summary_manipulative">Dry Crush Test</p>
                <p class="text-xs font-light">A test conducted to estimate clay, loam or sand content in a dry soil sample.</p>
                <p class="text-xs font-light pt-4"><strong>Requires:</strong> Dry soil sample</p>
            </div>
        </div>
        <div class="ml-4 my-2 mx-4">
            <div class="flex-1 mb-2">
                <span class="text-blue-500 text-xs" class="margin-right:1%">{{$manipulative_percentage}}%</span>
            </div>
            @if($manipulative_percentage === 100)
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <button id="btn_start_manipulative" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Redo
                </button>
            </div>
            @else
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <button id="btn_start_manipulative" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Start
                </button>
            </div>
            @endif
        </div>
    </div>

    <!--SQUEEZE BALL TEST-->
    <div class="shadow-lg flex justify-between rounded border my-2 mx-4">
        <div class="ml-2">
            <div class="my-2 flex-1">
                <p class="text-xs font-semibold underline" id="summary_squeeze_ball">Squeeze Ball Test</p>
                <p class="text-xs font-light">A test conducted to estimate clay, loam or sand content in a <strong>wet</strong> soil sample.</p>
                <p class="text-xs font-light pt-4"><strong>Requires:</strong> Water and soil sample</p>
            </div>
        </div>
        <div class="ml-4 my-2 mx-4">
            <div class="flex-1 mb-2">
                <span class="text-blue-500 text-xs" class="margin-right:1%"> {{$squeeze_ball_percentage}}%</span>
            </div>
            @if($squeeze_ball_percentage === 100)
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <button id="btn_start_squeeze_ball" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Redo
                </button>
            </div>
            @else
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <button id="btn_start_squeeze_ball" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Start
                </button>
            </div>
            @endif
        </div>
    </div>

    <!--THROW BALL-->
    <div class="shadow-lg flex justify-between rounded border my-2 mx-4">
        <div class="ml-2">
            <div class="my-2 flex-1">
                <p class="text-xs font-semibold underline" id="summary_throw_ball">Throw Ball Test</p>
                <p class="text-xs font-light">A test conducted to estimate clay, loam or sand content in a <strong>wet</strong> soil sample.</p>
                <p class="text-xs font-light pt-4"><strong>Requires:</strong> Water and soil sample</p>
            </div>
        </div>
        <div class="ml-4 my-2 mx-4">
            <div class="flex-1 mb-2">
                <span class="text-blue-500 text-xs margin-right:10%"> {{$throw_ball_percentage}}%</span>
            </div>
            @if($throw_ball_percentage === 100)
            <div class="flex-1">

            </div>
            <div class="flex-1">
                <button id="btn_start_throw_ball" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2
                         px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Redo
                </button>
            </div>
            @else
            <div class="flex-1">

            </div>
            <div class="flex-1">
                <button id="btn_start_throw_ball" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2
                         px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Start
                </button>
            </div>

            @endif

        </div>
    </div>


    <!--BALL AND RIBBON-->
    <div class="shadow-lg flex justify-between rounded border my-2 mx-4">
        <div class="ml-2">
            <div class="my-2 flex-1">
                <p class="text-xs font-semibold underline" id="summary_mud_ball">Ball & Ribbon Test</p>
                <p class="text-xs font-light">A test to estimate texture of a wet soil sample.</p>
                <p class="text-xs font-light pt-4"><strong>Requires:</strong> Water, soil sample, flat hard surface</p>
            </div>
        </div>
        <div class="ml-4 my-2 mx-4">
            <div class="flex-1 mb-2">
                <span class="text-blue-500 text-xs" class="margin-right:1%"> {{$ribbon_ball_percentage}}%</span>
            </div>
            @if($ribbon_ball_percentage === 100)
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <button id="btn_start_mud_ball" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Redo
                </button>
            </div>
            @else
            <div class="flex-1">
            </div>
            <div class="flex-1">
                <button id="btn_start_mud_ball" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32">
                    Start
                </button>
            </div>
            @endif
        </div>
    </div>
    <!--end of  ball ribbon test-->

    <script>
        function updateAllSoilTestsSelectWithTheIdOfTheTestSelected(testId) {
            // Set the select element's value to the given testId and trigger change event
            $('#webSoilTest').val(testId).trigger('change');
        }

        /*Throw Ball Scripts*/

        $('#btn_start_throw_ball').off().on('click', function() {
            // Pass the id of the desired test
            updateAllSoilTestsSelectWithTheIdOfTheTestSelected(1017);

            write_man_farm_details('#span_location', '#span_date');
            updateTestDateElements();
            
            div_toggle('div_throw_ball_summary', 'div_physical_tests');

        });


        $('#btn_more_throw_ball ,#summary_throw_ball').off().on('click', function() {

            show_div('div_throw_ball_info');

        });


        /*Manipulative Scripts*/

        $('#btn_start_manipulative').off().on('click', function() {
            updateAllSoilTestsSelectWithTheIdOfTheTestSelected(1019);

            write_man_farm_details('#man_span_location', '#man_span_date');

            div_toggle('div_manipulative_summary', 'div_physical_tests');
            updateTestDateElements();


        });



        $('#btn_more_manipulative ,#summary_manipulative').off().on('click', function() {

            show_div('div_manipulative_info');



        });

        /*Mud Ball Scripts*/

        $('#btn_start_mud_ball').off().on('click', function() {
            updateAllSoilTestsSelectWithTheIdOfTheTestSelected(1014);

            write_man_farm_details('#mud_ball_span_location', '#mud_ball_span_date');

            div_toggle('div_mud_ball_summary', 'div_physical_tests');
            updateTestDateElements();


        });


        $('#btn_more_mud_ball ,#summary_mud_ball').off().on('click', function() {

            show_div('div_mud_ball_info');

        });


        /*Squeeze Ball Scripts*/

        $('#btn_start_squeeze_ball').off().on('click', function() {
            updateAllSoilTestsSelectWithTheIdOfTheTestSelected(1018);
            
            write_man_farm_details("#squeeze_ball_span_location", "#squeeze_ball_span_date");

            div_toggle('div_squeeze_ball_summary', 'div_physical_tests');
            updateTestDateElements();


        });


        $('#btn_more_squeeze_ball ,#summary_squeeze_ball').off().on('click', function() {

            show_div('div_mud_ball_info');

        });




        function check_if_filled() {

            if ($(this).val().length === 0 ||
                $(this).val().length === 0 ||
                $(this).val().length === 0 ||
                $(this).val().length === 0)

            {
                alert('error message here');
                return false;
            }

            return true;


        }
    </script>

</div>