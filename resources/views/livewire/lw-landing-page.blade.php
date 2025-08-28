<div>


    <div class="mt-10 hidden md:block lg:block">
        <h2 class="text-center pl-6 text-gray-900 font-semi tracking-wider my-8 transform scale-150 uppercase">Welcome</h2>
        <div class="flex justify-center pl-6 transform scale-125">
            <img src="{{ asset('svg/sunlogo.png') }}" alt="farm logo" />
        </div>
        <h3 class="text-center pl-6 text-gray-700 my-8">Click&nbsp<span class="active_nav_button">
                <a id="anch_create_farm" href="#"><span class="underline">Farm</span></a></span>&nbspto get started</h3>
    </div>

    {{-- mobile view --}}
    <main class="md:hidden lg:hidden mx-4">
        <div class="mt-4 welcome__section">
            <h1 class="text-center uppercase font-medium tracking-wider">Welcome</h1>
            <div class="flex justify-center p-8 transform scale-120">
                <img src="{{ asset('svg/sunlogo.png') }}" alt="farm logo" />
            </div>
            <div>

                <h3 class="text-center text-gray-700 p-2">Click here to get started</h3>
                <div class="flex flex-col justify-center items-center">
                    <div class="relative w-1/2 sm:w-1/3" id="anch_create_farm_mobile">
                        <div class="absolute top-1/2 left-6 transform -translate-x-1/2 -translate-y-1/2 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </div>
                        <p class="block  nav_color text-center w-full border text-white px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">Farm</p>
                        <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-white">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="pt-16 welcome__continue__note">
            <h3 class="text-center text-gray-700">Continue to <span class="active_nav_button"><a href="{{route('farmer_profile') }}">My profile</a></span> to complete registration</h3>
        </div>
    </main>


</div>