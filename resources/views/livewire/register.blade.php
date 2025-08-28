<div>

<form wire:submit.prevent="register"  action="#"  method="POST" style="margin-top: 10%; padding-left:10%">

@csrf

    <div style="margin-left:35%"> <img src="{{ asset('images/logotext_.png') }}" width="30%" height="10%"> </div>
    <div style="margin-left:28%;font-size:18px; font-weight:medium;color:#0A4022;font-family:'Open Sans';">Create an Account</div>
 

        <div class=" row w-100 pt-3">
            <div class="pl-3">

                <input wire:model.defer="first_name" id="first_name" type="text" placeholder="First Name "
                    class="form-control @error('first_name') is-invalid @enderror mtextboxsmall  shadow-outer shadow-inner shadow-md btn-block"
                    name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="pl-4">
                <input  wire:model.defer="other_names" id="other_names" type="text" placeholder="Last Name " style="margin-right:40%"
                    class="form-control @error('other_names') is-invalid @enderror mtextboxsmall  btn-block pr-16"
                    name="other_names" value="{{ old('other_names') }}" required autocomplete="other_names" autofocus>

                @error('other_names')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class=" row w-100 pt-3">

            <div class="col-md-12">
                <input wire:model="mobile" id="reg_mobile" type="text" maxlength="10" placeholder="Mobile phone number"
                    class=" mtextbox  form-control @error('mobile') is-invalid @enderror" name="mobile"
                    value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                @error('mobile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class=" row w-100 pt-3">
            <div class="col-md-12">
                <input wire:model ="mobile"  id="reg_email" type="email" class="form-control @error('email') is-invalid @enderror mtextbox  "
                    placeholder="Email address (likethis@example.com)" name="email" value="{{ old('email') }}" required
                    autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class=" row w-100 pt-3">
            <!-- <div class="form-group row"> -->
            <div class="col-md-12">
                <input id="reg_password" type="password" placeholder="Password (at least 8 characters long)"
                    class="mtextbox   form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class=" row w-100 pt-3">
            <div class="col-md-12">
                <input wire:model.defer="password-confirmation" id="password-confirm" type="password" placeholder="Confirm password"
                    class=" mtextbox   form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>


        <div>
            <button type="submit" class="btn mgreen shadow-xl mt-3 "
                style="font-size:large;width:50%;margin-left:23%; font-weight:bold; font-family:'Open Sans';  color:white; ">
              Register
            </button>
        </div>


        <div class="horizontal_centre" style="padding-left:3.5%; padding-top:3%;color:#323130; font-size:14px;">
            Already have an account ? <a href="#" id="login_link"
                style="text-decoration: underline; color:#168D4B">Sign in.</a>
        </div>

</form>
</div>
