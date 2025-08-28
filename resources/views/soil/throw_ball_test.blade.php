<div class="soil_test_slide w-full">
    <!--Graphic area-->
    <h2 class="font-bold underline mb-5 flex justify-center"> Ball Throw Test </h2>



    <div>

    <div class="stepper-wrapper">
            <div class="stepper-item" id="tball_step1">
                <div class="step-counter-active">1</div>
                <div class="step-bar-inactive"></div>
            </div>
            <div class="stepper-item" id="tball_step2">
                <div class="step-counter-inactive">2</div>
                <div class="step-bar-inactive"></div>
            </div>
            <div class="stepper-item" id="tball_step3">
                <div class="step-counter-inactive">3</div>
            </div>
        </div>


        <div id="all_slides">
            <div id="div_throw1" class="grid grid-cols-1 gap-4 md:grid-cols-1 mx-20 xl:grid-cols-2 lg:grid-cols-2 pb-4 d-grid">
                <p class="test_text">Take a wet soil sample and squiz it into a ball. </p>
                <img class="rounded border border-green-600  w-24 h-24" src="{{ asset('images/throw-ball-test-steps/image 1.svg') }}" alt="Wet sample soil illustration" title="Wet sample soil illustration">
            </div>

            <div id="div_throw2" class="grid grid-cols-1 gap-4 md:grid-cols-1 mx-20 xl:grid-cols-2 lg:grid-cols-2 pb-4 d-none">
                <p class="test_text">Throw the ball into the air, about 50cm and then catch it</p>
                <img class="rounded border border-green-600  w-24 h-24 pb-2 pt-2"  src="{{ asset('images/throw-ball-test-steps/image 2.svg') }}" alt="Throw the ball 50cm" title="Throw the ball 50cm">
            </div>

            <div id="div_throw3" class="d-none">
                @include('livewire.lw-throw-ball-questions')
            </div>

        </div>



        <div class="bg-sky-100 row mt-5">

            <button id="btn_test_next" class="btn_test_active " style="float: right;">Next</button>
            <button id="btn_test_back" class="btn_test_inactive" style="float: left;">Back</button>
            <button id="btn_throw_after_box_click" class="btn_test_active d-none" style="float: right;">Next</button>

        </div>


    </div>




    <script>
        step = 1;


        $('#btn_test_next').off().on('click', function() {

            if (step == 1) {
                test_div_switch('div_throw2', 'div_throw1');
                move_slider('#tball_step2', 'step-counter-inactive', 'step-counter-active')
                move_slider('#tball_step1', 'step-bar-inactive', 'step-bar-active')
                $('#btn_test_back').removeClass('btn_test_inactive');
                $('#btn_test_back').addClass('btn_test_active');
                step = 2;
                return;
            }

            if (step == 2) {
                test_div_switch('div_throw3', 'div_throw2');
                move_slider('#tball_step2', 'step-bar-inactive', 'step-bar-active')
                move_slider('#tball_step3', 'step-counter-inactive', 'step-counter-active')
                $("#btn_test_next").prop("disabled", true).css("backgroundColor", "#e5e7eb");

                step = 3;
                return;
            }


            if (step == 3) {
                test_div_switch('div_throw1', 'div_throw3');
                div_toggle('div_throw_ball_questions', 'div_throw_ball_test');



                step = 1;
                return;
            }
        });



        $('#btn_test_back').off().on('click', function() {

            if (step == 3) {
                test_div_switch('div_throw2', 'div_throw3');
                $("#btn_test_next").prop("disabled", false).css("backgroundColor", "#fff");
                $("#btn_test_next").removeAttr("disabled");
                move_slider('#tball_step3', 'step-counter-active', 'step-counter-inactive')
                move_slider('#tball_step2', 'step-bar-active', 'step-bar-inactive')                
                step = 2;
                return;
            }

            if (step == 2) {
                test_div_switch('div_throw1', 'div_throw2');

                move_slider('#tball_step2', 'step-counter-active', 'step-counter-inactive')
                move_slider('#tball_step1', 'step-bar-active', 'step-bar-inactive')
                step = 1;
                return;
            }



        });



    </script>
</div>