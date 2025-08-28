<div>


        <div class="form-group row">
            <label for="completed_on" class="col-md-2 col-form-label text-md-right">{{ ('Date Completed') }}</label>

            <div class="col-md-8">
                <input id="completed_on" type="date" placeholder="Date Planted" class="form-control  @error('completed_on') is-invalid @enderror" name="completed_on" value="{{ old('completed_on') }}" autocomplete="completed_on" autofocus>

                @error('completed_on')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    

        <div class="form-group row">
            <label for="allocation" class="col-md-2 col-form-label text-md-right">{{ ('Notes') }}</label>

            <div class="col-md-8">
                <input id="allocation" type="textarea" placeholder="Short Description" class="form-control  @error('allocation') is-invalid @enderror" name="allocation" value="{{ old('allocation') }}" autocomplete="allocation" autofocus>

                @error('allocation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="modal-footer">
        @if($edit_mode)
        <button  type="button" id="btn_edit_cf" class="btn btn-danger">Edit</button>
        @endif
        <button type="submit"  form="frm_crop_farm" class="btn btn-primary"> Save </button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
    </div>




</div>
