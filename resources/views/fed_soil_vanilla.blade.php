<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" href="./css/styles.css">
    <title>Soil</title>
</head>

<body>
    <!--========Nav========-->
    <nav class="bg-green-800 shadow-lg">
        <div class="max-w-8xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <!-- Website Logo -->
                        <a href="http://aires.co.ke/" class="flex items-center py-4 px-2">
                            <svg width="23" height="25" xmlns="http://www.w3.org/2000/svg"><path d="M11.666 24.525c-.851.25-1.853.35-2.954.35-1.503 0-2.855-.25-4.006-.75A6.171 6.171 0 011.95 21.82C1.301 20.819.95 19.517.95 17.965c0-1.302.25-2.404.701-3.305a5.807 5.807 0 011.903-2.203 9.636 9.636 0 012.804-1.302c1.052-.3 2.153-.501 3.355-.601 1.352-.1 2.404-.25 3.255-.4.801-.151 1.402-.351 1.803-.602.35-.25.55-.65.55-1.101v-.1c0-.802-.25-1.403-.8-1.803-.552-.45-1.253-.651-2.204-.651-1.002 0-1.803.2-2.404.65-.6.451-1.001 1.002-1.151 1.753l-6.91-.15c.2-1.452.75-2.704 1.602-3.856.851-1.151 2.003-2.003 3.505-2.654C8.46.99 10.264.69 12.367.69c1.502 0 2.904.2 4.156.55 1.252.351 2.354.852 3.305 1.553.952.651 1.653 1.502 2.204 2.454.5.951.75 2.053.75 3.305v15.974h-7.01V21.27h-.2a6.297 6.297 0 01-1.603 2.003c-.65.55-1.402.951-2.303 1.252zm-2.704-5.308c.5.55 1.202.751 2.103.751.801 0 1.552-.15 2.203-.5a4.535 4.535 0 001.553-1.353c.4-.6.6-1.252.6-2.003V13.86c-.2.1-.45.2-.75.3-.3.1-.651.2-1.002.25-.35.1-.701.15-1.102.2-.4.051-.75.101-1.101.151-.701.1-1.302.3-1.803.5-.5.251-.851.552-1.152.902-.25.35-.4.801-.4 1.302 0 .751.3 1.352.85 1.753z" fill="#ffff"/></svg>
                            <svg width="8" height="34" xmlns="http://www.w3.org/2000/svg"><path d="M6.848 6.184c-.701.7-1.603 1.051-2.654 1.051-1.052 0-1.953-.35-2.704-1.051C.739 5.483.338 4.63.338 3.63c0-1.002.4-1.803 1.152-2.504.7-.7 1.602-1.051 2.654-1.051 1.051 0 1.953.35 2.704 1.051.75.701 1.101 1.553 1.101 2.554 0 1.002-.35 1.803-1.101 2.504zm1.051 27.29H.39V9.94h7.51v23.536z" fill="#ffff"/></svg>                            <svg width="16" height="25" xmlns="http://www.w3.org/2000/svg"><path d="M8 24.475H1V.939h7.116v4.307h.25c.451-1.552 1.152-2.704 2.104-3.455.951-.751 2.103-1.152 3.405-1.152.35 0 .7 0 1.051.05.35.05.701.1 1.002.2V7.4c-.35-.1-.801-.2-1.402-.3-.601-.05-1.102-.1-1.553-.1-.9 0-1.702.2-2.403.6-.701.401-1.252.952-1.653 1.653-.4.7-.6 1.502-.917 2.454v12.769z" fill="#ffff"/></svg>
                            <svg width="24" height="25" xmlns="http://www.w3.org/2000/svg"><path d="M8.29 14.56h15.674v-1.853c0-1.953-.3-3.655-.851-5.158-.551-1.502-1.352-2.754-2.354-3.755a9.687 9.687 0 00-3.605-2.304A13.465 13.465 0 0012.547.69c-2.354 0-4.407.5-6.16 1.502-1.752 1.002-3.104 2.454-4.056 4.257C1.381 8.25.88 10.404.88 12.808c0 2.503.501 4.656 1.452 6.459.952 1.803 2.304 3.205 4.107 4.156 1.802.952 3.906 1.452 6.36 1.452 2.052 0 3.855-.3 5.407-.951 1.553-.651 2.805-1.502 3.806-2.654 1.002-1.152 1.602-2.454 1.853-4.006l-6.86-.15c-.2.5-.501.951-.852 1.302-.4.35-.851.65-1.402.8-.55.201-1.152.301-1.803.301-.951 0-1.802-.2-2.503-.6-.701-.401-1.252-.952-1.603-1.653-.4-.701-.55-1.552-.55-2.504v-.2zm.601-6.36c.4-.7.902-1.202 1.603-1.552a4.69 4.69 0 012.253-.55c.851 0 1.552.2 2.203.55.651.35 1.152.851 1.503 1.452.35.601.55 1.352.55 2.153H8.29c.05-.75.25-1.452.601-2.053z" fill="#ffff"/></svg>
                            <svg width="23" height="25" xmlns="http://www.w3.org/2000/svg"><path d="M19.294 2.592C21.197 3.994 22.2 5.847 22.4 8.15l-6.86.2c-.05-.5-.25-.9-.601-1.301-.3-.401-.751-.701-1.252-.902-.5-.2-1.102-.35-1.753-.35-.85 0-1.602.15-2.203.5-.6.351-.901.802-.901 1.403 0 .45.2.85.55 1.201.401.35 1.052.601 2.054.802l4.556.85c2.354.452 4.107 1.203 5.258 2.254C22.4 13.86 23 15.211 23 16.963c0 1.603-.5 3.005-1.452 4.207s-2.254 2.103-3.856 2.804c-1.652.65-3.505 1.001-5.608 1.001-3.355 0-6.01-.7-7.962-2.053-1.953-1.402-3.055-3.254-3.305-5.558l7.41-.2c.151.851.602 1.502 1.253 1.953.7.45 1.552.65 2.604.65.951 0 1.752-.2 2.353-.55.601-.35.902-.851.902-1.402 0-.551-.25-.952-.702-1.302-.45-.3-1.201-.551-2.153-.751l-4.106-.802c-2.353-.45-4.106-1.201-5.258-2.403C1.968 11.405 1.418 9.903 1.418 8.1c0-1.552.4-2.904 1.252-4.056.85-1.102 2.053-1.953 3.605-2.554C7.827.89 9.68.59 11.783.59c3.205 0 5.709.65 7.511 2.003z" fill="#ffff"/></svg>
                        </a>
                    </div>

                </div>
                <!-- Right Navbar items -->
                <div class="hidden md:flex items-center space-x-3">
                    <button class="outline-none">
                    <span class="sr-only">Notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg width="20" height="27" xmlns="http://www.w3.org/2000/svg"><path d="M20 23v-2.3l-2.2-4.5v-5.9c0-3.7-2.6-6.9-6.2-7.7v-1C11.7.7 10.9 0 10 0c-.9 0-1.7.7-1.7 1.7v1c-3.6.8-6.2 4-6.2 7.7v5.9L0 20.7V23h5.4c.3 2.3 2.2 4 4.6 4 2.4 0 4.3-1.8 4.6-4H20zm-6.7-.1c-.3 1.6-1.6 2.8-3.3 2.8-1.7 0-3-1.2-3.3-2.8h6.6zm5.5-2v.8H1.3V21l2.2-4.5v-6.1c0-3.3 2.4-6.1 5.6-6.5l.5-.1V1.7c0-.2.2-.4.4-.4s.4.2.4.4v2.1h.6c3.2.5 5.6 3.3 5.6 6.5v6.1l2.2 4.5z" fill="#fff" fill-opacity=".996"/></svg>

                  </button>
                    <div class="p-2">
                        <button type="button" class="bg-green-500 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full" src="images_farm/user_profile/u1363.svg" alt="My profile picture">
                    </button>
                    </div>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                <svg class=" w-6 h-6 text-gray-500 hover:text-white "
                    x-show="!showMenu"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
                </div>
            </div>
        </div>
        <!-- mobile menu -->
        <div class="hidden mobile-menu">
            <ul class="">
                <li class="active">
                    <a href="notifications.html" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="none" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    </a>
                </li>
                <li>
                    <a href="profile.html" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full" src="images_farm/user_profile/u1363.svg" alt="My profile picture">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--========End of Nav=====-->
    <!--Table-->
    <table class="table-fixed w-full h-screen">
        <tr valign="top">
            <!--Left Menu-->
            <td class="bg-gray-100 w-1/5">
                <ul>
                    <li class="mx-4 my-4 text-green-900 hover:bg-gray-400">
                        <a href="farm.html"><span class="float-left"><img src="images_farm/farm/u326.svg" alt="farm"></span>
                            <span class="pl-4">Farm</span>
                        </a>
                    </li>
                    <li class="mx-4 my-4 text-green-900 hover:bg-gray-400">
                        <a href="crop.html">
                            <span class="float-left"> <img src="images_farm/farm/u328.svg" alt="crop"></span><span class="pl-4">Crop</span></a>
                    </li>
                    <li class="mx-4 my-4 text-green-900 hover:bg-gray-400 flex">
                        <a href="soil.html"> <span class="float-left"><img src="images_farm/farm/u332.svg" alt="soil"></span><span class="pl-4">Soil</span></a>
                    </li>
                    <li class="mx-4 my-4 text-green-900 hover:bg-gray-400">
                        <a href="reource.html"><span class="float-left"><img src="images_farm/farm/u337.svg" alt="resource"></span><span class="pl-4">Resource</span></a>
                    </li>
                    <li class="mx-4 my-4 text-green-900 hover:bg-gray-400">
                        <a href="analytics.html"><span class="float-left"><img src="images_farm/farm/u338.svg" alt="analytics"></span><span class="pl-4">Analytics</span></a>
                    </li>
                    <li class="mx-4 my-4 text-green-900 hover:bg-gray-400">
                        <a href="classified.html"><span class="float-left"><img src="images_farm/farm/u339.svg" alt="classified"></span><span class="pl-4">Classified</span></a>
                    </li>
                </ul>

            </td>
            <!--End of Lef Menu-->
            <!--Main (center) content-->
            <td class="bg-white">
                <!--Farm buttons-->
                <div class="flex -my-0.5">
                    <div class="flex-1">
                        <div class="m-10">
                            <!--farm name-->
                            <select class="bg-transparent hover:bg-green-800 text-gray-500 text-sm py-2 px-4 inline-flex items-center shadow-lg w-36 border border-green-500 hover:border-transparent rounded" id="field-no">
                              <option>FarmName</option>
                              <option>Farm One</option>
                              <option>Farm Two</option>
                              <option>Farm Three</option>
                            </select>
                            <!--end of farm name-->
                            <!--Crop-->
                            <select class="bg-transparent hover:bg-green-800 text-gray-500 text-sm py-2 px-4 inline-flex items-center shadow-lg w-36 border border-green-500 hover:border-transparent rounded my-4">
                              <option>Crop</option>
                              <option>Tomatoe</option>
                              <option>Tomatoe</option>
                              <option>Onions</option>
                            </select>
                            <!--end of crop-->
                            <!--soil type-->
                            <select class="bg-green-700 text-white text-sm py-2 px-4 rounded shadow-lg w-36">
                              <option>Soil Type</option>
                              <option>Sandy Soil</option>
                              <option>Silt Soil</option>
                              <option>Clay Soil</option>
                              <option>Loamy Soil</option>
                            </select>
                            <!--end of soil type-->
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="m-10">
                            <!--Field No-->
                            <select class="bg-transparent hover:bg-green-800 text-gray-500 text-sm py-2 px-4 inline-flex items-center shadow-lg w-36 border border-green-500 hover:border-transparent rounded" id="field-no">
                              <option>Farm No</option>
                              <option>Field One</option>
                              <option>Field Two</option>
                              <option>Field Three</option>
                            </select>
                            <!--End of Field No-->
                            <!--Nutrient-->
                            <select class="bg-green-700 hover:bg-green-800 text-white text-sm py-2 px-4 inline-flex items-center shadow-lg w-36  rounded my-4">
                              <option>Nutrient</option>
                              <option>Potassium</option>
                              <option>Sulphate</option>
                              <option>Manganate</option>
                            </select>
                            <!--end of Nutrient-->
                            <!-- Soil test-->
                            <select class="bg-green-700 text-white text-sm py-2 px-4 rounded shadow-lg w-36" id="SelectOption">
                              <option>Soil Test</option>
                              <option>Acidity</option>
                              <a href="./physical.html"><option>Physical</option></a>
                              <option>Ph</option>
                            </select>
                            <!-- of soil test-->
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="m-10">
                            <select class="bg-transparent hover:bg-green-800 text-gray-500 text-sm py-2 px-4 inline-flex items-center shadow-lg w-36 border border-green-500 hover:border-transparent rounded" id="field-no">
                              <option>Field size</option>
                              <option>Acre</option>
                              <option>1/2 Acre</option>
                              <option>1/3 Acre</option>
                            </select>
                            <!--Fertilizer-->
                            <select class="bg-green-700 hover:bg-green-800 text-white text-sm py-2 px-4 inline-flex items-center shadow-lg w-36  rounded my-4">
                              <option>Fertilizer</option>
                              <option>Nitrogen Fertilizers </option>
                              <option>Phosphate Fertilizers</option>
                              <option>Potassium Fertilizers </option>
                            </select>
                            <!--end of fertilizer-->
                            <!--Date-->
                            <form>
                                <div class="relative text-gray-600 focus-within:text-gray-400">
                                    <input class="shadow appearance-xl border text-xs rounded w-36 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-10" id="date" type="date">
                                    <span class="absolute inset-y-0  flex items-center mx-36">
                                    <button type="submit" class="p-1 h-6 w-4 focus:outline-none focus:shadow-outline">
                                    </button>
                                    
                                  </span>
                                </div>
                            </form>
                            <!--end of Date-->
                        </div>
                    </div>
                </div>
                <!--Graphic area-->
                <div class="mx-60">
                    <img src="./images_farm/soil.png">
                    <!--Welcome text-->
                    <div class="text-3xl mx-11">
                        <p>Welcome to Soil </p>
                    </div>
                    <!--End of welcome txt-->
                </div>
                <!--continue Btn-->
                <div class="mx-80">
                    <button class="bg-blue-400 hover:bg-green-500 text-white text-xs hover:text-white py-2 px-4 rounded-full w-36"><a href="./instructions.html"/>
                        Continue
                      </button>
                </div>
            </td>
            <!--End of Center Content-->
            <!--Right side-->
            <td class="bg-gray-100 w-1/5">
                <div class="mx-16 my-4 text-xl text-green-800">
                    <p>More Infomation</p>
                </div>
                <!--Report button-->
                <div class="m-10 my-24 mx-24">
                    <button class="bg-green-700 text-white text-sm py-2 px-4 rounded inline-flex items-center shadow-lg w-36" id="menu-btn">
                        <span class="mx-3">Report</span>
                        <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                      </button>

                    <div class="bg-gray-200 hidden flex-col rounded mt-1 p-2 text-sm w-36" id="dropdown">
                        <a href="#" class="px-2 py-1 hover:bg-gray-100 rounded">One</a>
                        <a href="#" class="px-2 py-1 hover:bg-gray-100 rounded">Two</a>
                        <a href="#" class="px-2 py-1 hover:bg-gray-100 rounded">Three</a>
                    </div>
                </div>
            </td>
        </tr>

    </table>
    <script src="./js/main.js"></script>
</body>

</html>