   <div class="padded-container"> </div>


    <section>

        <div class="row">

            <!-- ============
                                LEFT PANEL
                                ============== -->

            <div class="col-md-2 " id="left_pane" style="padding-left: 1%;  background-color:#F3F2F1;height:1000px">
                <div class="list-group">


                    <a href="#" class="list-group-mine   bg-success btn-block list-group-item-action" id="li_farm"
                        env> <img src="{{ asset('svg/tractor.svg') }}" alt="" width="32" height="32"
                            title="Bootstrap">&nbsp;&nbsp;&nbsp;&nbsp;Farm</a>

                    <a href="#" class="list-group-mine list-group-item-action " id="li_crop"> <img
                            src="{{ asset('svg/leaf.svg') }}" alt="" width="32" height="32"
                            title="Bootstrap">&nbsp;&nbsp;&nbsp;&nbsp;Crop </a>

                    <a href="#" class="list-group-mine list-group-item-action" id="li_crop_farm"><img
                            src="{{ asset('svg/database.svg') }}" alt="" width="32" height="32"
                            title="Bootstrap">&nbsp;&nbsp;&nbsp;&nbsp;Soil</a>

                    <a href="#" class="list-group-mine list-group-item-action" id="li_monitoring"> <img
                            src="{{ asset('svg/cog.svg') }}" alt="" width="32" height="32"
                            title="Bootstrap">&nbsp;&nbsp;&nbsp;&nbsp;Activity Monitor</a>

                    <a href="#" class="list-group-mine list-group-item-action"><img src="{{ asset('svg/cloud.svg') }}"
                            alt="" width="32" height="32" title="Bootstrap">&nbsp;&nbsp;&nbsp;&nbsp;Weather</a>


                </div>
            </div>

            <!-- ============   CENTER PANEL      ============== -->


            <div class="col-md-8" id="app_content_panel">


                @if ($farms->first())
                <!-- LOAD CURRENT  FARM -->

                <div>
                    <div class="col-md-12 ">
                        <div id="center_map">
                            <div wire:ignore id="map_home" class="map_home_dims "> </div>
                        </div>
                    </div>

                    <div class="col-md-6 fixed-bottom " style="z-index: 1;">
                        <canvas id="myChart" width="200" height="200" style="margin:auto"></canvas>
                    </div>

                </div>


                @else
                <!--NO FIRM CREATED SO CALL CREATE FARM WIZARD-->
                <div style="display:block ;">
                    <div class="d-flex align-items-center justify-content-center flex-column " style="height: 350px">
                        <div class="p-2 bd-highlight col-example"><img src="{{ asset('images/sunlogo.jpg') }}"
                                width="120" height="100""></div>
                        <div class=" p-2 bd-highlight col-example"><a href="#" class="text-success"
                                id="anch_create_farm">Create a Farm </a></div>
                    </div>
                </div>
                @endif






            </div>



            <!-- ============
                                RIGHT PANEL 
                                ============== -->

            <div class="col-md-2 pl-0 pr-0 " id="right_pane" style="background-color:#F3F2F1;height:1000px ">

                @if (!$current_farm)
                <div class="card-header bg-warning" id="notifications">
                    Notifications
                </div>

                <div>
                    <div class="p-2 bd-highlight col-example"><a href="#" class="text-success"
                            id="not_item_profile">Complete your profile</a></div>
                </div>
                @endif


                @if ($current_farm)
                <div class="card-header bg-warning" id="notifications">
                    <h5> Farm Details <h5>
                </div>

                <div>

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header bg-light" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn " data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        LOCATION
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body ">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                         {{App\Models\Region::where('id', $current_farm->region_id)->first()->region}} Region
                                        </li>
                                        <li class="list-group-item"> {{App\Models\County::where('id', $current_farm->county_id)->first()->county}} County
                                        </li>
                                        <li class="list-group-item">{{App\Models\Subcounty::where('id', $current_farm->subcounty_id)->first()->subcounty}} Subcounty
                                        </li>
                                        <li class="list-group-item">{{App\Models\Ward::where('id', $current_farm->ward_id)->first()->ward}} Ward</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header  bg-light " id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn  collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        LAYOUT
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    List fields here
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header  bg-light" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn  collapsed" data-toggle="collapse" data-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        ADDITIONAL DETAILS
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                {{ $current_farm->notes}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @endif


            </div>

        </div>



        <div id="farm-details" class="col-md-8 d-none"> @livewire('lw-farm-details')</div>





    </section>


    <!--             
                        ====================================
                        ALL JAVASCRIPT HERE PLEASE 
                        ==================================== -->

    <script>


   


    function sleepFor(sleepDuration) {
        var now = new Date().getTime();
        while (new Date().getTime() < now + sleepDuration) {
            /* do nothing */ }
    }


    function draw_field_chart(id) {
        var allocation_array = [];
        $.ajax({
            type: 'GET',
            url: 'get_fields_from_farm',
            async: false,
            cache: false,
            timeout: 30000,
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            success: function(fields) {

                for (var i = 0; i < fields.length; i++) {
                    allocation_array.push(parseInt(fields[i].allocation));
                }


            },
            error: function() {
                console.log(reject);
            }
        });

        draw(allocation_array);

    }


    function draw(data_set)


    {

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                // labels: ['OK', 'WARNING', 'BANANA'],
                datasets: [{
                    label: '# of Tomatoes',
                    data: data_set,
                    backgroundColor: [
                        'blue',
                        'lightblue',
                        'dodgerblue',
                        'darkslateblue',
                        'aqua',
                        'darkslateblue',
                        'yellow'

                    ],
                    borderColor: [

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                cutoutPercentage: 40,
                responsive: false,
            }
            // alert('inside the wire');
        });


    }






    var elements = document.getElementsByClassName('dropdown-item');
    Array.from(elements).forEach((element) => {
        element.addEventListener('click', (event) => {
            var id = event.target.id;

            if (id == 'btn_add_farm_dd') {

                $('#app_content_panel').replaceWith($('#farm-details'));
                $('#farm-details').addClass("d-block");

                setTimeout(function() {

                    window.g_country_map.invalidateSize();

                }, 5);


                return;
            }

            $.ajax({
                type: 'POST',
                url: 'get_farm_by_id',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(farm_data) {

                    $("#farmDropdownMenuButton").text(farm_data.name.toUpperCase() +
                        '  FARM');
                    draw_feature_map(farm_data.lat, farm_data.long, farm_data.geo_json);
                    draw_field_chart(id);
                },
                error: function() {
                    console.log(reject);
                }
            });

        });
    });







    @if($current_farm)
    var lat = {!!$current_farm->lat!!};
    var long = {!!$current_farm->long!!};
    var farm_id = {!!$current_farm->id!!};


    var geojson = {!!$current_farm->geo_json!!};
    sleepFor(1000);
   
   
    draw_field_chart(farm_id);
    draw_feature_map(lat, long, geojson);
    @endif


    function draw_feature_map(lat, long, geojson) {


        if (L.DomUtil.get('map_home') !== undefined) {
            L.DomUtil.get('map_home')._leaflet_id = null;
        }


        var mymap = L.map('map_home').setView([lat, long], 12.3);
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
        //Initialise the FeatureGroup to store editable layers
        var drawnItems = new L.FeatureGroup();
        mymap.addLayer(drawnItems);

        console.log(geojson);
     
       L.geoJSON(JSON.parse(geojson)).addTo(mymap);

      
      // mymap.dragging.enable();
    }







    $(document).on('click', '#btn_add_farm_top', function() {
        $('#app_content_panel').replaceWith($('#farm-details'));
        $('#farm-details').addClass("d-block");
        g_country_map.invalidateSize();

    });


    $(document).on('click', '#anch_create_farm', function() {
        $('#app_content_panel').replaceWith($('#farm-details'));
        $('#farm-details').addClass("d-block");
        g_country_map.invalidateSize();

    });


    $(document).on('click', '#not_item_profile', function() {
        $('#complete_profile').modal('show');
    });


    $(document).on('click', '#btn_edit_cf', function() {
        alert('form now editable');
    });
    </script>



    <script>
    function alert_complete_profile() {
        window.onload = function() {

            swal({
                title: "Profile Incomplete",
                text: "Please complete your profile to enjoy our services",
                icon: "warning",

            });

            $('#complete_profile').modal();
        }
    }
    </script>

    @push('scripts')

    <script>
    Livewire.on('cf_redirect', () => {

        swal({
            title: "success !",
            icon: "success",

        });
        $('#md_crop_farm').modal('hide');
        $('#app_content_panel').load("/crop_farm_list");
    });
    </script>
    @endpush



    <script>
    function load_to_section() {
        window.onload = function() {

            swal({
                title: "Profile Incomplete",
                text: "Please comnplete your profile to enjoy our services",
                icon: "warning",

            });

            $('#app_content_panel').load("/crop_farm_details");



        }
    }
    </script>

    <script>
    $(document).on('click', '#li_farm', function() {
        //  $('#app_content_panel').load("/farm");
    });


    $(document).on('click', '#li_crop', function() {
        //   $('#app_content_panel').load("/crop");
    });


    $(document).on('click', '#li_monitoring', function() {
        //   $('#app_content_panel').load("/monitoring");
        //   $('#md_monitoring').modal('show');
    });


    $(document).on('click', '#li_gistest', function() {
        //   $('#app_content_panel').load("/monitoring");
        //     $('#md_gis').modal('show');
    });
    </script>


    <script>
    $(document).on('click', '#li_crop_farm', function() {
        $('#app_content_panel').load("/crop_farm_list");
    });
    </script>



    <script>
    $(document).on('click', '#btn_plant_crop', function() {
        //      $('#app_content_panel').load("/crop_farm_details");
    });
    </script>


    <script>
    function save_farm() {
        location.reload(true);
    }
    </script>









    @php
    {{ if ((Auth::user()->visit_no >= 2) && (!Auth::user()->profile_completed_at))
                 { echo '<script type="text/javascript">alert_complete_profile();</script>';}}}
    @endphp



    @include('layouts.modals')
    @include('layouts.scripts')






    @livewireScripts