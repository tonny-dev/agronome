<div id="addFarmDiv">

    <div class="md:flex gap-4 lg:mt-0 mb-2 md:mt-0 mt-0 md:justify-between hidden md:block">
        {{-- farm button --}}
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0" id="set_farm_name">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2 text-white">
                <i class="fa fa-plus"></i>
            </div>
            <button id="header_farm_button" class="block w-full cursor-not-allowed border py-2 active rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline" type="button">
                Farm
            </button>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-white focus:text-white">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>




        {{-- Field button --}}
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0" id="set_farm_field">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2 text-gray-700">
                <i class="fa fa-plus"></i>
            </div>
            <button id="header_field_button" class="w-full cursor-not-allowed text-green-700 bg-white border py-2 rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline" type="button" disabled>
                Field
            </button>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>

        {{-- crop button --}}
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2 text-gray-700">
                <i class="fa fa-plus"></i>
            </div>
            <button class="cursor-not-allowed w-full bg-white text-green-700 border py-2 rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline" type="button" disabled>
                Crop
            </button>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </div>

    <div id="step1">

        <!--Step ProgressBar-->
        <div class="md:mt-6 mt-0 mb-6 progress">
            <div class="md:pt-0 lg:pt-0">
                <div class="flex items-center">
                    <div class="flex items-center relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-7 w-7 py-3 border-2 nav_color">
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-6 w-32 text-normal font-medium active_nav_button">
                            Location
                        </div>
                    </div>
                    <div class="flex-auto border-t-2 border-gray-200"></div>
                    <div class="flex items-center active_nav_button relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-7 w-7 py-3 border-2 bg-transparent">
                        </div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-200"></div>
                    <div class="flex items-center active_nav_button relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-7 w-7 py-3 border-2 bg-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="md:px-0 md:mt-0">
            <div class="md:flex md:justify-between lg:mt-6 mb-2 md:mt-6 xl:mt-6 mt-2 gap-4">
                <!--County input-->
                <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
                    <select name="county" wire:model="county" id='county' class="block appearance-none w-full active border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:shadow-outline focus truncate">
                        <option selected value=''>Choose a county</option>
                        @foreach($counties as $county)
                        <option value="{{$county->id}}" type="hidden">{{$county->county}}</option>
                        @endforeach
                        </option>

                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 border-l border-white flex items-center px-2 text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>




                <!--Constituency input-->
                <div class="relative inline-block md:w-64 w-full hidden md:block">
                    <select name="constituency" wire:model="constituency" id="constituency" class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus truncate">
                        <option selected value=''>Choose a constituency</option>
                        @foreach($constituencies as $constituency)
                        <option value="{{$constituency->id}}" type="hidden">{{$constituency->constituency}}
                        </option>
                        @endforeach
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 border-l  flex items-center px-2 text-gray-700 focus:text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <!--Ward dropdown-->
                <div class="relative inline-block md:w-64 w-full hidden md:block">
                    <select name="ward" wire:model="ward" id="ward" class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus truncate">
                        <option selected value=''>Choose a Ward</option>
                        @foreach($wards as $ward)
                        <option value="{{$ward->id}}" type="hidden">{{$ward->ward}}</option>
                        @endforeach
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <!-- mobile View Constituency and ward drop-down -->
                <div class="md:hidden grid grid-cols-2 gap-4">
                    <div class="relative inline-block w-full mt-4">
                        <select name="constituency" wire:model="constituency" id="constituency" class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus truncate">
                            <option selected value=''>Constituency *</option>
                            @foreach($constituencies as $constituency)
                            <option value="{{$constituency->id}}" type="hidden">{{$constituency->constituency}}
                            </option>
                            @endforeach
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 border-l  flex items-center px-2 text-gray-700 focus:text-white">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative inline-block w-full mt-4">
                        <select name="ward" wire:model="ward" id="ward" class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus truncate">
                            <option selected value=''>Ward *</option>
                            @foreach($wards as $ward)
                            <option value="{{$ward->id}}" type="hidden">{{$ward->ward}}</option>
                            @endforeach
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!--Location Pin/Map-->
            <div class="md:mt-2 lg:mt-2 xl:mt-2 map__area">
                <h3 class="font-medium px-0">Select a
                    landmark near
                    your farm.(school or market)</h3>

                <div class="pt-2 md:pt-4 lg:pt-4 xl:pt-2">
                    <div class="relative flex justify-center">
                        <div class="w-full h-56 relative z-0" wire:ignore id="mapid"></div>
                        <div class="top-2 absolute z-40">
                            @livewire('landmarksearch')
                            <div></div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>
    <!--end step 1-->

    {{-- start of step 2--}}
    <div class="" id="step2">


        <!--Step ProgressBar-->
        <div class="p-5 progress">
            <div class="pt-5 md:pt-0 lg:pt-0">
                <div class="flex items-center">
                    <div class="flex items-center relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-7 w-7 py-3 border-2 nav_color">
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-6 w-32 text-normal font-medium active_nav_button">
                            Location
                        </div>
                    </div>
                    <div class="flex-auto border-t-2 border-green-500"></div>
                    <div class="flex items-center active_nav_button relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-7 w-7 py-3 border-2 nav_color">
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-6 w-32 text-normal font-medium active_nav_button">
                            Details
                        </div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-200"></div>
                    <div class="flex items-center active_nav_button relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-7 w-7 py-3 border-2 bg-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--Upper Second  Buttons-->
        <div class="md:px-0 md:mt-2">

            <div class="md:flex gap-4 lg:mt-0 mb-2 md:mt-0 mt-0 md:justify-between">

                {{-- Farm Name --}}
                <div class="md:w-64 w-full mt-4 md:mt-0 shadow shadow-lg">
                    <input wire:model.defer="farm_name" name="farm_name" class="block appearance-none rounded-xl w-full bg-white border px-4 py-2 pr-8  w-32 py-2 px-2 text-gray-700 leading-tight focus focus:outline outline-offset-2 outline-cyan-500 focus:shadow-outline" id="farm-name" type="text" placeholder="Farm Name">
                </div>

                {{-- Estimated Farm Size --}}
                <div class="relative inline-block md:w-64 hidden md:block"">
                    <input wire:model.defer="farm_size" id="farm_size" class="block  w-full bg-white text-gray-700 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline outline-offset-2 outline-cyan-500 focus focus:shadow-outline truncate" type="number" placeholder="Farm Size">
                    <p class="absolute rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-green-600">acres</p>
                </div>

                <!--Farm Ownership-->
                <div class="relative inline-block md:w-64 hidden md:block">
                    <select name="ownership_type" id="ownership_type" wire:model.defer="ownership_type" class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus truncate">
                        <option value=''>Ownership</option>
                        @foreach($ownership_types as $ownership_type)
                        <option value="{{$ownership_type->id}}" input type="hidden">{{$ownership_type->value}}
                        </option>
                        @endforeach
                        </option>

                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700 focus:text-white">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>


                <!-- Mobile view for step 2 -->
                <div class="md:hidden grid grid-cols-2 gap-4">
                    <div class="relative inline-block w-full mt-4 shadow-lg">
                        <input wire:model.defer="farm_size" id="farm_size_mobile" class="block w-full bg-white text-gray-700 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline outline-offset-2 outline-cyan-500 focus focus:shadow-outline truncate" type="number" placeholder="Farm Size">
                        <p class="absolute rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-green-600">acres</p>
                    </div>

                    <div class="relative inline-block w-full mt-4 shadow shadow-lg">
                        <select name="ownership_type" id="ownership_type_mobile" wire:model.defer="ownership_type" class="block appearance-none w-full bg-white border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus truncate">
                            <option value=''>Ownership</option>
                            @foreach($ownership_types as $ownership_type)
                            <option value="{{$ownership_type->id}}" input type="hidden">{{$ownership_type->value}}
                            </option>
                            @endforeach
                            </option>

                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700 focus:text-white">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>


            </div>

            <div class="mt-6">
                {{-- Farm history, to be hidden until farm ownership is selected --}}
                <div id="farm_history" style="display: none;">
                    @include('farm.farm_history')
                </div>
                {{-- map, to be hidden upon selection of farm ownership --}}

                <div id="bounds_div" style="display: block;" class="iframe">
                </div>
            </div>

        </div>





    </div>
    {{-- End of step 2 --}}


    {{-- start of step 3 --}}

    <div class="" id="step3">

        @livewire('lw-add-field')

    </div>
    {{-- End of step 3 --}}



    <!--Cancel and Next buttons-->
    <div class="flex justify-between mt-8 md:mt-4" id="testhide">
        <button class="bg-transparent transition duration-500 ease-in-out transform hover:scale-75 hover:bg-gray-100 border border-green-500 text-green-500 font-bold p-1 px-6 rounded" id="msprev">
            Cancel
        </button>
        <button class="bg-transparent hover:bg-gray-100 transition duration-500 ease-in-out transform hover:scale-75 border border-reen-500 text-green-500 font-bold p-1 px-6 rounded" id="msnext">
            Next
        </button>
    </div>


    <script>
        var ward_selected = false;

        //Check if farm ownership is selected and hide the map div.
        $('#ownership_type, #ownership_type_mobile').on('change', function() {
            $('#bounds_div').hide();
            $('#farm_history').show();
        })

        $('#constituency').off().on('change', function() {
            var id = this.value;
            ward_selected = true;

            $.ajax({
                type: 'GET',
                url: 'get_constituency_coords',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(data) {

                    g_country_map.setView([data.lat, data.long], 12.3);

                },
                error: function() {
                    // console.log(reject);
                }
            });


        });




        $('#ward').off().on('change', function() {
            var id = this.value;
            ward_selected = true;

            $.ajax({
                type: 'GET',
                url: 'get_ward_coords',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(data) {

                    g_country_map.setView([data.lat, data.long], 12.3);

                },
                error: function() {
                    // console.log(reject);
                }
            });

            //  $('#select_2 option:selected').html()

            $('#lbl_county').text('County  ' + $('#county option:selected').html());
            $('#lbl_subcounty').text('Subcounty  ' + $('#constituency option:selected').html());
            $('#lbl_ward').text('Ward  ' + $('#ward option:selected').html());

        });









        var g_country_map = null;
        var g_jeojson = null;
        var marker_drawn = false; /*toggle to true  to make optional*/
        var rectangle_drawn = false;


        draw_country_map();


        function draw_country_map() {

            if (L.DomUtil.get('mapid') !== undefined) {
                L.DomUtil.get('mapid')._leaflet_id = null;
            }

            var mymap = L.map('mapid').setView([0.02, 37.9], 6.3);
            mymap.dragging.enable();

            L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(mymap);



            var shpfile = new L.Shapefile('js/subcounties.zip', {
                onEachFeature: function(feature, layer) {
                    if (feature.properties) {
                        layer.bindPopup(Object.keys(feature.properties).map(function(k) {
                            return k + ": " + feature.properties[k];
                        }).join("<br />"), {
                            maxHeight: 200
                        });
                    }
                }
            });
            shpfile.addTo(mymap);
            shpfile.once("data:loaded", function() {
                // console.log("finished loaded shapefile");
            });




            // Initialise the FeatureGroup to store editable layers
            var drawnItems = new L.FeatureGroup();
            mymap.addLayer(drawnItems);

            // Initialise the draw control and pass it the FeatureGroup of editable layers
            var drawControl = new L.Control.Draw({

                draw: {
                    polygon: false,
                    circle: false,

                    polyline: false,
                    circlemarker: false
                },
                edit: {
                    featureGroup: drawnItems
                }
            });

            mymap.addControl(drawControl);

            g_country_map = mymap;




            mymap.on(L.Draw.Event.CREATED, function(e) {
                var type = e.layerType
                var layer = e.layer;


                drawnItems.addLayer(layer);
                //    var data = drawnItems.toGeoJSON();


                if (e.layerType === 'marker') {
                    window.lat = layer._latlng.lat;
                    window.lng = layer._latlng.lng;
                    marker_drawn = true;

                }

                if (e.layerType === 'rectangle') {

                    rectangle_drawn = true;
                }

                window.farm_geojson = drawnItems.toGeoJSON();
                // window.lat =  layer._latlng.lat;
                //  window.lng =  layer._latlng.lng;



            });

        }




        $('#md_gis').on('shown.bs.modal', function() {
            /*after modal is shown resize map to fit in div*/
            setTimeout(function() {
                g_map.invalidateSize();
            }, 1);
        });


        $(document).on('click', '#submit_gis', function() {
            // console.log(window.farm_geojson);
            Livewire.emit('markerDrawn', JSON.stringify(window.farm_geojson), window.lat, window.lng);
        });

        $(document).on('click', '#load_map', function() {
            load_geojson();
        });


        // $(document).on('click', '#anch_create_farm', function() {
        //     /*after modal is shown resize map to fit in div*/
        //    // g_map.invalidateSize();
        //     setTimeout(function() {
        //         g_country_map.invalidateSize();
        //     }, 1);
        // });

        /** MULTTISTEP FORM CONTROLLER **/
        var current_card, next_card, previous_card;

        current_card = $('#step1');
        counter = 0;



        $('#msnext').off().on('click', function() {


            //div_toggle(),

            // show location thingy
            // hide constituency thingy 
            // show side panel 

            $('msprev').show();
            current_card.hide();
            current_card = get_next_card(current_card);

            if (current_card == 'final_card') {
                $("#ms").hide();
                alert(current_card);
                return;
            }
            current_card.show();
        });


        $('#msprev').off().on('click', function() {
            $('msnext').show();
            current_card.hide();
            current_card = get_prev_card(current_card);
            current_card.show();
            $("#msnext").html("Next");
        });

        function get_next_card(current_card) {

            if (current_card.attr('id') == 'step1') {


                if (!$('#county').val()) {

                    swal({
                        title: "County Not selected",
                        text: "Please select county",
                        icon: "warning"
                    })

                    return $('#step1');


                } else if (!$('#constituency').val()) {
                    swal({
                        title: "Constituency not selected",
                        text: "Please select constituency",
                        icon: "warning"
                    })
                    return $('#step1');


                } else if (!$('#ward').val()) {
                    swal({
                        title: "Ward not selected",
                        text: "Please select ward",
                        icon: "warning"
                    })
                    return $('#step1');

                }


                $("#msprev").html("Back");


                div_toggle('div_legal', 'div_advanced_search');

                /*draw scope details*/
                $('#lbl_county').text('County  ' + $('#county option:selected').html());
                $('#lbl_subcounty').text('Subcounty  ' + $('#constituency option:selected').html());
                $('#lbl_ward').text('Ward  ' + $('#ward option:selected').html());



                $('#xlbl_county').text('County  ' + $('#county option:selected').html());
                $('#xlbl_subcounty').text('Subcounty  ' + $('#constituency option:selected').html());
                $('#xlbl_ward').text('Ward  ' + $('#ward option:selected').html());




                $("#li2").addClass("active");
                $("#mapid").detach().appendTo("#bounds_div");

                return $('#step2');
            }

            if (current_card.attr('id') == 'step2') {


                // if (!rectangle_drawn) {

                //     swal({
                //         title: "Boundary Needed",
                //         text: "Please use the rectangle to draw a boundary around your farm",
                //         icon: "warning"
                //     })

                //     return $('#step2');
                // }


                if (!$('#farm-name').val()) {

                    swal({
                        title: "Farm name not filled",
                        text: "Please make sure to fill farm name.",
                        icon: "warning"
                    })

                    return $('#step2');

                } else if (!parseInt($('#farm_size').val()) && !parseInt($('#farm_size_mobile').val())) {
                    swal({
                        title: "Farm size not filled",
                        text: "Please make sure to fill farm size",
                        icon: "warning"
                    })

                    return $('#step2');
                } else if (!$("#ownership_type").val() && !$("#ownership_type_mobile").val()) {
                    swal({
                        title: "Ownership  not filled",
                        text: "Please make sure to choose onwership type.",
                        icon: "warning"
                    })

                    return $('#step2');
                }

                $("#li3").addClass("active");
                $("#header_farm_button").removeClass("active").addClass("inactive");
                $("#header_field_button").addClass("active");

                //sets the name of the farm from farm input field
                $("#set_farm_name").html(`
        <p class="bg-white border px-4 py-2 border-green-500 text-green-700 sm:text-sm outline-none rounded">${$("#farm-name").val()}</p>
        `);

                $("#mobile-farm-name").text($("#farm-name").val());
                $("#mobile-name-view").html(`

            <p class="p-2" id="mobile-farm-name">${$("#farm-name").val()}</p>
            <p class="p-2" id="mobile-farm-name">${$("#farm_size_mobile").val()} acres</p>

        `)


                //sets the field with the value of the input field
                $("#set_farm_field").html(`
        <div class="relative md:w-64 w-full">
        <p class="bg-white border px-4 py-2 active border-green-500 text-green-700 sm:text-sm outline-none w-full rounded">${$("#farm_size").val()} acres</p>
        </div>
        `);

                // $("#mapid").detach().appendTo("#map_last_div");
                $('#cbx-farming-type option:selected').trigger('change');
                $("#msnext").html("Finish");
                return $('#step3');
            }

            if (current_card.attr('id') == 'step3') {

                $("#ms").hide();

                if ($('#cbx-farming-type option:selected').val() == 1009) {
                    Livewire.emit('farming_type_chosen', 1009);

                }

                if ($('#cbx-farming-type option:selected').val() == 1010) {

                    Livewire.emit('farming_type_chosen', 1010);


                }

                Livewire.emit('save_button_clicked', JSON.stringify(window.farm_geojson), window.lat, window.lng);

                $('#testhide').hide();
                $('#step1, #step2').hide();
                $('#addFarmDiv').hide();  

                window.location.href = "/add_farm_success"; /* remove redirect and simply toggle div if instantaneous load of success page is needed */

                return;

            }

        }

        document.addEventListener('livewire:load', function() {
            
            Livewire.on(('fields_created'), () => {

                window.location.href = "/add_farm_success";

            });

        });


        function get_prev_card(current_card) {

            if (current_card.attr('id') == 'step3') {

                $("#li3").removeClass("active");
                // $("#mapid").detach().appendTo("#bounds_div");
                return $('#step2');
            }

            if (current_card.attr('id') == 'step2') {

                $("#li2").removeClass("active");

                $("#mapid").detach().prependTo("#pin_div");

                return $('#step1');
            }

            if (current_card.attr('id') == 'step1') {
                return $('#step1');
            }

        }



        function sleepFor(sleepDuration) {
            var now = new Date().getTime();
            while (new Date().getTime() < now + sleepDuration) {
                /* do nothing */
            }
        }
    </script>




</div>