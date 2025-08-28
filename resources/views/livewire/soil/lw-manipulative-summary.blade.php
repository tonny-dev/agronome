<div>
    <div class="bg-white shadow rounded-lg border border-b-2">
        <div class="grid grid-cols-2 gap-0 mx-2 mt-2">

            <span class="font-medium">Test Type:</span>
            <span class="font-thin">Physical</span>


            <span class="font-medium">Test Name:</span>
            <span class="font-thin">Dry Crushing Test</span>



            <span class="font-medium">Test Date:</span>
            <span id="man_span_date" class="font-thin"></span>

            <span class="font-medium">Location</span>
            <span class="font-thin" id="man_span_location"> </span>

            <span class="font-medium">Test Purpose :</span>
            <span id="" class="font-thin">Quick test to define the possible textural class of soil</span>

            <span class="font-medium"> Requirements :</span>
            <span id="" class="font-thin">A handful of soil as a sample</span>
            <br><br>


        </div>
        <div class="flex justify-between mx-4 mb-2">
            <button id="btn_manipulative_back" class="border border-green-500 pl-2 pr-2 rounded">Back</button>
            <button id="btn_man_throw_proceed" class="btn_proceed_summary">Start</button>
        </div>
    </div>


    <script>
        $('#btn_man_throw_proceed').on('click', function() {
            $("#testTipo").css({
                "color": "#374151",
            });

            $("#webSoilTest, #mobile_soil_test").attr("disabled", true).css({
                "background-color": "green",
                "color": "white"
            });

            $("#farm, #mobile_field, #mobile_allocation, #field, #field2, #allocation, #testTipo, #test_date, #mobile_test_date").attr("disabled", true).css("backgroundColor", "#e5e7eb");
            if ($("#webSoilTest").val() == '' || $("#farm").val() == '' || $('#test_date').val() == '' || $("#testTipo").val() == '')

            {

                swal({
                    title: "Missing Farm Details",
                    text: "Please select farm , field and date",
                    icon: "warning"
                });

                return;

            }
            div_toggle("mobile_test_date", "test_date2");

            div_toggle('div_manipulative_test', 'div_manipulative_summary');

        });

        $('#btn_manipulative_back').on('click', function() {
            div_toggle('div_physical_tests', 'div_manipulative_summary');
            $("#web_soil_result").prop("disabled", false).css("backgroundColor", "#fff");
        })
    </script>


</div>