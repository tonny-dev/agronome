<nav class="nav_color px-2 sm:px-4 py-2.5">
    <div class="flex justify-between items-center">
        <div class="pl-4">
            <a href="http://aires.co.ke/" class="flex items-center">
                <img src="{{ asset('svg/website_logo.svg') }}" class="h-6 sm:h-9" alt="agronome logo">
            </a>
        </div>
        {{-- Desktop Nav --}}
        <div class="md:flex md:items-center space-x-3">
            <i class="bi bi-bell text-white"></i>
            <div class="p-2 hidden md:block lg:block">
                <button id="menu-btn" class="flex rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                    <img class="h-8 w-8 rounded-full" src="{{ asset('svg/user_pic.svg') }}" alt="My profile picture">
                </button>
                <div id="dropdown" class="absolute hidden right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                    <div class="px-2 py-2 bg-white rounded-md shadow">
                        <a id="profile-btn" {{{ (Request::is('farmer_dashboard') ? 'class=hidden' : '') }}} class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{route('farmer.farmer_dashboard') }}">Add New Farm</a>

                        <a id="profile-btn" {{{ (Request::is('my_profile') ? 'class=hidden' : '') }}} class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{route('farmer_profile') }}">My Profile</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{route('logout') }}">Log out</a>
                    </div>
                </div>
            </div>

            {{-- Hamburg menu --}}
            <button type="button" class="inline-flex items-center p-2 ml-3 text-lg text-white md:hidden lg:hidden focus:outline-none focus:ring-2" id="back_arrow" onclick="openNav()">
                <span class="sr-only">Open main menu</span>
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>

    <!-- Dropdown Context menu -->
    {{-- Mobile Nav --}}

    <div id="mobile-menu" class="overlay md:hidden lg:hidden h-screen">
        <div class="overlay-content">
            <div class="text-center profile">
                <!--Closing button-->
                <a href="javascript:void(0)" class="closebtn pt-0" onclick="closeNav()">&times;</a>
                <div class="flex flex-wrap justify-center pt-20 profile__image__div">
                    <div class="w-6/12 sm:w-4/12 px-4">
                        <img src="{{ asset('svg/user_pic.svg')}}" alt="My profile picture" class="shadow-lg rounded-full max-w-full h-auto align-middle border-none" />
                    </div>
                </div>
                <div class="p-4 font-medium text-white">
                    <h3>{{ Auth::user()->first_name }}  {{ Auth::user()->other_names }}</h3>
                    <h3>{{ Auth::user()->email }}</h3>
                </div> 
            </div>
            <div class="profile-properties">
                <div class="flex w-full p-4 bg-white justify-center">
                    <ul class="flex flex-col w-full items-center">
                        <li class="my-px">
                            <a href="{{route('farmer.farmer_dashboard') }}" class="flex flex-row items-center h-12 px-96 rounded text-gray-600">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg> </span>
                                <span class="ml-3">Home</span>
                            </a>
                        </li>
                        <li class="my-px">
                            <a href="{{route('farm_list') }}" class="flex flex-row items-center h-12 px-4 rounded text-gray-600">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <img src="{{ asset('svg/farm_mi.svg') }}" alt="farm">
                                </span>
                                <span class="ml-3">Farms</span>
                            </a>
                        </li>
                        <li class="my-px">
                            <a href="{{route('farmer_profile') }}" class="flex flex-row items-center h-12 px-96 rounded text-gray-600">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Profile</span>
                            </a>
                        </li>
                        <li class="my-px">
                            <a href="{{route('my_account') }}" class="flex flex-row items-center h-12 px-96 rounded text-gray-600">
                                <span class="flex items-center justify-center text-lg text-gray-400">
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Settings</span>
                            </a>
                        </li>
                        <li class="my-px">
                            <a href="{{route('logout') }}" class="flex flex-row items-center h-12 px-96 rounded text-gray-600">
                                <span class="flex items-center justify-center text-lg text-red-400">
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                        <path d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                <span class="ml-3">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mobile-menu").style.height = "100vh";
        }

        function closeNav() {
            document.getElementById("mobile-menu").style.height = "0%";
        }

        openNav();
        closeNav();
    </script>
</nav>