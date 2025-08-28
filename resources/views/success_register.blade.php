<body id='login'>
@extends('layouts.appbs')
@section('content')

<div class="row justify-content-center">


            <div class="mycard ">
                <div style="padding-top:12%;padding-left:39%;padding-bottom:3%"  > <img src="{{ asset('images/logotext_.png') }}"> </div>
                              
                <div style="text-align: center; font-weight:800px"><h5> One more step...</h5>    </div>

                <div style="padding-bottom:2rem"></div>
                <div style="padding-left:40%"><img src="{{ asset('images/green_mail.svg') }}" alt="" width="90" height="40"></div>

                <div style="padding-bottom:1rem"></div>

                <div style="text-align: center; padding:3%">Thank you for registering. Complete your registration through the link sent to the email address provided.
                 Be sure to check in the Junk folder of your inbox in case of a missing email or contact the administrator.</div>
                    <div style="padding-bottom:2rem"></div>
                <div style="text-align: center;"><a href="{{ url('/login') }}" class="text-success">Back to Log In </a>
                </div>


            </div>
</body>
@endsection 