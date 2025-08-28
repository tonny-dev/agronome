<div>

    <div class="md:flex gap-4 lg:mt-0 mb-2 md:mt-0 mt-0 md:justify-between">


        <!--Farm Name-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select disabled="true" class="block appearance-none w-full bg-gray-200 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option selected value=''>Farm</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>


        <!--Select Field-->
        <div class="relative inline-block md:w-64 hidden md:block">
            <select disabled="true" class="block appearance-none w-full bg-gray-200 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option selected value=''>Field</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>


        <!--Field Size-->
        <div class="relative inline-block md:w-64 md:block hidden">
            <input disabled="true" class="block appearance-none w-full bg-gray-200 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" placeholder="Size" required>
            <div class="">
                <select class="absolute appearance-none rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400" required>
                    <option value="">acres</option>
                </select>
            </div>
        </div>

        <div class="md:hidden grid grid-cols-2 gap-4">
            <!--Select Field-->
            <div class="relative inline-block w-full mt-4">
                <select disabled="true" class="block appearance-none w-full bg-gray-200 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                    <option selected value=''>Field</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>

            </div>


            <!--Field Size-->
            <div class="relative inline-block w-full mt-4">
                <input disabled="true" class="block appearance-none w-full bg-gray-200 border  px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" placeholder="Size" required>
                <div class="">
                    <select class="absolute appearance-none rounded-r-xl bg-transparent border-l inset-y-0 right-0 outline-none flex items-center px-2 text-gray-400" required>
                        <option value="">acres</option>
                    </select>
                </div>
            </div>
        </div>


    </div>


    <!--second row starts here -->


    <div class="md:flex md:justify-between mb-2 md:mt-6 gap-4 hidden md:block">
        <!--TEST TYPE-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select disabled="true" class="block bg-gray-200 appearance-none w-full border px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option selected value=''>Test Type</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>

        </div>


        <!--SELECT TEST-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <select disabled="true" class="block appearance-none w-full bg-gray-200 border px-4 py-2 pr-8 rounded-xl shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option selected value=''>Select Test</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 border-l flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>


        <!--TEST DATE-->
        <div class="relative inline-block md:w-64 w-full mt-4 md:mt-0">
            <input class="shadow border bg-gray-200 text-xs rounded-xl w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-10" type="date">
        </div>
    </div>




</div>