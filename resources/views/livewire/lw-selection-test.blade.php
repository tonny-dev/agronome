<div>


    <div class="cole ml-0" id="map_column">
        <div class="mb-2 font-weight-bold"> Place a pin on your farm location </div>
        <div id="pin_div">
            <div wire:ignore id="mapid" class="map_dims"> </div>
        </div>
    </div>


    <p>
    <p>




        Longitude
    <p>
    <p>


    <div class="form-group col-auto ">
        <input wire:model="long" id="long" type="text" placeholder="" name="long" style="height:40px">
        @error('altitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    Lattitude
    <p>
    <p>


    <div class="form-group col-auto ">
        <input wire:model="lat" id="lat" type="text" placeholder="" name="lat" style="height:40px">
        @error('altitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>



    Altitude
    <p>
    <p>


    <div class="form-group col-auto ">
        <input wire:model="altitude" id="altitude" type="text" placeholder=""
            class=" col-auto form-group form-control @error('altitude') is-invalid @enderror" name="altitude"
            style="height:40px">
        @error('altitude')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <p>
    <p>

        Crop
    <p>
    <p>






    <div class="form-group row ">
        <div class="col-md-8">
            <select name="crop" wire:model="crop" class="form-control @error('crop') is-invalid @enderror" required>
                <option value=''>Choose a crop</option>
                @if($crops)
                @foreach($crops as $crop)
                <option value="{{$crop->id}}" input>{{$crop->name}}</option>
                @endforeach
                @endif
                </option>
            </select>
            @error('crop')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group col-auto ">
            <button wire:click="compute_rank" id="btn_add_cmp" class=" form-group btn btn-primary " style="font-size:large;">Get Rank      </button>
    </div>


   
    @if(count($varieties_r1)>0)
    <div class="form-group col-auto ">
        <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 1   </button>
    </div>

        @foreach ($varieties_r1 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif


    @if(count($varieties_r2)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 2  </button>
        </div>

    @foreach ($varieties_r2 as $variety)
    <li>{{ $variety->name }}</li>
    @endforeach
    @endif


    @if(count($varieties_r3)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 3 </button>
        </div>

        @foreach ($varieties_r3 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif

    @if(count($varieties_r4)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 4 </button>
        </div>

        @foreach ($varieties_r4 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif


    
    @if(count($varieties_r5)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 5 </button>
        </div>

        @foreach ($varieties_r5 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif


    
    @if(count($varieties_r6)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 6 </button>
        </div>

        @foreach ($varieties_r6 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif


    @if(count($varieties_r7)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 7 </button>
        </div>

        @foreach ($varieties_r7 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif


    
    @if(count($varieties_r8)>0)
        <div class="form-group col-auto ">
            <button id="btn_add_field" class=" form-group btn btn-block btn-success " style="font-size:large;">Rank 8 </button>
        </div>

        @foreach ($varieties_r8 as $variety)
        <li>{{ $variety->name }}</li>
        @endforeach
    @endif

</div>


<p>







    <script>
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


                Livewire.emit('xy_chosen', window.lat, window.lng);

            }

            if (e.layerType === 'rectangle') {

                rectangle_drawn = true;
            }

            window.farm_geojson = drawnItems.toGeoJSON();
            // window.lat =  layer._latlng.lat;
            //  window.lng =  layer._latlng.lng;



        });

    }
    </script>


    </div>