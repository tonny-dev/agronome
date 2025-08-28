<div>

    <!-- 

    <div class="w-full underline grid mb-20 flex justify-center" style="margin:auto">

        <div class="mb-5 mt-5 font-bold"> Ball and Ribbon Soil Test Results</div>

    </div> -->

    <div class="bg-white shadow rounded-lg border border-b-2 w-auto lg:w-4/5 m-auto">
        <h2 class="text-center underline">Ball and Ribbon Soil Test Results</h2>


        <div class="grid grid-cols-2 gap-0 ml-8 mt-4">

            <span class="font-medium">Test Type:</span>
            <span class="font-thin">Physical</span>


            <span class="font-medium">Test Name:</span>
            <span class="font-thin"> Mud Ball Test</span>

            <span class="font-medium">Location</span>
            <span class="font-thin" id="mud_ball_span_location">{{$field_details}}</span>

            <span class="font-medium">Test Date:</span>
            <span id="mud_ball_span_date" class="font-thin">{{$test_date}}</span>

            <span class="font-medium">Test Purpose :</span>
            <span id="" class="font-thin">Test purpose Here</span>

            <span class="font-medium"> Results :</span>
            <span wire:model="results" id="" class="font-thin">{{ $results }}</span>

            <span class="font-medium"> Recommendations :</span>
            <span wire:model="results" id="" class="font-thin">{{ $recommendations }}</span>

            <br><br>


        </div>
        <div class="flex justify-between mx-4 mb-2">
            <button id="btn_mud_delete" class="border border-red-500 pl-2 pr-2 rounded text-red-500">Delete</button>
            <button wire:ignore id="btn_finish_mud_ball" class="border border-green-500 pl-2 pr-2 rounded text-green-500">Confirm</button>
        </div>
    </div>


    <script>
        $('#btn_finish_mud_ball').off().on('click', function() {

            Livewire.emit(
                'mud_ball_test_completed',
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

            hide_div('div_mud_ball_questions');
            div_toggle('div_physical_tests', 'div_mud_ball_results');

        });

        $('#btn_mud_delete').off().on('click', function() {
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