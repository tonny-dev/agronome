<div>

    <!-- TODO: Look for a better way to replace the buttons in lw-soilbutton-headers with this -->
    <div class="md:flex md:justify-between lg:mt-6 mb-2 md:mt-6 xl:mt-6 mt-2 gap-4 hidden" id="test_result_buttons">

        <!--TEST TYPE-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select class="block truncate appearance-none bg- w-full active border  px-4 py-2 pr-8 rounded-xl shadow leading-tight pointer-events-none">
                <option selected value="physical">Physical</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="mgray h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill="white" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>


        <!--SELECT TEST-->
        <div class="relative inline-block md:w-64">
            <select id="web_soil_test_types" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected value="">All Tests</option>
                @foreach($farmSoilTests as $ft)
                @php
                $soil_test_b = collect($farmSoilTypeTests)->firstWhere('id', $ft->test_id);
                @endphp
                <option value="{{ $ft->test_id }}" data-test-type-date='{{ $ft->test_date }}' type="hidden">{{ $soil_test_b['value'] ?? 'Soil' }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>

        <div class="relative inline-block md:w-64">
            <select id="web_soil_test_dates" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected value="">Filter by Date</option>
                @foreach($farmSoilTests as $ft)
                <option value="{{ $ft->test_date }}" type="hidden">{{ $ft->test_date }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>

        </div>
    </div>

    <div class="{{ $showWebSummary ? 'd-none' : 'd-block' }} bg-white shadow-xl border-green-200 h-96 border-l-1 border-b-4 border-r-1 rounded-lg overflow-y-scroll" id="web-graphic_area">
        <!--Graphic area-->
        @if(count($farmSoilTests) > 0)
        @foreach($farmSoilTests as $fmst)
        <div class="shadow-lg flex justify-between rounded border my-2 mx-4 border-l" data-tests-dates="{{ $fmst->test_date }}">
            <div class="flex justify-between">
                <div class="border border-x-4 border-red-500 m-2"></div>
                <div>
                    <div class="my-2 flex-1">
                        @php
                        $soilTypeTest = collect($farmSoilTypeTests)->firstWhere('id', $fmst->test_id);
                        @endphp
                        <p class="text-lg font-semibold underline" id="summary">{{ $soilTypeTest['value'] ?? 'Soil' }} Test Summary</p>
                        <p class="text-normal font-light pt-4"><strong>Last done: </strong> {{ $fmst->test_date }}</p>
                    </div>
                </div>
            </div>

            <div class="ml-4 my-2 mx-4">
                <div class="flex-1 mb-2">
                    <span class="text-blue-500 text-xs margin-right:10%">{{ $fmst->percent_completed }}%</span>
                </div>

                <div class="flex-1 mt-4">
                    <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold text-sm hover:text-white py-2
                                 px-4 border border-green-500 focus:outline-none hover:border-transparent rounded w-32 web-soil-result-more-button" data-test-date='{{ $fmst->test_date }}' data-test-id='{{ $fmst->test_id }}'>
                        More
                    </button>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="flex items-center p-4 mb-4 text-normal text-blue-800 rounded-lg bg-blue-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                This field does not have any tests done. Kindly switch to report to record a soil test.
            </div>
        </div>
        @endif
    </div>



    @if ($testSummary)
    <div class="{{ $showWebSummary ? 'd-block' : 'd-none' }} bg-white shadow rounded-lg border border-b-2" id='web-test-summary'>
        @php
        $farmName = collect($usersTestedFarms)->firstWhere('id', $testSummary['farm_id']);
        $testName = collect($farmSoilTypeTests)->firstWhere('id', $testSummary->test_id);
        @endphp
        <div class="grid grid-cols-2 gap-0 mx-4 mt-4">
            <span class="font-medium">Test Type </span>
            <span class="font-thin">Physical</span>
            <span class="font-medium">Test Name </span>

            <span class="font-thin" id="testname">{{ $testName['value'] }}</span>
            <span class="font-medium">Test Date </span>
            <span class="font-thin">{{ $testSummary['test_date'] }}</span>

            <span class="font-medium">Location</span>
            <span class="font-thin"> {{ $farmName->name}} Farm . {{ $web_field_name }} . {{ $web_allocation }} acres</span>

            <span class="font-medium">Test Result :</span>
            <span id="test-purpose" class="font-thin">{{ $testSummary['results'] }}</span>
            <span class="font-medium">Recommendations</span>
            <span id="test-content" class="font-thin">{{ $testSummary['recommendations'] }}</span>
        </div>
        <div class="flex justify-between mx-4 mb-2 mt-4">
            <button class="bg-transparent px-2 text-gray rounded text-lg hover:bg-gray-200 border border-green-500 focus:outline-none" id="back-to-report">Back</button>
            <button id="delete-record" wire:click="deleteWebSoilTest({{ $testSummary->id }})" class="bg-red-500 px-2 focus:outline-none text-white rounded text-lg hover:bg-red-700">Delete</button>
        </div>
    </div>
    @endif
</div>

<script>
    function add_wire_ignore(element) {
        return $(element).attr('wire:ignore', '');
    }
    $('#web_soil_test_types').on('change', function() {
        const selectedTestId = this.value;

        if (selectedTestId) {
            Livewire.emit('showWebSoilTestSummary', selectedTestId);
        }

        add_wire_ignore("#web_soil_test_types");
        add_wire_ignore("#web_soil_test_dates");

        // Disable and style the current select
        this.disabled = true;
        this.style.backgroundColor = '#e5e7eb';

        // Get the date from the selected option
        const selectedOption = $(this).find('option:selected');
        const testTypeDate = selectedOption.data('test-type-date');

        // Set the value and trigger change on #web_soil_test_dates
        if (testTypeDate) {
            const webSoilTestDates = $('#web_soil_test_dates');
            webSoilTestDates.val(testTypeDate).change();
        }

        $('#web_soil_result, #web_soil_test_dates, #web_soil_test_dates, #farm, #field, #allocation').prop("disabled", true).css("backgroundColor", "#e5e7eb");
    });


    $(document).on('click', '.web-soil-result-more-button', function(event) {
        event.preventDefault();

        $('#web_soil_result, #web_soil_test_dates, #farm, #field, #allocation').prop("disabled", true).css("backgroundColor", "#e5e7eb");
        add_wire_ignore("#web_soil_test_dates");

        $('#web_soil_test_types').val($(this).data('test-id')).change();
        $("#web_soil_test_dates").val($(this).data('test-date')).change();


        const testId = $(this).data('test-id');
        Livewire.emit('showWebSoilTestSummary', testId);

    });

    $(document).on('click', '#back-to-report', function(event) {
        event.preventDefault();

        $('#web_soil_test_types, #web_soil_test_dates').removeAttr('wire:ignore');
        $('#web_soil_result, #web_soil_result, #web_soil_test_dates, #farm, #field, #allocation').attr('disabled', false).css('backgroundColor', '#fff');

        Livewire.emit('showGraphicArea');
    });

    // Event handler for date filter dropdown change
    $('#web_soil_test_dates').on('change', function() {
        const selectedDate = this.value;

        if (!selectedDate) {
            $('#web-graphic_area .shadow-lg').show();
        } else {
            $('#web-graphic_area .shadow-lg').hide();

            $('#web-graphic_area .shadow-lg').filter(function() {
                const testDate = $(this).data('tests-dates');

                return testDate && testDate === selectedDate;
            }).show();
        }
    });


    document.addEventListener('livewire:load', function() {
        Livewire.on('confirm', (recordId) => {
            swal("Are you sure you really want to delete this record??", {
                dangerMode: true,
                buttons: true,
            }).then((result) => {
                if (result) {
                    Livewire.emit('webDeleteConfirmed', recordId);
                } else {
                    swal({
                        text: "Deletion cancelled.",
                        icon: "info",
                        button: 'OK'
                    });
                }
            })

        });

        Livewire.on('recordDeleted', (message) => {
            swal({
                text: message,
                icon: "success",
                button: {
                    text: "Ok",
                    className: "bg-green-500"
                }
            }).then(() => {
                location.reload(); // Refresh the page after the user clicks OK
            });
        });
    });
</script>