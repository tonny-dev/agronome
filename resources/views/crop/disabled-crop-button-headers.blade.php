    <div class="headers mt-4 md:mb-4 mb-2 lg:block hidden sm:hidden">
        <div class="md:flex gap-4 lg:mt-0 mb-2 md:mt-0 mt-0 md:justify-between">
            <!-- Farm Name -->
            <div class="relative inline-block w-64">
                <select disabled class="block appearance-none w-full bg-gray-200 border px-4 py-2 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                    <option selected value=''>Farm</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill="currentColor" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>

            <!-- County -->
            <div class="relative inline-block w-64">
                <select disabled class="block appearance-none w-full bg-gray-200 border px-4 py-2 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option selected value=''>County</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>

            <!-- Constituency -->
            <div class="relative inline-block w-64">
                <select disabled class="block appearance-none w-full bg-gray-200 border px-4 py-2 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                    <option selected value=''>Constituency</option>
                </select>
                <div class="absolute rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>

        </div>

        <div class="md:flex md:justify-between lg:mt-6 mb-2 md:mt-6 xl:mt-6 mt-2 gap-4">
            <!--CROP-->
            <div class="relative inline-block w-64">
                <select disabled class="block appearance-none w-full bg-gray-200 border px-4 py-2 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                    <option selected value=''>Crop</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill="currentColor" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>


            <!--VERSUS-->
            <div class="relative inline-block w-64">
                <input disabled="true" class="shadow bg-gray-200 text-xs rounded-xl py-2 px-3 text-gray-700 h-10" type="text" placeholder="Versus">
            </div>

            <!--VARIETIES-->
            <div class="relative inline-block w-64">
                <input disabled="true" class="shadow bg-gray-200 text-xs rounded-xl py-2 px-3 text-gray-700 h-10" type="text" placeholder="Varieties">
            </div>

        </div>

    </div>