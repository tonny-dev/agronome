<div>

    <button class="btn btn-success btn-block ">Plant </button>

    <hr>




    @if($success)
    <div class="bs-example  col-md-8 offset-md-2" style="display: block">
        <div class="alert alert-success alert-dismissible fade show">
            <p> {{ $success }}</p>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    </div>
    @endif

    <form>

        @csrf
        <div class="form-group row ">
            <label for="crop" class="col-md-2 col-form-label text-md-right ">{{ __('Crop') }}</label>
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


        <div class="form-group row ">
            <label for="attribute" class="col-md-2 col-form-label text-md-right ">{{ __('Attribute') }}</label>
            <div class="col-md-8">

                <select name="attribute" id='attribute' wire:model="attribute" class="form-control @error('attribute') is-invalid @enderror" required>

                    <option value=''>Choose an attribute</option>
                    @if ($attributes)
                    @foreach($attributes as $attribute)
                    <option value="{{$attribute->id}}" input type="hidden">{{$attribute->attribute}}</option>
                    @endforeach
                    @endif
                    </option>
                </select>
                @error('attribute')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        @if($blurb)
        <div class="col-md-8 offset-md-2" style="display: block">
            <div class="alert alert-warning alert-dismissible fade show">
                <p> {{ $blurb }}</p>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        </div>
        @endif



        <div class="form-group row ">
            <label for="variety" class="col-md-2 col-form-label text-md-right ">{{ __('Variety') }}</label>
            <div class="col-md-8">

                <select wire:model="variety" id='variety' class="form-control @error('variety') is-invalid @enderror" name="variety" required>
                    <option value=''>Choose a variety</option>
                    @if ($varieties)
                    @foreach($varieties as $variety)
                    <option value="{{$variety->id}}">{{$variety->name}}</option>
                    @endforeach
                    @endif

                    </option>
                </select>
                @error('variety')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>



        <div class="form-group row ">
            <label for="farm" class="col-md-2 col-form-label text-md-right ">{{ __('Select Farm') }}</label>
            <div class="col-md-8">

                <select name="farm" wire:model.defer="farm" class="form-control @error('farm') is-invalid @enderror">
                    <option value=''>Choose a farm</option>
                    @foreach($farms as $farm)
                    <option value="{{$farm->id}}">{{$farm->name}}</option>
                    @endforeach
                    </option>
                </select>
                @error('farm')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>



       <div class="form-group row">
            <label for="allocation" class="col-md-2 col-form-label text-md-right">{{ ('Acreage') }}</label>

            <div class="col-md-8">
                <input wire:model.defer="allocation" id="allocation" type="number" placeholder="Estimated allocation in Acres" class="form-control  @error('allocation') is-invalid @enderror" name="allocation" value="{{ old('allocation') }}" autocomplete="allocation" autofocus>

                @error('allocation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="planted_date" class="col-md-2 col-form-label text-md-right">{{ ('Date Planted') }}</label>

            <div class="col-md-8">
                <input wire:model.defer="planted_date" id="planted_date" type="date" placeholder="Date Planted" class="form-control  @error('planted_date') is-invalid @enderror" name="planted_date" value="{{ old('planted_date') }}" autocomplete="planted_date" autofocus>

                @error('planted_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </form>



    
    <div class="modal-footer">
        @if($edit_mode)
        <button  type="button" id="btn_edit_cf" class="btn btn-danger">Edit</button>
        @endif
        <button type="submit" wire:click="store" form="frm_crop_farm" class="btn btn-primary"> Save </button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
    </div>
</div>

