
    @extends('layouts.appbs')
    @section('content')
    <body id='login'>
    <div class="row justify-content-center">



        <div class="mycard">

            <div id="login_form_div" style="display:block">
                @include('auth.login_form')
            </div>

        </div>


    </div>

    <div style="color:white;   margin-top:0.5%" class="row justify-content-center">
        By logging in or registering with us you agree to our &nbsp; <a href="#" class="text-white"
            style="text-decoration:underline"> terms of use.</a>
    </div>


</body>
@endsection


