@include('layouts.app')
@section('content')

<body>
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top NAV BAR -->
        @include('layouts.top-nav')
        <!-- END Top NAV BAR -->

        <div class="flex h-full">
            <!--Left menu -->
            <nav class="flex md:w-60 h-screen bg-white hidden md:block lg:block border-r">
                <div class="w-full flex max-auto pl-8">
                    <ul class="w-full">

                        <li class="pt-5 font-bold text-green-600 hover:shadow-sm">
                            <a href="{{route('farmer.farmer_dashboard') }}"><span class="float-left"><img src="{{ asset('svg/farm_mi.svg') }}" alt="farm"></span>
                                <span class="pl-4 ">Farm</span>
                            </a>
                        </li>

                        <li class="pt-5 font-bold text-gray-300 hover:text-green-600 ">
                            <a href="{{route('crop_dashboard') }}" class="">
                                <span class="float-left"> <img src="{{ asset('svg/crop_inactive.svg') }}" alt="crop"></span><span class="pl-4 ">Crop</span></a>
                        </li>

                        <li class="pt-5 font-bold text-gray-300 hover:shadow-sm">
                            <a href="{{route('soil_dashboard') }}" class=""> <span class="float-left pt-2 "><img src="{{ asset('svg/soil_inactive.svg') }}" alt="soil"></span><span class="pl-4 hover:text-green-600">Soil</span></a>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- Left menu end -->

            <main class="w-full bg-white mx-4">
                <div class="mt-8 border-b border-green-600">
                    <h1 class="font-medium pb-2">Privacy Policy</h1>
                </div>

                <div class="mt-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nunc tellus, sagittis et cursus quis, gravida eu purus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in lectus sit amet nisi tristique finibus eget quis orci. Sed metus libero, imperdiet sed bibendum nec, porttitor et velit. Aliquam erat volutpat. Pellentesque eget volutpat nulla. Etiam ultricies rhoncus nulla in maximus. Maecenas ac dapibus eros. </p>
                    <p class="pt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nunc tellus, sagittis et cursus quis, gravida eu purus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in lectus sit amet nisi tristique finibus eget quis orci. Sed metus libero, imperdiet sed bibendum nec, porttitor et velit. Aliquam erat volutpat. Pellentesque eget volutpat nulla. Etiam ultricies rhoncus nulla in maximus. Maecenas ac dapibus eros. </p>
                </div>
            </main>
        </div>

    </div>
</body>