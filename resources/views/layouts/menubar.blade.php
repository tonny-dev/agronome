<nav class="flex w-72 h-full bg-white border-r dark:bg-gray-800 dark:border-gray-600">
                    <div class="w-full flex max-auto pl-8">
                        <ul class="w-full">
                           
                        <li class="pt-5 text-gray-900 hover:shadow-sm shadow-blue-800/50 ">
                                <a href="{{route('farmer.farmer_dashboard') }}"><span class="float-left"><img
                                            src="{{ asset('svg/farm_mi.svg') }}" alt="farm"></span>
                                    <span class="pl-4 ">Farm</span>
                                </a>
                            </li>

                            <li class="pt-5 text-gray-900 hover:shadow-sm shadow-blue-800/50 ">
                                <a href="crop.html">
                                    <span class="float-left"> <img src="{{ asset('svg/crop2.svg') }}"
                                            alt="crop"></span><span class="pl-4">Crop</span></a>
                            </li>

                            <li class="pt-5 text-gray-900 hover:shadow-sm shadow-blue-800/50 ">
                                <a href="{{route('soil_dashboard') }}"> <span class="float-left pt-2"><img
                                            src="{{ asset('svg/soil_mi.svg') }}" alt="soil"></span><span
                                        class="pl-4">Soil</span></a>
                            </li>
                        </ul>
                    </div>
</nav>