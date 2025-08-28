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

                <div style="text-align: center; padding:3%">Your password password reset was a success ! Kindly click on the button below to proceed</div>
                    <div style="padding-bottom:2rem"></div>
                
            <div>
                <a href="{{route('farmer.farmer_dashboard') }}" class="text-success">
                    <button class="btn mgreen shadow-xl mt-3 agrobtn " style="margin-left:38% ">
                        Continue
                    </button></a>
            </div>


            </div>
</body>
@endsection 