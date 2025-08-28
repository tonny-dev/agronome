@include('layouts.app')
@section('content')

<body class="font-sans">
    <div class="flex min-h-screen">
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- NAV BAR -->
            @include('layouts.top-nav')
            <!-- END NAV BAR -->


            <div class="flex h-full">
                <!--Left menu -->
                <nav class="flex md:w-60 h-full bg-white hidden md:block lg:block border-r dark:bg-gray-800 dark:border-gray-600">
                    <div class="w-full flex max-auto pl-8">
                        <ul class="w-full">

                            <li class="pt-5 font-bold text-green-600 hover:shadow-sm shadow-blue-800/50 ">
                                <a href="{{route('farmer.farmer_dashboard') }}"><span class="float-left"><img src="{{ asset('svg/farm_mi.svg') }}" alt="farm"></span>
                                    <span class="pl-4 ">Farm</span>
                                </a>
                            </li>

                            <li class="pt-5 font-bold text-gray-300 hover:text-green-600 ">
                                <a href="{{route('crop_dashboard') }}" class="">
                                    <span class="float-left"> <img src="{{ asset('svg/crop_inactive.svg') }}" alt="crop"></span><span class="pl-4 ">Crop</span></a>
                            </li>

                            <li class="pt-5 font-bold text-gray-300 hover:shadow-sm shadow-blue-800/50 ">
                                <a href="{{route('soil_dashboard') }}" class=""> <span class="float-left pt-2 "><img src="{{ asset('svg/soil_inactive.svg') }}" alt="soil"></span><span class="pl-4 hover:text-green-600">Soil</span></a>
                            </li>

                        </ul>
                    </div>
                </nav>
                <!-- Left menu end -->

                <main class="w-full bg-white overflow-x-hidden overflow-y-hidden md:mb-0 mb-20">
                    <div class="w-full mx-auto px-6">


                        {{-- <!-- <div class="lg:hidden xl:hidden md:hidden mt-4 p-2 border shadow shadow-lg">
                            @livewire('profilecompleteness')
                        </div> --> --}}


                        <div id="div_landing_page" class="d-block">
                            @livewire('lw-landing-page')
                        </div>

                        <div id="div_add_farm" class="d-none mt-4">
                            @livewire('lw-add-farm')
                        </div>

                        <div id="div_farm_details" class="d-none">
                            @livewire('lw-farm-details')
                        </div>
                    </div>
                </main>



                <!-- RIGHT SIDE BAR  -->

                <nav class="flex w-80 h-full hidden md:block lg:block bg-white border-l">


                    <!-- <div id="div_complete_reg" class="mt-6 px-6 d-block">
                        <h3 class="font-bold text-xs">Continue to <span class="active_nav_button"><a href="{{route('farmer_profile') }}">My Account</a></span> to complete registration</h3>
                    </div> -->

                    <div class="hidden lg:block xl:block mt-6 text-sm mx-4" id="div_complete_reg">
                        @livewire('profilecompleteness')
                    </div>

                    <div id="div_advanced_search" class="d-none">
                        @livewire('lw-advanced-search')
                    </div>

                    <div id="div_legal" class="d-none">
                        @livewire('lw-legal')
                    </div>

                </nav>

            </div>

        </div>
    </div>

    {{-- Small screen Footer --}}
    @include('layouts.mobile-footer')


    <script>
        const menuBtn = document.querySelector('#menu-btn');
        const dropdown = document.querySelector('#dropdown');

        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        })

        //To be deleted too
        $(document).on('click', '#a_complete_profile', function() {
            $('#complete_profile').modal('show');
        });


        $(document).on('click', '#btn_add_farm,#anch_create_farm, #anch_create_farm_mobile', function() {
            div_toggle('div_add_farm', 'div_landing_page');
            div_toggle('div_advanced_search', 'div_complete_reg');
            g_country_map.invalidateSize();

        });

        function div_toggle(show_div, hide_div) {

            $('#' + show_div).removeClass("d-none");
            $('#' + show_div).addClass("d-block");

            $('#' + hide_div).removeClass("d-block");
            $('#' + hide_div).addClass("d-none");

        }
    </script>




    @livewireScripts
</body>

</html>