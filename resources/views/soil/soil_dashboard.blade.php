@include('layouts.app')
@section('content')

<body class="font-sans">
    <div class="flex min-h-screen">
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- NAV BAR -->
            @include('layouts.top-nav')
            <!-- END NAV BAR -->


            <div class="flex h-full">
                <!--Left menu -->
                <nav class="flex md:w-60 h-full bg-white hidden md:block lg:block border-r">
                    <div class="w-full flex max-auto pl-8">
                        <ul class="w-full">

                            <li class="pt-5 font-bold text-gray-300 hover:text-green-600 ">
                                <a href="{{route('farmer.farmer_dashboard') }}"><span class="float-left"><img src="{{ asset('svg/farm_inactive.svg') }}" alt="farm"></span>
                                    <span class="pl-4 ">Farm</span>
                                </a>
                            </li>

                            <li class="pt-5 font-bold text-gray-300 hover:text-green-600 ">
                                <a href="{{route('crop_dashboard') }}">
                                    <span class="float-left"> <img src="{{ asset('svg/crop_inactive.svg') }}" alt="crop"></span><span class="pl-4 ">Crop</span></a>
                            </li>

                            <li class="pt-5 font-bold text-green-600 hover:shadow-sm shadow-blue-800/50">
                                <a href="{{route('soil_dashboard') }}"> <span class="float-left pt-2"><img src="{{ asset('svg/soil_mi.svg') }}" alt="soil"></span><span class="pl-4 hover:text-green-600">Soil</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Left menu end -->

                <main class="w-full bg-white overflow-x-hidden md:mb-0 mb-20">
                    <div class="w-full mx-auto px-6">

                        <div id="div_soil_button_headers" class="d-none mb-3 mt-4">
                            @livewire('lw-soil-button-headers')
                        </div>

                        <div id="div_disabled_soil_button_headers" class="d-none mb-2 mt-4">
                            @livewire('lw-disabled-soil-button-headers')
                        </div>

                        <div id="div_soil_landing_graphic" class="md:mt-4 mt-4">
                            @include('soil.welcome-button')


                            <h2 class="text-gray-700 transform uppercase text-center md:pt-2 pt-20 leading-8">Welcome to Soil</h2>

                            <div class="text-center md:m-2 mt-10 md:mt-0">
                                <img src="{{ asset('images/soil_welcome.png') }}" width="200px" height="200px" class="inline-block m-0 auto">
                            </div>

                            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hidden md:block">
                                <p class="font-medium">This area assists you to:</p>
                                <ul class="font-thin">
                                    <li>- Review and conduct guided soil tests</li>
                                    <li>- Record and analyse results for better information on various soil properties on your farm.</li>
                                </ul>
                                <br>
                                <p class="font-medium">These soil tests <strong>-Physical and -chemical </strong> </p>
                                <p class="font-thin">Help improve crop and input reccommendations and advisories service for better farming.</p>
                            </div>
                        </div>

                        <div id="div_instructions" class="d-none mb-2">
                            @include('soil.instructions')
                        </div>

                        <div id="div_physical_tests" class="d-none mt-4 md:mt-2">
                            @livewire('lw-physical-tests')
                        </div>

                        <div id="div_web_soil_test_results" class="hidden mt-4 md:mt-2">
                            @livewire('lw-web-soil-results')
                        </div>

                        <!-- DRY CRUSHING TEST DIVS  -->

                        <div id="div_manipulative_summary" class="d-none mb-3 mt-6">
                            @livewire('soil.lw-manipulative-summary')
                        </div>

                        <div id="div_manipulative_test" class="d-none mb-3 mt-6">
                            @livewire('soil.lw-manipulative-test')
                        </div>

                        <div id="div_manipulative_results" class="d-none mb-3">
                            @livewire('soil.lw-manipulative-results')
                        </div>

                        <!-- THROW BALL TEST DIVS  -->
                        <div id="div_throw_ball_summary" class="d-none mb-3 mt-6">
                            @include('soil.throw_ball_summary')
                        </div>
                        <div id="div_throw_ball_test" class="d-none mb-3 mt-6">
                            @include('soil.throw_ball_test')
                        </div>
                        <div id="div_throw_ball_results" class="d-none mb-3">
                            @livewire('throw-ball-results')
                        </div>
                        <div id="div_throw_ball_questions" class="d-none">
                            @livewire('lw-throw-ball-questions')
                        </div>

                        <!--  BALL AND RIBBON TEST DIVS  -->

                        <div id="div_mud_ball_summary" class="d-none mb-3 mt-6">
                            @livewire('soil.lw-mud-ball-summary')
                        </div>

                        <div id="div_mud_ball_test" class="d-none mb-3 mt-6">
                            @livewire('soil.lw-mud-ball-test')
                        </div>

                        <div id="div_mud_ball_results" class="d-none mb-3">
                            @livewire('soil.lw-mud-ball-results')
                        </div>



                        <!-- SQUEEZE BALL TEST DIVS  -->

                        <div id="div_squeeze_ball_summary" class="d-none mb-3 mt-6">
                            @livewire('soil.lw-squeeze-ball-summary')
                        </div>

                        <div id="div_squeeze_ball_test" class="d-none mb-3 mt-6">
                            @livewire('soil.lw-squeeze-ball-test')
                        </div>

                        <div id="div_squeeze_ball_results" class="d-none mb-3">
                            @livewire('soil.lw-squeeze-ball-results')
                        </div>


                        <div id="div_soil_next" class="flex justify-center mt-8 md:mt-2">
                            <button id="btn_soil_next" class="active focus:outline-none text-xs py-2 px-4 rounded-lg w-64 hidden md:block">
                                Proceed to Instructions
                            </button>

                            <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 md:hidden">
                                <div class="pb-4">
                                    <p id="mbsnp">To conduct soil tests click</p>
                                    <button id="mobile_btn_soil_next" class="active focus:outline-none text-xs py-2 px-4 rounded-lg w-48">
                                        Report
                                    </button>
                                </div>

                                <div id="mbvr">
                                    <p>To view soil test results</p>
                                    <button id="mobile_view_soil_results" class="active focus:outline-none text-xs py-2 px-4 rounded-lg w-48">
                                        <a href="{{route('soil_results') }}">Results</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- RIGHT SIDE BAR  -->

                <nav class="flex w-80 h-full hidden md:block lg:block bg-white border-l">
                    <div id="div_advanced_search" class="d-block">
                        @livewire('soil.report-record-show')
                    </div>


                    {{-- <div id="div_throw_ball_info" class="d-none">
                        @livewire('lw-throw-ball-info')
                    </div> --}}
                </nav>
            </div>

        </div>
    </div>

    @include('layouts.mobile-footer')

    <script>
        $step = 0;
        hide_div('report-record-button');

        $('#btn_soil_next, #mobile_btn_soil_next').off().on('click', function() {


            if ($step == 0) {
                div_toggle('div_disabled_soil_button_headers', 'div_soil_landing_graphic');
                show_div('div_instructions');
                show_div('report-record-button');
                hide_div('mbvr');
                hide_div('mbsnp');
                $("#btn_soil_next").html("Next");
                $('#mobile_btn_soil_next').text("Click here to proceed")
                $step = 1;
                return;
            }

            if ($step == 1) {
                $("#soil_instruction_title").text("Follow this steps");
                $("#mobile_step_instructions").html(`
                                    <ul class="list-disc">
                            <li>Click on the
                                <button class="w-auto bg-white relative border px-1 py-1 pr-10 text-xs rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                                    Choose Farm
                                    <span class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button>button above to select your farm of choice for soil testing.
                            </li>
                            <li> Click on the <button class="w-24 bg-white relative border px-1 py-1 pr-8 text-xs rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                                    Field
                                    <span class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button> button above to change or select a field of choice for soil testing (Note: Only possible for Mixed Farming)</li>
                            <li> Click on the <button class="w-24 bg-white relative border px-1 py-1 pr-8 text-xs rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                                    Test Type
                                    <span class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button> button above to select a type of soil test - Physical or Chemical</li>
                        </ul>
                `);
                $("#farm").attr("disabled", false);
                show_div('div_instructions');
                hide_div('div_soil_next');
                div_toggle('div_soil_button_headers', 'div_disabled_soil_button_headers');

                $step = 2;
                return;
            }

        });




        function div_toggle(show_div, hide_div) {


            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).addClass("d-block");


            $('#' + hide_div).removeClass("d-block");
            $('#' + hide_div).addClass("d-none");

        }

        // TODO: Merge this with the first one
        // This is used to correctly show the active summary div, when test type is selected.
        function div_toggle2(show_div, hide_div) {
            var allDivs = [
                'div_throw_ball_summary',
                'div_squeeze_ball_summary',
                'div_mud_ball_summary',
                'div_manipulative_summary',
                'div_physical_tests'
            ];

            // Hide all divs
            allDivs.forEach(function(div) {
                $('#' + div).removeClass("d-block").addClass("d-none");
            });

            $('#' + show_div).removeClass("d-none").addClass("d-block");
        }

        function populate_div(parent, child) {

            $('#' + parent).empty();
            show_div(child);
            $('#' + child).prependTo('#' + parent);


        }


        function test_div_switch(show_div, hide_div) {

            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).removeClass("d-none");

            $('#' + show_div).addClass("d-grid");

            $('#' + hide_div).removeClass("d-grid");
            $('#' + hide_div).addClass("d-none");


        }


        function hide_div(hide_div) {

            $('#' + hide_div).removeClass("d-block");
            $('#' + hide_div).addClass("d-none");

        }

        function show_div(show_div) {

            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).addClass("d-block");

        }


        // The below method to be used in base files ending with _test.blade.php
        function move_slider(selector, inactiveclass, activeclass) {
            $(selector + ' .' + inactiveclass).removeClass(inactiveclass).addClass(activeclass);

        };


        const menuBtn = document.querySelector('#menu-btn');
        const dropdown = document.querySelector('#dropdown');

        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        })


        $(document).on('click', '#a_complete_profile', function() {
            $('#complete_profile').modal('show');
        });
    </script>

    @livewireScripts
</body>

</html>