

<div>


@if($success)
    <div class="bs-example" id="fill_profile_alert" style="display: block">
        <div class="alert alert-success alert-dismissible fade show">
            <p> {{$success}}</p>
            <hr>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    </div>
    @endif

    <table id="farm_list">
        <tr>
            <th style="display:none;">id</th>
            <th>Farm</th>
            <th>Crop</th>
            <th>Variety</th>
            <th>Crop Age</th> 
            <th>Date Planted</th>
            <th>Allocation(Acres)</th>
            <th>Projected Yield</th>
            <th>Projected Harvest</th>
            @if (!$farm_id)
            <th>Actions</th>
            @endif
        </tr>

        @foreach ($plantings as $crops_farms)
        <td style="display:none;">{{ $crops_farms->id }}</td>
        <td>{{App\Models\Farm::where('id', $crops_farms->farm_id)->first()->name}}</td>
        <td>{{App\Models\Crop::where('id', $crops_farms->crop_id)->first()->name}}</td>
        <td>{{App\Models\Variety::where('id', $crops_farms->variety_id)->first()->name}}</td>
        <td>{{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($crops_farms->planted_date)). ' days'  }}</td> 
        <td>{{$crops_farms->planted_date}}</td>
        <td>{{$crops_farms->allocation}}</td>
        <td>{{$crops_farms->projected_yield.' '.strtok($crops_farms->yield_units," ")}}</td>
        <td>{{$crops_farms->projected_harvest}}</td>
        @if (!$farm_id)
        <td>
            <button class="btn btn-success btn-sm" id="crop_farm_edit" style="margin-right:15px;">Edit</button>
            <button wire:click="$emit('delete_cf',{{ $crops_farms->id }})" id="crop_farm_delete" class="btn btn-danger btn-sm">Delete</button>
            @endif 
        </td>

        </tr>
        @endforeach
    </table>
    @if (!$farm_id)
    <button   id="btn_plant_crop" class="btn-success btn-lg" style="margin-top:1%">+Select another Crop</button>
     @endif
    <script>
        $(document).on('click', '#btn_plant_crop', function() {
            Livewire.emit('add_cf');
            $('#md_crop_farm').modal('show');
        });
    </script>


    <script>
        $(document).on('click', '#crop_farm_edit', function() {
            var currentRow = $(this).closest("tr");
            var crop_farm_id = currentRow.find("td:eq(0)").text();

            Livewire.emit('crop_farm_selected', crop_farm_id);
            $('#md_crop_farm').modal('show');
        });
    </script>

@push('scripts')

    <script>
        $(document).on('click', '#crop_farm_delete', function() {
            swal({
                title: 'Are You Sure?',
                text: 'This record  will be deleted!',
                icon: "warning",
                showCancelButton: true,
                buttons: ["No", true],
            }).then((value) => {
                console.log(value + 'this');
                if (value) {
                    var currentRow = $(this).closest("tr");
                    var id = currentRow.find("td:eq(0)").text();
                    @this.call('delete', id);
                }
            });
        });
    </script>

  
    <script>
        // confirm delete by emitting a livewire event and then listening to it from  js
        Livewire.on('delete_cf', id => {
          //  console.log(value + 'this');

            // swal({
            //     title: 'Are You Sure?',
            //     text: 'This farm will be deleted!',
            //     icon: "warning",
            //     showCancelButton: true,
            //     buttons: ["No", true],
            // }).then((value) => {
            //     console.log(value + 'this');
            //     if (value) {
            //         @this.call('delete', id);
            //     }
            // });
        });
    </script>
    @endpush
</div>