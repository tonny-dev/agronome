

<div>

  

<div id="ms" class=" w-100 h-75 " style="text-align: center; ">
        <ul id="progressbar">
            <li id='li1' class="active">Location</li>
            <li id='li2'>Social Profiles</li>
            <li id='li3'>Account Setup</li>
        </ul>
        <div class="card border border-success " id="step1">
          
                @csrf
                <div class="form-group col-md-4 ">
                    <select name="region" wire:model="region" class="form-control @error('region') is-invalid @enderror"
                        name="region" required>
                        <option value=''>Choose a region</option>
                        @foreach($regions as $region)
                        <option value="{{$region->id}}" input type="hidden">{{$region->region}}</option>
                        @endforeach
                        </option>
                    </select>
                    @error('region')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="bs-example  col-md-8 offset-md-2" style="display: block">
                    <div class="alert alert-success alert-dismissible fade show">
                        <p> {{ $success }}</p>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>


                <div class="form-group col-md-4 ">
                    <select name="county" wire:model="county" id='county'
                        class="form-control @error('county') is-invalid @enderror" name="county" required>
                        <option selected value=''>Choose a county</option>
                        @foreach($counties as $county)
                        <option value="{{$county->id}}" type="hidden">{{$county->county}}</option>
                        @endforeach
                        </option>
                    </select>
                    @error('county')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4 ">
                    <select name="subcounty" wire:model="subcounty" id="subcounty"
                        class="form-control @error('subcounty') is-invalid @enderror" name="subcounty" required>
                        <option selected value=''>Choose a subcounty</option>
                        @foreach($subcounties as $subcounty)
                        <option value="{{$subcounty->id}}" type="hidden">{{$subcounty->subcounty}}</option>
                        @endforeach
                        </option>
                    </select>
                    @error('subcounty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div>
                    <div> place a pin on your farm location </div>
                    <div wire:ignore id="mapid" style="width: 700px; height: 400px;margin-left:2% "></div>
                </div>
         
        </div>

        <div class="card  border border-success" id="step2" style="height:500px;">

            <div>

                <div class="form-group col-md-4 ">
                    <input wire:model="farm_name" id="farm_name" type="text" placeholder="My Farm" value="get from lw"
                        class="form-control .form-control-sm @error('farm_name') is-invalid @enderror input-sm"
                        name="farm_name" value="{{ old('farm_name') }}" required autocomplete="farm_name" autofocus>
                    @error('farm_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-4 ">
                    <input wire:model="farm_size" id="farm_size" type="number" placeholder="Estimated Size in Acres"
                        class="form-control  @error('farm_size') is-invalid @enderror" name="farm_size"
                        value="{{ old('farm_size') }}" required autocomplete="farm_size" autofocus>
                    @error('farm_size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div id="mapbounds"></div>
            <!--replica map goes here -->



        </div>



        <div class="card border border-success" id="step3" style="height:500px;">
            <div class="row">
                <div class="col-md-5">
                    &&&&&&&&& CARD 3 &&&&&&&&
                    Leverage agile frameworks to provide a robust synopsis for high level overviews.
                    Iterative approaches to corporate strategy foster collaborative thinking to further the overall
                    value proposition.
                    Organically grow the holistic world view of disruptive innovation via workplace diversity and
                    empowerment.location A
                </div>
                <div class="col-md-5">Leverage agile frameworks to provide a robust synopsis for
                    high level overviews. Iterative approaches to corporate strategy foster collaborative
                    thinking to further the overall value proposition. Organically grow the holistic world view of
                    disruptive innovation via workplace diversity and empowerment.
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <button class="btn btn-outline-success" id="msprev">previous</button>
            <button class="btn btn-lg btn-outline-success offset-md-8" id="msnext"> next</button>
        </div>
    </div>


     






    <script>
    var g_map = null;
    var g_jeojson = null;

    draw_map();


    function draw_map() {

        var mymap = L.map('mapid').setView([0.02, 37.9], 7.3);

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);


        // Initialise the FeatureGroup to store editable layers
        var drawnItems = new L.FeatureGroup();
        mymap.addLayer(drawnItems);

        // Initialise the draw control and pass it the FeatureGroup of editable layers
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems
            }
        });

        mymap.addControl(drawControl);
        g_map = mymap;

        window.w_map = mymap;

        //    localStorage.setItem("current_map", JSON.stringify(mymap));

        console.log(window.w_map);

        mymap.on(L.Draw.Event.CREATED, function(e) {
            var type = e.layerType
            var layer = e.layer;
            // Do whatever else you need to. (save to db, add to map etc)

            drawnItems.addLayer(layer);
            var data = drawnItems.toGeoJSON();
            window.al_Data = data;
            g_jeojson = data;

        });

        // setTimeout(function() {
        //     mymap.invalidateSize();
        //    }, 5);
    }


    function draw_map2(geojsonFeature) {


        var mymap2 = L.map('dbmap').setView([0.02, 37.9], );

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap2);


        L.geoJSON(geojsonFeature).addTo(mymap2);


    }

    function load_geojson() {

        var load =
            '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[36.744405,-1.398955],[36.744405,-1.397561],[36.745327,-1.397561],[36.745327,-1.398955],[36.744405,-1.398955]]]}}]}';

        console.log(JSON.parse(load));

        draw_map2(JSON.parse(load));

    }


    $('#md_gis').on('shown.bs.modal', function() {
        /*after modal is shown resize map to fit in div*/
        setTimeout(function() {
            g_map.invalidateSize();
        }, 1);
    });

    $(document).on('click', '#submit_gis', function() {
        console.log(window.al_Data);
        Livewire.emit('markerDrawn', JSON.stringify(window.al_Data));
    });

    $(document).on('click', '#load_map', function() {
        load_geojson();
    });


    $(document).on('click', '#anch_create_farm', function() {
        /*after modal is shown resize map to fit in div*/
        setTimeout(function() {
            window.w_map.invalidateSize();
        }, 1);
    });
    </script>
    <script>
    /** MULTTISTEP FORM CONTROLLER **/
    var current_card, next_card, previous_card;

    current_card = $('#step1');

    $(document).on('click', '#msprev', function() {

        $('msnext').show();
        current_card.hide();
        current_card = get_prev_card(current_card);
        current_card.show();
    });


    $(document).on('click', '#msnext', function() {

        $('msprev').show();
        current_card.hide();
        current_card = get_next_card(current_card);
        current_card.show();
    });


    function get_prev_card(current_card) {

        if (current_card.attr('id') == 'step3') {

            $("#li3").removeClass("active");
            return $('#step2');
        }

        if (current_card.attr('id') == 'step2') {

            $("#li2").removeClass("active");
            return $('#step1');
        }

        if (current_card.attr('id') == 'step1') {
            return $('#step1');
        }

    }


    function get_next_card(current_card) {

        if (current_card.attr('id') == 'step1') {
            $("#li2").addClass("active");
            $("#mapid").clone().appendTo("#mapbounds");

            return $('#step2');

        }

        if (current_card.attr('id') == 'step2') {

            $("#li3").addClass("active");
            return $('#step3');
        }

        if (current_card.attr('id') == 'step3') {

            return $('#step3');
        }

    }
    </script>



    <div>



