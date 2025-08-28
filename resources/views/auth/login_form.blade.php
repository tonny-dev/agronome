<form method="POST" action="{{ route('login') }}" style="margin-top:17% "> 
    @csrf

    <div style="margin-left:41%"> <img src="{{ asset('images/logotext_.png') }}"> </div>
    <div style="margin-left:40%;font-size:25px; font-weight:bold;color:#0A4022;font-family:'Open Sans';"> Welcome</div>


    <div class="w-120 pl-5 pb-3 pt-3">
        <input id="email" type="text" placeholder="Email address or phone number"
            class="form-control @error('email') is-invalid @enderror mtextbox   "
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- </div> -->

    <!-- <div class="form-group row"> -->

    <div class="w-100 pl-5 pb-3">
        <input id="password" type="password" placeholder="Password"
            class="form-control @error('password') is-invalid @enderror  mtextbox   "
            name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- </div> -->

    <div class="row">
        <div class="col-md-6 " style="font-size:15px;">
            <div class="form-check pl-5">
                <input class="checkbox-round " type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label ml-2" for="remember">
                    {{ __('Remember me') }}
                </label>
            </div>
        </div>

        <div class="col-md-6" style="padding-left:15%; text-decoration: underline;font-size:15px">
            <a href="{{url('/forgot-password')}}"  id="lnk_forgot_pw" class="text-success">Forgot Password?</a>
        </div>
    </div>

    <!-- <div class="form-group row mb-0"> -->
    <div class="col-auto" style="padding-top: 20px; ">
        <button type="submit" class="btn mgreen shadow-xl btn-lg agrobtn" style="margin-left:40% ">  Sign in     </button>
    </div>



    <div style="padding-left: 15%;font-size:15px;color:#323130; margin-top:5%;">
        Don't have an account? Click <a href="{{ url('/register') }}" id="registration_link" class="text-success"
            style="text-decoration:underline">here</a> to create one.</div>
</form>





