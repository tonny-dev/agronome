<footer class="grid grid-cols-3 divide-x-2 divide-gray-300 bg-white text-center border-t-2 border-gray-300 md:hidden fixed inset-x-0 bottom-0">
    <div class="active p-4" id="mobile_farm_nav">
        <a href="{{route('farmer.farmer_dashboard') }}"><span class="float-left"><img src="{{ asset('svg/farm_mi.svg') }}" alt="farm"></span>
            <span class="pl-2 ">Farm</span>
        </a>
    </div>
    <div class="p-4" id="mobile_crop_nav">
        <a href="{{route('crop_dashboard') }}" class="">
            <span class="float-left"> <img src="{{ asset('svg/crop_inactive.svg') }}" alt="crop"></span><span class="pl-2">Crop</span>
        </a>
    </div>
    <div class="p-4" id="mobile_soil_nav">
        <a href="{{route('soil_dashboard') }}" class=""> <span class="float-left pt-2"><img src="{{ asset('svg/soil_inactive.svg') }}" alt="soil"></span><span class="pl-2 hover:text-green-600">Soil</span>
        </a>
    </div>

    <script>
        $(document).ready(function() {
            if (window.location.pathname === "/soil_dashboard" || window.location.pathname === "/soil_results" ) {
                $("#mobile_farm_nav").removeClass("active");
                $("#mobile_soil_nav").addClass("active");
            }

            if (window.location.pathname === "/crop_dashboard") {
                $("#mobile_farm_nav, #mobile_soil_nav").removeClass("active");
                $("#mobile_crop_nav").addClass("active");
            }
        });
    </script>
</footer>