@extends('layouts.appbs')
@section('content')

<body id='register'>
    <div class="row justify-content-center">
        <div class="mycard">

            @if (session('status'))
            <p class="alert alert-success col-md-10 bg-long ml-5">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('password.request') }}" style="padding-top:22%;padding-left:10%">
            <div style="margin-left:31%; padding-bottom:7%"> <img src="{{ asset('images/logotext_.png') }}"> </div>

            @csrf

                <input type="hidden" name="token" value="">

                <div class="">

             
                    <div class="pr-3 pb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror mtextbox  shadow-outer shadow-inner shadow-md "
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                            placeholder="your@email.address" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                
                <div class="form-group row mb-0 pl-4">
                    <div class="col-auto ">
                        <button type="submit" class="btn mgreen text-white btn shadow-xl agrobtn btn-block " style="margin: left 43%">
                            {{ __('Recover Password') }}
                        </button>
                    </div>
                </div>
                <div style="padding-bottom:2rem"></div>
                <div class="pl-5 horizontal_center"> Already have an account? <a href="{{ url('/login') }}" class="text-success"
                        style="text-decoration:underline">Sign in here.</a> </div>

            </form>
        </div>
    </div>
</body>
@endsection