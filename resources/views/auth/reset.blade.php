@extends('layouts.appbs')
@section('content')

<body id='register'>
      <div class="row justify-content-center">
        <div class="mycard">


              <form method="POST" action="{{ route('password.update')}}" style="padding-top: 20%;">
                        @csrf

                         <input type="hidden" name="token" value="{{ $token }}">
                <div style="margin-left:41%"> <img src="{{ asset('images/logotext_.png') }}" width="30%" height="10%">
                </div>
                <div style="text-align:center;font-size:18px;padding-bottom:2%; font-weight:medium;color:#0A4022;font-family:'Open Sans';">
                    Update Password
                </div>
                      
                        <div class="form-group row pl-5">

                            <div class="col-md-12">
                                <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror   mtextbox  shadow-outer shadow-inner shadow-md" 
                                placeholder="like@this.com"
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pl-5">

                            <div class="col-md-12 ">
                                <input id="password" 
                                placeholder="password"
                                type="password" class="form-control @error('password') is-invalid @enderror mtextbox  shadow-outer shadow-inner shadow-md"
                                name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pl-5">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" 
                                placeholder="confirm password"
                                class="form-control mtextbox  shadow-outer shadow-inner shadow-md" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-auto offset-md-3">
                                <button type="submit" class="btn mgreen text-white  shadow-xl agrobtn btn-block"
                                style="margin-left:25%">   
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
</body>
@endsection
