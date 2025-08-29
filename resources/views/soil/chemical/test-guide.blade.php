@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Navigation Bar -->
        @include('layouts.top-nav')

        <div class="flex h-full">
            <!-- Left Menu -->
            <nav class="flex md:w-60 h-full bg-white hidden md:block lg:block border-r">
                <div class="w-full flex max-auto pl-8">
                    <ul class="w-full">
                        <li class="pt-5 font-bold text-gray-300 hover:text-green-600">
                            <a href="{{ route('farmer.farmer_dashboard') }}">
                                <span class="float-left"><img src="{{ asset('svg/farm_inactive.svg') }}" alt="farm"></span>
                                <span class="pl-4">Farm</span>
                            </a>
                        </li>
                        <li class="pt-5 font-bold text-gray-300 hover:text-green-600">
                            <a href="{{ route('crop_dashboard') }}">
                                <span class="float-left"><img src="{{ asset('svg/crop_inactive.svg') }}" alt="crop"></span>
                                <span class="pl-4">Crop</span>
                            </a>
                        </li>
                        <li class="pt-5 font-bold text-green-600 hover:shadow-sm shadow-blue-800/50">
                            <a href="{{ route('chemical-soil.index') }}">
                                <span class="float-left pt-2"><img src="{{ asset('svg/soil_mi.svg') }}" alt="soil"></span>
                                <span class="pl-4 hover:text-green-600">Soil</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1 bg-gray-50 overflow-x-hidden">
                <div class="container mx-auto px-6 py-8">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-8" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('chemical-soil.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Soil Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Chemical Test Guide</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">Chemical Soil Testing Guide</h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Learn how to conduct comprehensive chemical soil analysis for 
                            <span class="font-semibold text-green-600">{{ $farm->name }}</span>
                        </p>
                    </div>

                    <!-- Test Overview -->
                    <div class="bg-white rounded-lg shadow-lg mb-8">
                        <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                            <h2 class="text-xl font-semibold text-blue-800 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                What is Chemical Soil Testing?
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Chemical Analysis Includes:</h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium">pH Level</span>
                                                <p class="text-sm text-gray-600">Soil acidity/alkalinity affecting nutrient availability</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium">Major Nutrients (N-P-K)</span>
                                                <p class="text-sm text-gray-600">Nitrogen, Phosphorus, and Potassium levels</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium">Organic Matter Content</span>
                                                <p class="text-sm text-gray-600">Soil carbon and biological activity indicators</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium">Micronutrients</span>
                                                <p class="text-sm text-gray-600">Iron, Zinc, Manganese, and other trace elements</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <span class="font-medium">Electrical Conductivity</span>
                                                <p class="text-sm text-gray-600">Soil salinity levels and nutrient mobility</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Benefits You'll Get:</h3>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Precise fertilizer recommendations tailored to your soil</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Optimize input costs and reduce wastage</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Identify deficiencies before they affect crops</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Track soil health improvement over seasons</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Increase crop yields through targeted nutrition</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testing Process -->
                    <div class="bg-white rounded-lg shadow-lg mb-8">
                        <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                            <h2 class="text-xl font-semibold text-green-800 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Chemical Testing Process
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-8">
                                <!-- Step 1 -->
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                            <span class="text-lg font-bold text-green-600">1</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Equipment Pickup</h3>
                                        <p class="text-gray-600 mb-3">
                                            Visit your selected agro-vet/extension office to collect the chemical soil testing kit. 
                                            The vendor will demonstrate proper usage and run diagnostics to ensure everything works correctly.
                                        </p>
                                        <div class="bg-gray-50 p-3 rounded-md">
                                            <p class="text-sm text-gray-700">
                                                <strong>What's included:</strong> Digital testing device, soil pH meter, nutrient testing strips, 
                                                GPS device, sampling tools, and instruction manual.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                            <span class="text-lg font-bold text-green-600">2</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Sampling Plan Execution</h3>
                                        <p class="text-gray-600 mb-3">
                                            Follow the sampling plan to collect soil from designated locations across your farm. 
                                            The system will guide you through each sampling point with GPS coordinates.
                                        </p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-blue-50 p-3 rounded-md">
                                                <p class="text-sm text-blue-700">
                                                    <strong>Surface Testing (0-15cm):</strong> Test topsoil where most root activity occurs
                                                </p>
                                            </div>
                                            <div class="bg-purple-50 p-3 rounded-md">
                                                <p class="text-sm text-purple-700">
                                                    <strong>Subsurface Testing (30cm):</strong> Analyze deeper soil layers for nutrient mobility
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                            <span class="text-lg font-bold text-green-600">3</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Real-time Testing</h3>
                                        <p class="text-gray-600 mb-3">
                                            At each sampling location, the device will test both surface and subsurface soil samples. 
                                            Results are instantly transmitted to our servers for processing.
                                        </p>
                                        <div class="bg-yellow-50 border border-yellow-200 p-3 rounded-md">
                                            <p class="text-sm text-yellow-700">
                                                <strong>Note:</strong> Each test takes approximately 5-10 minutes per depth. 
                                                Ensure GPS signal is strong for accurate location recording.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                            <span class="text-lg font-bold text-green-600">4</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Equipment Return & Analysis</h3>
                                        <p class="text-gray-600 mb-3">
                                            Return the testing kit to the vendor for diagnostics verification. 
                                            Once confirmed functional, detailed analysis reports will be unlocked in your dashboard.
                                        </p>
                                        <div class="bg-green-50 p-3 rounded-md">
                                            <p class="text-sm text-green-700">
                                                <strong>Analysis includes:</strong> Nutrient maps, fertilizer recommendations, 
                                                application rates, timing suggestions, and cost estimates.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Safety & Best Practices -->
                    <div class="bg-white rounded-lg shadow-lg mb-8">
                        <div class="px-6 py-4 border-b border-gray-200 bg-orange-50">
                            <h2 class="text-xl font-semibold text-orange-800 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.863-.833-2.632 0L4.182 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                Important Guidelines & Best Practices
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-orange-700">Safety Guidelines:</h3>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-orange-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Handle testing equipment with care - it contains sensitive electronic components</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-orange-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Avoid testing during or immediately after rain</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-orange-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Keep device away from direct sunlight and moisture</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-orange-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Charge device fully before starting field work</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-orange-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Clean sampling tools between different locations</span>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-green-700">Best Practices:</h3>
                                    <ul class="space-y-2 text-sm">
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Test soil when moisture content is at field capacity (not too wet, not too dry)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Test soil when moisture content is at field capacity (not too wet, not too dry)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Allow device to calibrate for 2-3 minutes before each test</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Take multiple readings and average results for accuracy</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Record ambient conditions (temperature, humidity) for each location</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 text-green-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Complete all sampling within the same day for consistency</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Agreement and Next Steps -->
                    <div class="bg-white rounded-lg shadow-lg mb-8">
                        <div class="p-6">
                            <div class="bg-green-50 border-2 border-green-200 rounded-lg p-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-lg font-semibold text-green-800 mb-2">Ready to Proceed?</h3>
                                        <p class="text-green-700 mb-4">
                                            By clicking "I Understand", you confirm that you have read and understood the chemical soil testing guide 
                                            and are ready to proceed with finding available testing equipment vendors.
                                        </p>
                                        <div class="flex items-center space-x-3">
                                            <input type="checkbox" id="understand-checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <label for="understand-checkbox" class="text-sm text-green-700">
                                                I have read and understand the chemical soil testing process
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between">
                        <a href="{{ route('chemical-soil.select-farm') }}?farm_id={{ $farm->id }}{{ $field ? '&field_id=' . $field->id : '' }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Farm Details
                        </a>

                        <a href="#" 
                           id="proceed-btn"
                           data-href="{{ route('chemical-soil.vendors', ['farm_id' => $farm->id, 'field_id' => $field->id ?? null]) }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-400 cursor-not-allowed transition duration-150 ease-in-out">
                            Find Available Vendors
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </main>

            <!-- Right Sidebar -->
            <nav class="flex w-80 h-full hidden lg:block bg-white border-l">
                <div class="w-full p-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-blue-800 mb-3">Testing Timeline</h3>
                        <div class="space-y-3 text-xs text-blue-700">
                            <div class="flex justify-between">
                                <span>Equipment pickup:</span>
                                <span class="font-medium">Day 1</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Field testing:</span>
                                <span class="font-medium">Day 2</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Equipment return:</span>
                                <span class="font-medium">Day 3</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Results available:</span>
                                <span class="font-medium">Day 4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-yellow-800 mb-3">Testing Conditions</h3>
                        <ul class="text-xs text-yellow-700 space-y-1">
                            <li>• Test during dry weather</li>
                            <li>• Soil temperature: 15-25°C</li>
                            <li>• Avoid recently fertilized areas</li>
                            <li>• Allow 48hrs after rain</li>
                            <li>• Test before applying lime</li>
                        </ul>
                    </div>
                    
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-green-800 mb-3">Support & Help</h3>
                        <p class="text-xs text-green-700 mb-3">
                            Need assistance during testing? Our support team is available 24/7.
                        </p>
                        <div class="space-y-2 text-xs">
                            <div class="flex items-center text-green-700">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>+254 700 123 456</span>
                            </div>
                            <div class="flex items-center text-green-700">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>support@agro.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

@include('layouts.mobile-footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('understand-checkbox');
    const proceedBtn = document.getElementById('proceed-btn');
    
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            proceedBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
            proceedBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-green-500');
            proceedBtn.href = proceedBtn.dataset.href;
        } else {
            proceedBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            proceedBtn.classList.remove('bg-green-600', 'hover:bg-green-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-green-500');
            proceedBtn.href = '#';
        }
    });
});
</script>
@endsection