<div class="px-6 mt-6">
    <h3 class="text-green-500 uppercase font-semibold md:text-md sm:text-sm">More Information</h3>


    <div class="mt-8" id="report-record-button">
        <div class="relative">
            <select id='web_soil_result' class="block appearance-none w-full bg-gray-200 border px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" disabled>
                <option value="report">Report</option>
                <option value="result">Results</option>
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-0 border-l border-gray-400 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </span>

        </div>
    </div>


    <script>
        $('#web_soil_result').change(function() {
            var selectedValue = $(this).val();
            let farm_id = $('#farm option:selected').val();

            if (selectedValue === "result") {
                Livewire.emit('listen_to_farm_id', farm_id);

                $('#div_physical_tests').hide();
                $('#div_web_soil_test_results').show();

                $('#test_report_buttons').hide()


            } else if (selectedValue === "report") {
                $('#div_web_soil_test_results').hide();
                $('#soil_test_report, #div_physical_tests').show();

                $('#test_report_buttons').show()

            }
        });
    </script>

</div>