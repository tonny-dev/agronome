<div>

    <div class="mx-20 d-block">
        <p class="mt-0 mb-0 text-sm">Was there:</p>
        <small class="mb-1 text-xs font-bold">(click the box with your observation)</small>
        <div wire:ignore id="div_man_q1" class="grid grid-cols-1 gap-4 md:grid-cols-1 xl:grid-cols-3 lg:grid-cols-3 pb-4">

            <figure id="btn_low_res" class="w-full rounded border border-green-600 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/dry-crushing-test-svgs/image 3.svg') }}" alt="image of sample falling apart" title="Sample fell apart as dust">
                <figcaption class="text-xs">Little resistance and the soil sample fell apart as dust?</figcaption>
            </figure>

            <figure id="btn_med_res" class="w-full rounded border border-green-600 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/dry-crushing-test-svgs/image 4.svg') }}" height="150px" width="150px" alt="image of sample stuck together slightly" title="Sample stuck together slightly">
                <figcaption class="text-xs">Medium resistance and the soil sample stuck together slightly?</figcaption>
            </figure>

            <figure id="btn_high_res" class="w-full rounded border border-green-600 hover:bg-green-600">
                <img class="w-16 h-16" src="{{ asset('images/dry-crushing-test-svgs/image 5.svg') }}" alt="image of sample stuck together" title="Sample stuck together">
                <figcaption class="text-xs">Great resistance and the soil sample stuck together?</figcaption>
            </figure>

        </div>


    </div>


    <script>
        function blockilizeTestButton() {
            $("#btn_man_test_next, #btn_man_test_back").addClass('d-none');
            $("#btn_man_test_after_box_click").removeClass('d-none');
            $("#btn_man_test_after_box_click").addClass('d-block');
        }
        let selectedManipulativeButton = null;

        function setManipulativeButtonBackgroundColor(btn) {
            $(btn).css('background-color', '#468d4a');
        }

        function resetManipulativeButtonBackgroundColor(btn) {
            $(btn).css('background-color', 'white');
        }

        function handleManipulativeButtonClick(btnId, clickCallback) {
            $(btnId).off().on('click', function() {
                if (selectedManipulativeButton !== this) {
                    if (selectedManipulativeButton) {
                        resetManipulativeButtonBackgroundColor(selectedManipulativeButton);
                    }
                    setManipulativeButtonBackgroundColor(this);
                    selectedManipulativeButton = this;
                    blockilizeTestButton()
                }
                $('#btn_man_test_after_box_click').off().on('click', clickCallback);
            });
        }
        handleManipulativeButtonClick('#btn_high_res', function() {
            hide_div('div_manipulative_test');
            div_toggle('div_manipulative_results', 'div_man_questions');
            Livewire.emit('manipulative_outcome_selected', 'high', $('#farm option:selected').text() + ',' + $('#field option:selected').text());
        })

        handleManipulativeButtonClick('#btn_low_res', function() {
            hide_div('div_manipulative_test');
            div_toggle('div_manipulative_results', 'div_man_questions');
            Livewire.emit('manipulative_outcome_selected', 'low', $('#farm option:selected').text() + ',' + $(
                '#field option:selected').text());
        })

        handleManipulativeButtonClick('#btn_med_res', function() {
            hide_div('div_manipulative_test')
            div_toggle('div_manipulative_results', 'div_man_questions');
            Livewire.emit('manipulative_outcome_selected', 'med', $('#farm option:selected').text() + ',' + $(
                '#field option:selected').text());

        })
    </script>





</div>