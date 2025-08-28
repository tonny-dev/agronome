<div>

    <div class="row">


        <div class="col-md-5 input-group" style="padding-bottom:20px;">
            <!-- <div class="form-group row "> -->
            <label for="field" class="col-md-2 col-form-label text-md-right ">{{ __('Field') }}</label>
            <div class="col-sm-6">

                <select name="field" wire:model="field" id='field' class="form-control @error('field') is-invalid @enderror" name="field" required>
                    <option selected value=''>Choose a field</option>
                    @if($fields)
                    @foreach($fields as $field)
                    <option value="{{$field->id}}" type="hidden">{{$this->name_field($field)}} </option>
                    @endforeach
                    @endif
                    </option>
                </select>
                @error('field')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-5 input-group" style="padding-bottom:20px;">
            <!-- <div class="form-group row "> -->
            <label for="action" class="col-md-2 col-form-label text-md-right ">{{ __('Action') }}</label>
            <div class="col-sm-6">

                <select name="action" wire:model="action" id='action' class="form-control @error('action') is-invalid @enderror btn btn-secondary btn-block" name="action" required>
                    <option selected value=''>Choose an action</option>
                    @if($actions)
                    @foreach($actions as $action)
                    <option value="{{$action->id}}" type="hidden">{{$action->activity}} </option>
                    @endforeach
                    @endif
                    </option>
                </select>


                @error('action')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
    </div>

        <div class="col-md-2 input-group" style="padding-bottom:20px;">

         <button  wire:click="perform_action"  class="btn btn-success btn-block" id="monitor_actionx" style="margin-right:15px;">Perform action</button>
         
        </div>

        <!-- @if($success)
        <div class="bs-example" id="fill_profile_alert" style="display: block">
            <div class="alert alert-field alert-dismissible fade show">
                <p> {{$success}}</p>
                <hr>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        </div>
        @endif -->


        <table id="farm_list">
            <tr>
                <th style="display:none;">id</th>
                <th style="display:none;">planting</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Description</th>

            </tr>


            @if($activities)
            @foreach ($activities as $activity)
            <tr>
                <td style="display:none;">{{ $activity->id }}</td>
                <td style="display:none;">{{ $activity->crop_farm_id }}</td>

                <td>{{ $activity->activity }}</td>
                <td>{{$activity->completed_on ?  'completed '.  \Carbon\Carbon::parse($activity->completed_on)->toDateString() : 'pending' }}</td>

                <td>{{ $activity->blurb}}</td>
                <td> <button class="btn btn-success btn-sm" id="monitor_action" style="margin-right:15px;">Review action</button></td>
            </tr>
            @endforeach
            @endif

        </table>
    </div>


    <script>
        $(document).on('click', '#monitor_action', function() {
            var currentRow = $(this).closest("tr");
            var id = currentRow.find("td:eq(0)").text();

            //   Livewire.emit('crop_farm_selected', crop_farm_id);
            $('#md_monitor_action').modal('show');
        });
    </script>


</div>