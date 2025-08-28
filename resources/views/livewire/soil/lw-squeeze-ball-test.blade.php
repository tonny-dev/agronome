<div class="soil_test_slide w-full">
    <!--Graphic area-->
    <h2 class="font-bold underline mb-5 flex justify-center">Squeeze Ball Test</h2>


    <div>
        <div class="stepper-wrapper">
            <div class="stepper-item" id="squeeze_ball_step1">
                <div class="step-counter-active">1</div>
                <div class="step-bar-inactive"></div>
            </div>
            <div class="stepper-item" id="squeeze_ball_step2">
                <div class="step-counter-inactive">2</div>
                <div class="step-bar-inactive"></div>
            </div>
            <div class="stepper-item" id="squeeze_ball_step3">
                <div class="step-counter-inactive">3</div>
            </div>
        </div>

        <div id="all_slides_squeeze_ball">

            <div id="div_squeeze_ball1" class="grid grid-cols-1 gap-2 md:grid-cols-2 mx-20 xl:grid-cols-3 lg:grid-cols-3 pb-4 d-grid">
                <p class="test_text">Take a dry soil sample and wet it</p>
                <img class="rounded border border-green-600  w-24 h-24" src="{{ asset('images/squeezballtestimages/image 1.svg') }}" alt="Image of small sample of dry soil being wet" title="Take a dry soil sample and wet it">
            </div>


            <div id="div_squeeze_ball2" class="grid grid-cols-1 gap-4 md:grid-cols-1 mx-20 xl:grid-cols-2 lg:grid-cols-2 pb-4 d-none">
                <p class="test_text">Squeeze it hard and then open your hand</p>
                <img class="rounded border border-green-600  w-24 h-24" src="{{ asset('images/squeezballtestimages/image 2.svg') }}" alt="Image of the soil being squeezed hard" title="Squeeze it hard and then open your hand">
            </div>

            <div id="div_squeeze_ball3" class="d-none">
                @include('livewire.soil.lw-squeeze-ball-questions')
            </div>
        </div>



        <div class="bg-sky-100 row mt-5">

            <button id="btn_squeeze_ball_test_next" class="btn_test_active" style="float: right;">Next</button>
            <button id="btn_squeeze_ball_test_back" class="btn_test_inactive" style="float: left;">Back</button>
            <button id="btn_squeeze_ball_after_box_click" class="btn_test_active d-none" style="float: right;">Next</button>

        </div>


    </div>


    <script>
        step = 1;


        $('#btn_squeeze_ball_test_next').off().on('click', function() {

            if (step == 1) {
                test_div_switch('div_squeeze_ball2', 'div_squeeze_ball1');
                move_slider('#squeeze_ball_step2', 'step-counter-inactive', 'step-counter-active')
                move_slider('#squeeze_ball_step1', 'step-bar-inactive', 'step-bar-active')
                $('#btn_squeeze_ball_test_back').removeClass('btn_test_inactive');
                $('#btn_squeeze_ball_test_back').addClass('btn_test_active');
                step = 2;
                return;
            }

            if (step == 2) {


                test_div_switch('div_squeeze_ball3', 'div_squeeze_ball2');
                move_slider('#squeeze_ball_step2', 'step-bar-inactive', 'step-bar-active')
                move_slider('#squeeze_ball_step3', 'step-counter-inactive', 'step-counter-active')
                $("#btn_squeeze_ball_test_next").prop("disabled", true).css("backgroundColor", "#e5e7eb");

                step = 3;
                return;
            }


            if (step == 3) {
                test_div_switch('div_squeeze_ball1', 'div_squeeze_ball3');
                step = 1;
                return;
            }

        });



        $('#btn_squeeze_ball_test_back').off().on('click', function() {

            if (step == 3) {
                test_div_switch('div_squeeze_ball2', 'div_squeeze_ball3');
                move_slider('#squeeze_ball_step3', 'step-counter-active', 'step-counter-inactive')
                move_slider('#squeeze_ball_step2', 'step-bar-active', 'step-bar-inactive')
                $("#btn_squeeze_ball_test_next").prop("disabled", false).css("backgroundColor", "#fff");
                $('#btn_squeeze_ball_test_next').html('Next');
                step = 2;
                return;
            }

            if (step == 2) {
                test_div_switch('div_squeeze_ball1', 'div_squeeze_ball2');
                move_slider('#squeeze_ball_step2', 'step-counter-active', 'step-counter-inactive')
                move_slider('#squeeze_ball_step1', 'step-bar-active', 'step-bar-inactive')
                step = 1;
                return;
            }

        });
    </script>

</div>