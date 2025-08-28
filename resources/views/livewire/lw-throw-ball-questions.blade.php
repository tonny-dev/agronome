<div>

    <div class="mx-20 d-block">

        <p class="mt-0 mb-0 text-sm">Did the ball:</p>
        <small class="mb-1 text-xs font-bold">(click the box with your observation)</small>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-1 xl:grid-cols-2 lg:grid-cols-2 pb-4">
            <figure id="btn_stuck_false" class="w-full rounded border border-green-600 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/throw-ball-test-steps/image 3.svg') }}" alt="ball falls apart" title="ball fall apart?">
                <figcaption>Fall apart?</figcaption>
            </figure>
            <figure id="btn_stuck_true" class="w-full rounded border border-green-600 p-4 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/throw-ball-test-steps/image 4.svg') }}" alt="ball sticks together" title="ball stick together?">
                <figcaption class="text-center">Stick together?</figcaption>
            </figure>
        </div>

    </div>


    <script>
        let throwBallActiveBtn = null;

        function blockilizeNextButtonToResultsPage() {
            $("#btn_test_next, #btn_test_back").addClass('d-none');
            $("#btn_throw_after_box_click").removeClass('d-none');
            $("#btn_throw_after_box_click").addClass('d-block');
        }

        function setThrowButtonBackgroundColor(btn) {
            $(btn).css('background-color', '#468d4a');
        }

        function resetThrowButtonBackgroundColor(btn) {
            $(btn).css('background-color', 'white');
        }

        function handleThrowButtonClick(btnId, clickCallback) {
            $(btnId).off().on('click', function() {
                if (throwBallActiveBtn !== this) {
                    if (throwBallActiveBtn) {
                        resetThrowButtonBackgroundColor(throwBallActiveBtn);
                    }
                    setThrowButtonBackgroundColor(this);
                    throwBallActiveBtn = this;
                    blockilizeNextButtonToResultsPage();
                }
                $('#btn_throw_after_box_click').off().on('click', clickCallback);
            });
        }
        handleThrowButtonClick('#btn_stuck_true', function() {
            hide_div('div_throw_ball_questions');
            div_toggle('div_throw_ball_results', 'div_throw_ball_test');
            Livewire.emit('outcome_selected', true, $('#farm option:selected').text() + ',' + $('#field option:selected').text());

        });

        handleThrowButtonClick('#btn_stuck_false', function() {
            hide_div('div_throw_ball_questions');
            div_toggle('div_throw_ball_results', 'div_throw_ball_test');
            Livewire.emit('outcome_selected', true, $('#farm option:selected').text() + ',' + $('#field option:selected').text());
        });
    </script>
</div>