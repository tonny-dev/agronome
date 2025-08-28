<main class="w-full bg-white mx-4">
    <div class="px-6 pt-6 pb-2">
        <h1 class="font-semibold text-lg">Farm Information</h1>
    </div>
    <hr>
    <!-- success message -->
    @if($success)
    <div class="mx-6 mine mt-2 mb-2 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        <p class="font-medium p-2"> {{ $success }}</p>
    </div>
    @endif
    @if(count($farms) > 0)
    <p class="font-light text-sm pt-2 mx-6 pb-2">* Select a specific farm from the dropdown below to view its details</p>

    <div class="pt-2 mx-6">
        <select onchange="displayDetails(this.value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-medium outline-none rounded-lg  block md:w-64 lg:w-72 w-full p-2.5">
            <option value="">select a farm</option>
            @foreach ($farms as $farm)
            <option value="{{$farm}}">{{$farm->name}}</option>
            @endforeach
        </select>
    </div>
    @else
    <div class="shadow shadow-lg p-4">
        <p>No farms present, click below button to add a farm.</p>
        <a href="{{route('farmer.farmer_dashboard') }}">
            <button class="active p-2 rounded hover:bg-green-400 hover:font-bold">Add Farm</button>
        </a>
    </div>
    @endif
    <div class="show_farm_selected"></div>


    <script>
        // This function grabs the value of the selected farm, parse it into object since it is
        // type of string during onchange
        // displays the data on the details div.
        // Problem, I can't guess the worse scenario of it.
        // Ask Brian for a better php way.


        function displayDetails(id) {
            let farms_object = JSON.parse(id);
            fetch(`getfarmcountyonselect/${farms_object.id}`)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    let fields ;
                    let farming_type = "";
                    let farm_field_name = "";

                    if (farms_object.farming_type_id === 1009) {
                        farming_type = 'mono-crop';
                        farm_field_name = "Farm Field";
                        fields = [farms_object.farm_size];
                    }
                    if (farms_object.farming_type_id === 1010) {
                        farming_type = 'mixed-crop';
                        farm_field_name = "Farm Fields";
                        fields = data[3];
                    }
                    $(".show_farm_selected").html(
                        `<div class="px-6 mt-6">
                                    <div class="grid md:grid-cols-2 md:gap-x-14 lg:gap-x-14 xl:gap-x-11 gap-4 grid-cols-1 lg:grid-cols-2 xl:grid-cols-2">
                                        <div>
                                            <h2 class="subpixel-antialiased">Farm Name</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${farms_object.name}</p>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h2 class="subpixel-antialiased">County</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${data[0]}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h2 class="subpixel-antialiased">Constituency</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${data[1]}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h2 class="subpixel-antialiased">Ward</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${data[2]}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h2 class="subpixel-antialiased">Farm Size</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${farms_object.farm_size} acres</p>
                                            </div>
                                        </div>
                                        
                                        
                                        <div>
                                            <h2 class="subpixel-antialiased">Longitude</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${farms_object.long}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h2 class="subpixel-antialiased">Latitude</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${farms_object.lat}</p>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h2 class="subpixel-antialiased">Farm Ownership</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">ownership</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h2 class="subpixel-antialiased">Farming Type</h2>
                                            <div class="relative">
                                            <p class="bg-white border p-4 pl-4 border-gray-300 text-gray-900 sm:text-sm outline-none block w-full p-2.5">${farming_type}</p>
                                            </div>
                                        </div>

                                        <div class="w-1/2">
                                        <h2 class="subpixel-antialiased">${farm_field_name}</h2>
                                            <canvas id="farmChart" width="200" height="200" style="margin-left: 20%; z-index:1;"></canvas>
                                        </div>
                                    </div>
                        </div>`);

                    const ctx = document.getElementById('farmChart');
                    myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            // labels: data_set,
                            datasets: [{
                                label: 'Field',
                                data: fields,
                                hoverOffset: 8,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            cutoutPercentage: 40,
                            responsive: true,
                        }
                        // alert('inside the wire');
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>
    @push('scripts')
    <script>
        // confirm delete by emitting a livewire event and then listening to it from  js
        Livewire.on('confirm_delete', farm_id => {
            swal({
                title: 'Are You Sure?',
                text: 'This farm will be deleted!',
                icon: "warning",
                showCancelButton: true,
                buttons: ["No", true],
            }).then((value) => {
                console.log(value + 'this');
                if (value) {
                    // @this.call('delete', farm_id);
                }
            });
        });
    </script>


    <script>
        $(document).on('click', '#add_farm', function() {

            Livewire.emit('add_farm');
            $('#md_farm').modal('show');
        });
    </script>


    <script>
        $(document).on('click', '#edit_farm', function() {
            var currentRow = $(this).closest("tr");
            var farm_id = currentRow.find("td:eq(0)").text();

            Livewire.emit('farm_selected', farm_id);
            $('#md_farm').modal('show');
        });
    </script>
    @endpush

</main>