===========================================================================

 <div id="ms" class="col-md-6  w-100 h-75 " style="text-align: center; display:none">
        <ul id="progressbar">
            <li id='li1' class="active">Location</li>
            <li id='li2'>Social Profiles</li>
            <li id='li3'>Account Setup</li>
        </ul>
        <div class="card border border-success " id="step1">
          
                @csrf
                <div class="form-group col-md-4 ">
                    <select name="region" wire:model="region" class="form-control @error('region') is-invalid @enderror"
                        name="region" required>
                        <option value=''>Choose a region</option>
                        @foreach($regions as $region)
                        <option value="{{$region->id}}" input type="hidden">{{$region->region}}</option>
                        @endforeach
                        </option>
                    </select>
                    @error('region')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="bs-example  col-md-8 offset-md-2" style="display: block">
                    <div class="alert alert-success alert-dismissible fade show">
                        <p> {{ $success }}</p>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>


                <div class="form-group col-md-4 ">
                    <select name="county" wire:model="county" id='county'
                        class="form-control @error('county') is-invalid @enderror" name="county" required>
                        <option selected value=''>Choose a county</option>
                        @foreach($counties as $county)
                        <option value="{{$county->id}}" type="hidden">{{$county->county}}</option>
                        @endforeach
                        </option>
                    </select>
                    @error('county')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4 ">
                    <select name="subcounty" wire:model="subcounty" id="subcounty"
                        class="form-control @error('subcounty') is-invalid @enderror" name="subcounty" required>
                        <option selected value=''>Choose a subcounty</option>
                        @foreach($subcounties as $subcounty)
                        <option value="{{$subcounty->id}}" type="hidden">{{$subcounty->subcounty}}</option>
                        @endforeach
                        </option>
                    </select>
                    @error('subcounty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div>
                    <div> place a pin on your farm location </div>
                    <div wire:ignore id="mapid" style="width: 700px; height: 400px;margin-left:2% "></div>
                </div>
         
        </div>

        <div class="card  border border-success" id="step2" style="height:500px;">

            <div>

                <div class="form-group col-md-4 ">
                    <input wire:model="farm_name" id="farm_name" type="text" placeholder="My Farm" value="get from lw"
                        class="form-control .form-control-sm @error('farm_name') is-invalid @enderror input-sm"
                        name="farm_name" value="{{ old('farm_name') }}" required autocomplete="farm_name" autofocus>
                    @error('farm_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-4 ">
                    <input wire:model="farm_size" id="farm_size" type="number" placeholder="Estimated Size in Acres"
                        class="form-control  @error('farm_size') is-invalid @enderror" name="farm_size"
                        value="{{ old('farm_size') }}" required autocomplete="farm_size" autofocus>
                    @error('farm_size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div id="mapbounds"></div>
            <!--replica map goes here -->



        </div>



        <div class="card border border-success" id="step3" style="height:500px;">
            <div class="row">
                <div class="col-md-5">
                    &&&&&&&&& CARD 3 &&&&&&&&
                    Leverage agile frameworks to provide a robust synopsis for high level overviews.
                    Iterative approaches to corporate strategy foster collaborative thinking to further the overall
                    value proposition.
                    Organically grow the holistic world view of disruptive innovation via workplace diversity and
                    empowerment.location A
                </div>
                <div class="col-md-5">Leverage agile frameworks to provide a robust synopsis for
                    high level overviews. Iterative approaches to corporate strategy foster collaborative
                    thinking to further the overall value proposition. Organically grow the holistic world view of
                    disruptive innovation via workplace diversity and empowerment.
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <button class="btn btn-outline-success" id="msprev">previous</button>
            <button class="btn btn-lg btn-outline-success offset-md-8" id="msnext"> next</button>
        </div>
    </div>






































=================================================================================================


@if($success)
	<div class="bs-example  col-md-8 offset-md-2" style="display: block">
		<div class="alert alert-success alert-dismissible fade show">
			<p> {{ $success }}</p>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	</div>
	@endif




-- lw maps original

<div>


	@if($success)
	<div class="bs-example  col-md-8 offset-md-2" style="display: block">
		<div class="alert alert-success alert-dismissible fade show">
			<p> {{ $success }}</p>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	</div>
	@endif

	<button type="submit" id="submit_gis" class="btn btn-primary"> Save </button>

	<button type="submit" id="load_map" class="btn btn-primary"> load map </button>

	<div wire:ignore id="mapid" style="width: 600px; height: 400px;"></div>
	<p>
	<div wire:ignore id="dbmap" style="width: 600px; height: 400px;"></div>


	<script>

		var g_map = null;
		var g_jeojson = null;

		draw_map();

		function draw_map() {


			var mymap = L.map('mapid').setView([0.02, 37.9], 6.3);

			L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				maxZoom: 18,
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1
			}).addTo(mymap);


			// Initialise the FeatureGroup to store editable layers
			var drawnItems = new L.FeatureGroup();
			mymap.addLayer(drawnItems);

			// Initialise the draw control and pass it the FeatureGroup of editable layers
			var drawControl = new L.Control.Draw({
				edit: {
					featureGroup: drawnItems
				}
			});

			mymap.addControl(drawControl);
			g_map = mymap;

			mymap.on(L.Draw.Event.CREATED, function(e) {
				var type = e.layerType
				var layer = e.layer;
				// Do whatever else you need to. (save to db, add to map etc)

				drawnItems.addLayer(layer);
				var data = drawnItems.toGeoJSON();
				window.al_Data = data;
				g_jeojson = data;

			});
		}


		function draw_map2(geojsonFeature) {


			var mymap2 = L.map('dbmap').setView([0.02, 37.9], );

			L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				maxZoom: 18,
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1
			}).addTo(mymap2);


			L.geoJSON(geojsonFeature).addTo(mymap2);

		
		}

		function load_geojson() {

			var load = '{"type":"FeatureCollection","features":[{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[36.744405,-1.398955],[36.744405,-1.397561],[36.745327,-1.397561],[36.745327,-1.398955],[36.744405,-1.398955]]]}}]}';

			console.log(JSON.parse(load));

			draw_map2(JSON.parse(load));

		}


		$('#md_gis').on('shown.bs.modal', function() {
			/*after modal is shown resize map to fit in div*/
			setTimeout(function() {
				g_map.invalidateSize();
			}, 1);
		});

		$(document).on('click', '#submit_gis', function() {
			console.log(window.al_Data);
			Livewire.emit('markerDrawn', JSON.stringify(window.al_Data));
		});

		$(document).on('click', '#load_map', function() {
			load_geojson();
		});
	</script>


</div>
