<div>

    <div class="mx-20 d-block">
        <p class="mt-0 mb-0 text-sm">What happens to the shape of the ball after squeezing?</p>
        <small class="mb-1 text-xs font-bold">(click the box with your observation)</small>
        <div wire:ignore id="div_squeeze_ball_q1" class="grid grid-cols-1 gap-4 md:grid-cols-1 xl:grid-cols-2 lg:grid-cols-2 pb-4">
            <figure id="btn_fell_true_squeeze" class="w-full rounded border border-green-600 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/squeezballtestimages/image 3.svg') }}" alt="The soil retains its shape" title="The soil retains its shape">
                <figcaption>The soil retains its shape.</figcaption>
            </figure>
            <figure id="btn_stuck_true_squeeze_ball" class="w-full rounded border border-green-600 p-4 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/squeezballtestimages/image 4.svg') }}" alt="soil does not retain its shape" title="soil does not retain its shape">
                <figcaption class="text-center">The soil does not retain its shape.</figcaption>
            </figure>
        </div>

    </div>
    <script>
        function blockilizeSqueezeTestButton() {
            $("#btn_squeeze_ball_test_next, #btn_squeeze_ball_test_back").addClass('d-none');
            $("#btn_squeeze_ball_after_box_click").removeClass('d-none');
            $("#btn_squeeze_ball_after_box_click").addClass('d-block');
        }
        let selectedSquuezeButton = null;

        function setSqueezeButtonBackgroundColor(btn) {
            $(btn).css('background-color', '#468d4a');
        }

        function resetSqueezeButtonBackgroundColor(btn) {
            $(btn).css('background-color', 'white');
        }

        function handleSquuzeButtonClick(btnId, clickCallback) {
            $(btnId).off().on('click', function() {
                if (selectedSquuezeButton !== this) {
                    if (selectedSquuezeButton) {
                        resetSqueezeButtonBackgroundColor(selectedSquuezeButton);
                    }
                    setSqueezeButtonBackgroundColor(this);
                    selectedSquuezeButton = this;
                    blockilizeSqueezeTestButton();
                }
                $('#btn_squeeze_ball_after_box_click').off().on('click', clickCallback);
            });
        }
        handleSquuzeButtonClick('#btn_stuck_true_squeeze_ball', function() {
            hide_div('div_squeeze_ball_questions');
            div_toggle('div_squeeze_ball_results', 'div_squeeze_ball_test');
            Livewire.emit('squeeze_ball_outcome_selected', true, $('#farm option:selected').text() + ',' + $('#field option:selected').text());
        })

        handleSquuzeButtonClick('#btn_fell_true_squeeze', function() {
            hide_div('div_squeeze_ball_questions');
            div_toggle('div_squeeze_ball_results', 'div_squeeze_ball_test');
            Livewire.emit('squeeze_ball_outcome_selected', false, $('#farm option:selected').text() + ',' + $('#field option:selected').text());
        })
    </script>





</div>