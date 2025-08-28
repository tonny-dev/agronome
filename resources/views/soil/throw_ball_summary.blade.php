<div class="bg-white shadow rounded-lg border border-b-2">
    <div class="grid grid-cols-2 gap-0 mx-2 mt-2">

        <span class="font-medium">Test Type:</span>
        <span class="font-thin">Physical</span>


        <span class="font-medium">Test Name:</span>
        <span class="font-thin">Throw Ball Test</span>

        <span class="font-medium">Test Date:</span>
        <span id="span_date" class="font-thin"></span>

        <span class="font-medium">Location</span>
        <span class="font-thin" id="span_location"> </span>

        <span class="font-medium">Test Purpose :</span>
        <span id="" class="font-thin">Quick test to check the possible presence of sand versus clay in a soil sample</span>

        <span class="font-medium"> Requirements :</span>
        <span id="" class="font-thin">A handful of soil as a samples</span>
        <br><br>


    </div>
    <div class="flex justify-between mx-4 mb-2">
        <button id="btn_throwball_back" class="border border-green-500 pl-2 pr-2 rounded">Back</button>
        <button id="btn_throw_proceed" class="btn_proceed_summary">Start</button>
    </div>
</div>



<script>
    $('#btn_throw_proceed').on('click', function() {
        $("#testTipo").css({
            "color": "#374151",
        });

        $("#webSoilTest, #mobile_soil_test").attr("disabled", true).css({
            "background-color": "green",
            "color": "white"
        });

        $("#farm, #mobile_field, #mobile_allocation, #field, #field2, #allocation, #testTipo, #test_date, #mobile_test_date").prop("disabled", true).css("backgroundColor", "#e5e7eb");

        div_toggle('div_throw_ball_test', 'div_throw_ball_summary');

    }); 

    $('#btn_throwball_back').on('click', function() {
        div_toggle('div_physical_tests', 'div_throw_ball_summary');
        $("#web_soil_result").prop("disabled", false).css("backgroundColor", "#fff");
    })
</script>