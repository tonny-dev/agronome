@include('layouts.app')
@section('content')

<body class="font-sans">
    <div class="flex h-full">
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

                <main class="w-full bg-white overflow-x-hidden overflow-y-hidden mb-60">
                    <div class="w-full mx-auto px-6">
                        <div class="mt-10">
                            <div class="font-bold flex flex-col justify-center items-center">
                                <img src="{{ asset('images/success.svg') }}" width="300" height="200" alt="success_svg" />
                                <div class="m-4">
                                    <p>Your farm has been added successfully.</p>
                                    <p class="text-xs">Click add new farm to add another farm or you can proceed to soil or crop </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 md:gap-6 gap-2 md:mx-20 lg:mx-20 mt-8">
                                <button class="nav_color pl-6 pr-6 text-white rounded focus:outline-none hover:bg-green-500"><a href="{{route('farmer.farmer_dashboard') }}">Add new Farm</a></button>
                                <button class="nav_color pl-6 pr-6 text-white rounded focus:outline-none hover:bg-green-500"><a href="{{route('soil_dashboard') }}">Proceed to soil</a></button>
                                <button class="nav_color pl-6 pr-6 text-white rounded focus:outline-none hover:bg-green-500"><a href="{{route('crop_dashboard') }}">Proceed to crop</a></button>
                            </div>
                        </div>
                    </div>
                </main>



                <!-- RIGHT SIDE BAR  -->

                <nav class="flex w-80 h-full hidden md:block lg:block bg-white border-l">
                    <div class="mt-7 px-6 d-block">
                    @livewire('profilecompleteness')
                        <!-- <h3 class="font-bold text-xs">Continue to <span class="active_nav_button"><a href="{{route('farmer_profile') }}">My Account</a></span> to complete registration</h3> -->
                    </div>
                </nav>





            </div>

        </div>
    </div>

    <!-- MODALS  -->


    <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="profile-modal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">


                @livewire('lw-farmer-profile')
            </div>
        </div>
    </div>

    <script>
        const menuBtn = document.querySelector('#menu-btn');
        const dropdown = document.querySelector('#dropdown');

        menuBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('show');
        })
    </script>
</body>

</html>