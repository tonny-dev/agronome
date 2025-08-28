{{-- This component maybe used later/ or maybe deleted --}}
<!-- <div class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center">
    <div>
        <div class="p-2.5 mt-1 flex items-center">
            <img class="ml-3" src="{{ asset('svg/website_logo.svg') }}" />
        </div>
        <div class="my-2 nav-color h-[1px]"></div>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-white hover:text-green-600 text-white" onclick="dropdown()">
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 font-bold">My Account</span>
            <span class="text-sm rotate-180" id="arrow">
                <i class="bi bi-chevron-down"></i>
            </span>
        </div>
    </div>
    <div class="text-left pl-4 text-sm mt-2 w-4/5 mx-auto text-white font-bold" id="submenu">
        <h1 class="cursor-pointer p-2 hover:text-green-600 hover:bg-white  rounded-md mt-1">
            My Details
        </h1>
        <h1 class="cursor-pointer p-2 hover:text-green-600 hover:bg-white rounded-md mt-1">
            Farm Details
        </h1>
    </div>

    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-white hover:text-green-600 text-white">
        <span class="text-[15px] ml-4 font-bold">FAQ's</span>
    </div>

    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-white hover:text-green-600 text-white" onclick="dropdownlegal()">
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 font-bold">Legal</span>
            <span class="text-sm rotate-180" id="arrowlegal">
                <i class="bi bi-chevron-down"></i>
            </span>
        </div>
    </div>
    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-white font-bold pl-4" id="legalmenu">
        <h1 class="cursor-pointer p-2 hover:text-green-600 hover:bg-white underline rounded-md mt-1">
            Privacy Policy
        </h1>
        <h1 class="cursor-pointer p-2 hover:text-green-600 hover:bg-white rounded-md mt-1">
            Terms & Conditions
        </h1>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-white text-white hover:text-green-600">
        <span class="text-[15px] ml-4 font-bold">Settings</span>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-white text-white hover:text-green-600">
        <span class="text-[15px] ml-4  font-bold">About Agronome</span>
    </div>
    <div class="my-4 nav-color h-[1px]"></div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-white text-white hover:text-green-600">
        <span class="text-[15px] ml-4 font-bold">Logout</span>
    </div>

    <script>
        dropdown();
        dropdownlegal();


        function dropdown() {
            document.querySelector("#submenu").classList.toggle("hidden");
            document.querySelector("#arrow").classList.toggle("rotate-0");
        }

        function dropdownlegal() {
            document.querySelector("#legalmenu").classList.toggle("hidden");
            document.querySelector("#arrowlegal").classList.toggle("rotate-0");
        }


        function openSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
        }
    </script>
</div> -->

<nav class="flex md:w-60 h-screen bg-white hidden md:block lg:block border-r">
    <div class="w-full flex max-auto pl-8">
        <ul class="w-full">

            <li {{{ (Request::is('farm.list') ? 'class=account_side_nav' : '') }}} class="pt-5 font-bold text-gray-300 hover:text-green-600">
                <a href="{{route('farm_list') }}"><span class="float-left"><img src="{{ asset('svg/farm_mi.svg') }}" alt="farm"></span>
                    <span class="pl-4">My Farms</span>
                </a>
            </li>

            <li {{{ (Request::is('my_profile') ? 'class=account_side_nav' : '') }}} class="pt-5 font-bold text-gray-300 hover:text-green-600">
                <a href="{{route('farmer_profile') }}"> <span class="float-left"><i class="fa fa-user" aria-hidden="true"></i>
                    </span><span class="pl-4">My Profile</span></a>
            </li>

            <li {{{ (Request::is('my_account') ? 'class=account_side_nav' : '') }}} class="pt-5 font-bold text-gray-300 hover:text-green-300">
                <a href="{{route('my_account') }}"> <span class="float-left"><i class="fa fa-cog" aria-hidden="true"></i>
                    </span><span class="pl-4">My Account</span></a>
            </li>

        </ul>
    </div>

    <script>
        
    </script>
</nav>