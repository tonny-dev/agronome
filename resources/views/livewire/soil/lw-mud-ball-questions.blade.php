<div>

    <div class="mx-20 d-block">

        <p class="mt-0 text-sm">When the ball is thrown against a hard surface, what shape does it take?</p>
        <small class="mb-1 text-xs font-bold">(click the box with your observation)</small>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-1 xl:grid-cols-5 lg:grid-cols-5 pb-4">
            <figure id="btn_retain_ball_shape_false" class="w-full rounded border border-green-600 p-2 hover:bg-green-600">
                <img src="{{ asset('images/mud-ball-test-images/image 3.svg') }}" alt="ball falls apart" title="ball fall apart?">
                <figcaption>Coarse texture?</figcaption>
            </figure>
            <figure id="btn_short_ribbon_no" class="w-full rounded border border-green-600 p-2 hover:bg-green-600">
                <img src="{{ asset('images/mud-ball-test-images/image 4.svg') }}" alt="ball sticks together" title="ball stick together?">
                <figcaption class="text-center">Moderately coarse texture?</figcaption>
            </figure>
            <figure id="btn_semi_circle_no" class="w-full rounded border border-green-600 p-2 hover:bg-green-600">
                <img src="{{ asset('images/mud-ball-test-images/image 5.svg') }}" alt="ball sticks together" title="ball stick together?">
                <figcaption class="text-center">Medium texture?</figcaption>
            </figure>
            <figure id="btn_cracks_yes" class="w-full rounded border border-green-600 p-2 hover:bg-green-600">
                <img src="{{ asset('images/mud-ball-test-images/image 6.svg') }}" alt="ball sticks together" title="ball stick together?">
                <figcaption class="text-center">Moderately fine texture?</figcaption>
            </figure>
            <figure id="btn_cracks_no" class="w-full rounded border border-green-600 p-2 hover:bg-green-600">
                <img src="{{ asset('images/mud-ball-test-images/image 7.svg') }}" alt="ball sticks together" title="ball stick together?">
                <figcaption class="text-center">Fine texture?</figcaption>
            </figure>
        </div>

    </div>

    <script>
        let selectedButton = null;

        function setButtonBackgroundColor(btn) {
            $(btn).css('background-color', '#468d4a');
        }

        function resetButtonBackgroundColor(btn) {
            $(btn).css('background-color', 'white');
        }

        function blockilizeMudTestToResultBtn() {
            $("#btn_mud_ball_test_next, #btn_mud_ball_test_back").addClass('d-none');
            $("#btn_mud_test_after_box_click").removeClass('d-none');
            $("#btn_mud_test_after_box_click").addClass('d-block');
        }

        // Function to handle button click
        function handleButtonClick(btnId, clickCallback) {
            $(btnId).off().on('click', function() {
                if (selectedButton !== this) {
                    if (selectedButton) {
                        resetButtonBackgroundColor(selectedButton);
                    }
                    setButtonBackgroundColor(this);
                    selectedButton = this;
                    blockilizeMudTestToResultBtn();
                }
                $('#btn_mud_test_after_box_click').off().on('click', clickCallback);
            });
        }

        // Attach click handlers for the buttons
        handleButtonClick('#btn_retain_ball_shape_false', function() {
            send_event('btn_retain_ball_shape_false');
        });

        handleButtonClick('#btn_short_ribbon_no', function() {
            send_event('btn_short_ribbon_no');
        });

        handleButtonClick('#btn_semi_circle_no', function() {
            send_event('btn_semi_circle_no');
        });

        handleButtonClick('#btn_cracks_no', function() {
            send_event('btn_semi_circle_no');
        });

        handleButtonClick('#btn_cracks_yes', function() {
            send_event('btn_semi_circle_no');
        });

        function send_event(btn_name) {

            // @listener in LWMudBallResults
            hide_div('div_mud_ball_test');
            div_toggle('div_mud_ball_results', 'div_mud_ball_questions');
            Livewire.emit('mud_ball_outcome_selected', btn_name, $('#farm option:selected')
                .text() + ',' + $('#field option:selected').text());

        }
    </script>

</div>