<div>

    <div class="md:flex gap-4 lg:mt-0 mb-2 md:mt-0 mt-0 md:justify-between">

        <!--Farm Name-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select wire:model="testedFarm" name="testedFarm" id="testedFarm" class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                <option selected value=''>Choose a Farm</option>
                @foreach($usersTestedFarms as $farm)
                <option value="{{$farm->id}}" type="hidden">{{$farm->name}}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>


        <div class="grid grid-cols-2 gap-4 md:hidden">
            <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
                <select wire:model="fieldselected" id="fieldselected" name="fieldselected" class="block appearance-none w-full bg-white border px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="0">Field</option>
                    @if ($testedFields !== 0)
                    @foreach ($testedFields as $fieldOption)
                    <option value="{{ $fieldOption->id }}">{{ $fieldOption->name }}</option>
                    @endforeach
                    @else
                    <option value="{{ $monoCropFarmSize }}">F-01-{{ $monoCropFarmSize}}</option>
                    @endif
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>

            </div>

            <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
                <input wire:model="allocation" value="" id="mobile_allocation" class="block appearance-none w-full bg-white text-gray-700 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" readonly>
                <div>
                    <span class="absolute appearance-none rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400">
                        <option value="">acres</option>
                    </span>
                </div>
            </div>

        </div>

    </div>




    <!--second row starts here -->


    <div class="md:flex md:justify-between lg:mt-6 mb-2 md:mt-6 xl:mt-6 mt-2 gap-4">


        <!--TEST TYPE-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <!-- Change this to be type select -->
            <p class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" id="mobile-physical" wire:ignore>
                Test Type
            </p>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="mgray h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill="white" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>


        <div class="grid grid-cols-2 gap-4 md:hidden">
            <div class="relative inline-block w-full mt-4">
                <select class="block truncate appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" id="test_results" wire:ignore>
                    <option selected value='666'>Results</option>
                    if $farmSoilTypeTests
                    @foreach($farmSoilTypeTests as $soilTipo)
                    <option value="{{ $soilTipo['id'] }}">{{ $soilTipo['value']}}</option>
                    @endforeach
                    endif
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>

            </div>



            <div class="relative inline-block w-full mt-4">
                <input wire:model="testdate" readonly class="shadow appearance-xl border text-small rounded-xl w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-10 md:d-none" id="test_date" placeholder="Date" wire:ignore>

                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>


            </div>
        </div>
    </div>


    <div class="bg-white shadow-xl border-green-200 h-96 border-l-1 border-b-4 border-r-1 rounded-lg overflow-y-scroll d-none" id="graphic_area">
        <!--Graphic area-->

        @foreach($farmSoilTests as $fmst)
        <div class="shadow-lg flex justify-between rounded border my-2 mx-4 border-l fmst-soil" wire:click="$emit('showTestSummary', {{ $fmst->test_id }})">
            <div class="border border-x-4 border-red-500 m-2"></div>
            <div>
                <div class="my-2 flex-1">
                    @php
                    $soilTypeTest = collect($farmSoilTypeTests)->firstWhere('id', $fmst->test_id);
                    @endphp
                    <p class="text-lg font-semibold underline" id="summary">{{ $soilTypeTest['value'] }} Test Summary</p>
                    <p class="text-normal font-light pt-4"><strong>Last done: </strong> {{ $fmst->test_date }}</p>
                </div>
            </div>
            <div class="ml-4 my-2 mx-4">
                <div class="flex-1 mb-2">
                    <span class="text-blue-500 text-xs" class="margin-right:1%">{{ $fmst->percent_completed }}%</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div>
        @if ($testSummary)
        <div class="bg-white shadow rounded-lg border border-b-2" id='test-summary'>
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
                <span class="font-thin"> {{ $farmName->name}} Farm . {{ $field_name }} . {{ $allocation }} acres</span>

                <span class="font-medium">Test Result :</span>
                <span id="test-purpose" class="font-thin">{{ $testSummary['results'] }}</span>
                <span class="font-medium">Recommendations</span>
                <span id="test-content" class="font-thin">{{ $testSummary['recommendations'] }}</span>
            </div>
            <div class="flex justify-between mx-4 mb-2 mt-4">
                <button></button>
                <button id="delete-record" wire:click="deleteRecord({{ $testSummary->id }})" class="bg-red-500 px-2 text-white rounded text-lg hover:bg-red-700">Delete</button>
            </div>
        </div>
        @endif
    </div>

</div>

<script>
    $("#fieldselected, #mobile_allocation, #test_date, #mobile-physical, #test_results")
        .prop("disabled", true)
        .css("backgroundColor", "#e5e7eb");


    $('#testedFarm').change(function() {
        $('#mobile-physical').css({
            "background-color": "#2f8d4b",
            "color": "#f1f1f1"
        });
        $('#mobile-physical').text('Physical');
    })

    $('#fieldselected').change(function() {
        $('#graphic_area').attr("wire:ignore", "");
        $('#test_results, #test_date').removeAttr('wire:ignore')

        $('#graphic_area').removeClass('d-none');
        $('#graphic_area').addClass('d-block');

    })


    function showTestSummary() {
        $('#graphic_area').addClass('d-none');
        $('#test-summary').removeClass('d-none').addClass('d-block');
    }

    $(document).on('click', '.fmst-soil', function() {
        showTestSummary();
    });

    $('#test_results').on('change', function() {
        showTestSummary();

        const testId = $(this).val();
        Livewire.emit('showTestSummary', testId);
    });

    document.addEventListener('livewire:load', function() {
        Livewire.on('confirm', (recordId) => {
            swal("Are you sure you really want to delete this record??", {
                dangerMode: true,
                buttons: true,
            }).then((result) => {
                if (result) {
                    Livewire.emit('deleteConfirmed', recordId);
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