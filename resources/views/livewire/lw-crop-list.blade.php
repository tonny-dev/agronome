<div>

    <div class="input-group col-sm-6 offset-sm-2">

        <input type="text" class="form-control" placeholder="Search for a crop or crop variety">
        <div class="input-group-append">
            <button class="btn btn-success" type="button">
                <img src="{{ asset('svg/search.svg') }}" alt="" width="22" height="20">
            </button>
        </div>
    </div>




  

    <table id="crop_list" class="table table-striped table-bordered" style="width:100% ;margin-top:15px;">
        <thead>
            <tr>
                <th>Crop</th>               
                <th>Yield</th>
                <th>Altitude (masl) </th>
                <th>Temperature °C </th>
                <th>ph</th>
                <th>Rainfall (mm/pa)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($crops as $crop)
            <tr>
            <td style="display:none;">{{ $crop->id }}</td>
            <td>{{ $crop->name }}</td> </a>           
            <td>{{ $crop->yield_min.' to '.$crop->yield_max.' '.$crop->yield_units }}</td>
            <td>{{ $crop->alt_min.' to '.$crop->alt_max }}</td>
            <td>{{ $crop->temp_min.' to '.$crop->temp_max }}</td>
            <td>{{ $crop->ph_min.' to '.$crop->ph_max }}</td>
            <td>{{ $crop->rain_min.' to '.$crop->rain_max }}</td>
            </tr>
            @endforeach
    </table>
    </tbody>
    </table>
</div>


<script>
    $(document).on('click', '#crop_list tr', function() {
        var currentRow = $(this).closest("tr");
        var crop_id = currentRow.find("td:eq(0)").text();
        Livewire.emit('crop_selected', crop_id);
        $('#md_crop_details').modal('show');
    });
    </script>