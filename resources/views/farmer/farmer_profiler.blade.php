<div>
    <div class="modal fade" id="md_farmer_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">please complete your profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container py-0">
                        <div class="row">
                            <div class="col-md-10 mx-auto">



                                <form action="{{route('farmer.update_profile')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="first_name" ">{{ __('First Name') }}</label>  
                                    
                                <input id=" first_name" type="text" placeholder="{{ Auth::user()->other_names }}"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ old('first_name') }}" required
                                                autocomplete="first_name" autofocus>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>





                                        <div class="col-sm-6">
                                            <label for="inputLastname">Other Names</label>
                                            <input type="text" class="form-control" id="inputLastname"
                                                placeholder="{{ Auth::user()->other_names }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputAddressLine1">Address</label>
                                            <input type="text" class="form-control" id="inputAddressLine1"
                                                placeholder="Street Address">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputAddressLine2">Address (Line 2)</label>
                                            <input type="text" class="form-control" id="inputAddressLine2"
                                                placeholder="Line 2">
                                        </div>
                                    </div>





                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputCity">County</label>
                                            <input type="text" class="form-control" id="inputCity" placeholder="County">
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="inputState">Gender</label>
                                            <input type="text" class="form-control" id="inputState"
                                                placeholder="Gender">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputPostalCode">D.O.B</label>
                                            <input type="date" class="form-control" id="inputPostalCode"
                                                placeholder="D.O.B">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputContactNumber">Contact Number</label>
                                            <input type="number" class="form-control" id="inputContactNumber"
                                                placeholder="{{ Auth::user()->mobile }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputWebsite">National ID</label>
                                            <input type="text" class="form-control" id="inputWebsite"
                                                placeholder="ID Number">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="sumbit" class="btn btn-primary">Save changes</button>
                                    </div>

                                </form>




                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Save changes</button>
                </div>


            </div>
        </div>
    </div>
</div>