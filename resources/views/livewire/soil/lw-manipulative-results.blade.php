<div>


    <div class="bg-white shadow rounded-lg border border-b-2 w-auto lg:w-4/5 m-auto">

        <h2 class="text-center underline">Dry Crush Test Results</h2>
        <div class="grid grid-cols-2 gap-0 ml-8 mt-4">

            <p class="font-medium">Test Type:</p>
            <p class="font-thin">Physical</p>


            <p class="font-medium">Test Name:</p>
            <p class="font-thin">Dry Crush Test</p>

            <p class="font-medium">Location</p>
            <p class="font-thin" id="man_p_location">{{$field_details}}</p>

            <p class="font-medium">Test Date:</p>
            <p id="man_p_date" class="font-thin">{{$test_date}}</p>

            <p class="font-medium">Test Purpose :</p>
            <p id="" class="font-thin">Test purpose Here</p>

            <p class="font-medium"> Results :</p>
            <p wire:model="results" id="" class="font-thin">{{ $results }}</p>

            <p class="font-medium"> Recommendations :</p>
            <p wire:model="results" id="" class="font-thin">{{ $recommendations }}</p>

            <br><br>


        </div>
        <div class="flex justify-between mx-4 mb-2">
            <button id="btn_manu_delete" class="border border-red-500 pl-2 pr-2 rounded text-red-500">Delete</button>
            <button wire:ignore id="btn_finish_man" class="border border-green-500 pl-2 pr-2 rounded text-green-500">Confirm</button>
        </div>
    </div>


    <script>
        $('#btn_finish_man').off().on('click', function() {

            Livewire.emit(
                'manipulative_test_completed',
                $('#farm option:selected').val(),
                $('#field option:selected').val(),
                $('#test_date').val()
            );

            {
                swal({
                    title: "Success",
                    text: "Test Results Saved",
                    icon: "success"
                });

            }
            const ids = [
                "#field", "#farm", "#field2", "#allocation", "#testTipo",
                "#soilTest", "#test_date", "#web_soil_result"
            ];

            ids.forEach(id => {
                $(id).prop("disabled", false).css("backgroundColor", "#fff");
            });

            hide_div('div_manipulative_questions');
            div_toggle('div_physical_tests', 'div_manipulative_results');

        });

        $('#btn_manu_delete').off().on('click', function() {
            swal({
                    title: "Success",
                    text: "Record Deleted Successfully.",
                    icon: "success"
                }).then((result) => {
                    if (result) {
                        window.location.reload();
                    }
                });

        });
    </script>





</div>