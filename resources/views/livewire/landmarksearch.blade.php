<div>

    <div class="mx-8 grid-cols-1 grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4">
        <div class="relative lg:w-64 xl:w-64 md:w-64 w-auto">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <select name="school" wire:model="school" id="schools" class="block appearance-none w-full bg-white border pl-10 p-2 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" name="school">
                <option selected value=''>School</option>
                @foreach($schools as $school)
                <option value="{{$school->id}}" type="hidden">{{$school->landmark}}</option>
                @endforeach
                </option>
            </select>
            @error('school')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="relative lg:w-64 xl:w-64 md:w-64 w-auto">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <select name="market" wire:model="market" id="markets" class="block appearance-none w-full bg-white border p-2  pl-10 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" name="market">
                <option selected value=''>market</option>
                @foreach($markets as $market)
                <option value="{{$market->id}}" type="hidden">{{$market->landmark}}</option>
                @endforeach
                </option>
            </select>
            @error('market')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



    </div>
    <script>
        $('#schools,#markets').off().on('change', function() {
            var id = this.value;


            $.ajax({
                type: 'GET',
                url: 'get_landmark_coords',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(data) {

                    $(".leaflet-marker-icon").remove();
                    $(".leaflet-popup").remove();

                    g_country_map.setView([data.lat, data.long], 12.3);


                    L.marker([data.lat, data.long]).addTo(g_country_map)
                        .bindPopup(data.landmark)
                        .openPopup();


                },
                error: function() {
                    console.log(reject);
                }
            });

        });
    </script>

</div>