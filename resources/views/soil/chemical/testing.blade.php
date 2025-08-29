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
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">Chemical Soil Testing</h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Follow the guided testing process for <strong>{{ $soilTest->farm->name }}</strong>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Testing Interface -->
                        <div class="lg:col-span-2">
                            <!-- Test Progress -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                                    <div class="flex justify-between items-center">
                                        <h2 class="text-xl font-semibold text-blue-800 flex items-center">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            Testing Progress
                                        </h2>
                                        <div class="text-right">
                                            @php
                                                $completedLocations = $soilTest->sampleLocations()->where('status', 'completed')->count();
                                                $totalLocations = $soilTest->sampleLocations()->count();
                                                $progressPercentage = $totalLocations > 0 ? ($completedLocations / $totalLocations) * 100 : 0;
                                            @endphp
                                            <div class="text-sm text-blue-600 font-medium">
                                                {{ $completedLocations }} of {{ $totalLocations }} locations completed
                                            </div>
                                            <div class="text-xs text-blue-500">
                                                {{ number_format($progressPercentage, 0) }}% Complete
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="w-full bg-blue-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $progressPercentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">Testing Date:</span>
                                            <div class="text-gray-900">{{ $soilTest->testing_at->format('M d, Y') }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Kit Serial:</span>
                                            <div class="text-gray-900">{{ $soilTest->kit->serial_no }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Test Type:</span>
                                            <div class="text-gray-900">Chemical Analysis</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Status:</span>
                                            <div class="text-green-600 font-medium">{{ ucfirst($soilTest->status) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Device Setup Guide -->
                            <div id="device-setup" class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                                    <h2 class="text-xl font-semibold text-green-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                                        </svg>
                                        Device Setup & Calibration
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-green-600">1</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800 mb-1">Power On Device</h3>
                                                <p class="text-sm text-gray-600">Turn on the soil testing device and wait for the startup sequence to complete.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-green-600">2</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800 mb-1">GPS Connection</h3>
                                                <p class="text-sm text-gray-600">Ensure GPS signal is strong (minimum 4 satellites) for accurate location recording.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-green-600">3</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="font-medium text-gray-800 mb-1">Device Calibration</h3>
                                                <p class="text-sm text-gray-600">Allow 3-5 minutes for device calibration before starting first test.</p>
                                                <button id="start-calibration" class="mt-2 px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                    Start Calibration
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="calibration-status" class="hidden mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-yellow-600 animate-spin mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            <span class="text-yellow-700 font-medium">Calibrating device...</span>
                                        </div>
                                        <div class="mt-2">
                                            <div class="w-full bg-yellow-200 rounded-full h-2">
                                                <div id="calibration-progress" class="bg-yellow-600 h-2 rounded-full transition-all duration-1000" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Locations List -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-6 py-4 border-b border-gray-200 bg-purple-50">
                                    <h2 class="text-xl font-semibold text-purple-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Sample Locations
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        @foreach($soilTest->sampleLocations as $location)
                                            <div class="sample-location border rounded-lg p-4 {{ $location->status === 'completed' ? 'bg-green-50 border-green-200' : ($location->status === 'in_progress' ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200') }}"
                                                 data-location-id="{{ $location->id }}">
                                                <div class="flex justify-between items-start mb-3">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3
                                                                    {{ $location->status === 'completed' ? 'bg-green-100 text-green-600' : ($location->status === 'in_progress' ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600') }}">
                                                            <span class="font-bold">{{ $location->seq_no }}</span>
                                                        </div>
                                                        <div>
                                                            <h3 class="font-medium text-gray-800">Sample Location {{ $location->seq_no }}</h3>
                                                            @if($location->lat && $location->lng)
                                                                <p class="text-xs text-gray-600">{{ number_format($location->lat, 6) }}, {{ number_format($location->lng, 6) }}</p>
                                                            @else
                                                                <p class="text-xs text-gray-500">GPS coordinates not set</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        @if($location->status === 'completed')
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                                Completed
                                                            </span>
                                                        @elseif($location->status === 'in_progress')
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Testing
                                                            </span>
                                                        @else
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                Pending
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Depth Testing Progress -->
                                                <div class="grid grid-cols-2 gap-3 mb-3">
                                                    <div class="depth-test" data-depth="surface">
                                                        <div class="flex items-center justify-between mb-1">
                                                            <span class="text-sm font-medium text-gray-700">Surface (0-15cm)</span>
                                                            <span class="surface-status text-xs">
                                                                @if($location->depthResults()->where('depth_type', 'surface')->exists())
                                                                    <span class="text-green-600">✓ Complete</span>
                                                                @else
                                                                    <span class="text-gray-500">Pending</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                                            <div class="surface-progress bg-blue-600 h-2 rounded-full" 
                                                                 style="width: {{ $location->depthResults()->where('depth_type', 'surface')->exists() ? '100' : '0' }}%"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="depth-test" data-depth="sub_surface_30cm">
                                                        <div class="flex items-center justify-between mb-1">
                                                            <span class="text-sm font-medium text-gray-700">30cm Depth</span>
                                                            <span class="subsurface-status text-xs">
                                                                @if($location->depthResults()->where('depth_type', 'sub_surface_30cm')->exists())
                                                                    <span class="text-green-600">✓ Complete</span>
                                                                @else
                                                                    <span class="text-gray-500">Pending</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                                            <div class="subsurface-progress bg-purple-600 h-2 rounded-full" 
                                                                 style="width: {{ $location->depthResults()->where('depth_type', 'sub_surface_30cm')->exists() ? '100' : '0' }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Action Buttons -->
                                                <div class="flex justify-between items-center">
                                                    @if($location->status === 'pending')
                                                        <button onclick="startLocationTesting({{ $location->id }})" 
                                                                class="start-test-btn px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            Start Testing
                                                        </button>
                                                    @elseif($location->status === 'in_progress')
                                                        <button onclick="showTestingInterface({{ $location->id }})" 
                                                                class="px-4 py-2 bg-yellow-600 text-white text-sm rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                                            Continue Testing
                                                        </button>
                                                    @else
                                                        <button onclick="viewResults({{ $location->id }})" 
                                                                class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                            View Results
                                                        </button>
                                                    @endif
                                                    
                                                    @if($location->lat && $location->lng)
                                                        <button onclick="showOnMap({{ $location->lat }}, {{ $location->lng }})" 
                                                                class="px-3 py-2 border border-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Complete Testing Button -->
                                    @if($soilTest->sampleLocations()->where('status', 'completed')->count() === $soilTest->sampleLocations()->count())
                                        <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                                <div class="flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <div class="text-left">
                                                        <h3 class="text-lg font-semibold text-green-800">All Locations Completed!</h3>
                                                        <p class="text-sm text-green-700">All sample locations have been tested successfully.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('chemical-soil.return', $soilTest) }}" 
                                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Proceed to Kit Return
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Test Information -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-800">Test Information</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">Farm:</span>
                                            <div class="text-gray-900">{{ $soilTest->farm->name }}</div>
                                        </div>
                                        @if($soilTest->field)
                                        <div>
                                            <span class="font-medium text-gray-700">Field:</span>
                                            <div class="text-gray-900">{{ $soilTest->field->name }}</div>
                                        </div>
                                        @endif
                                        <div>
                                            <span class="font-medium text-gray-700">Test Date:</span>
                                            <div class="text-gray-900">{{ $soilTest->testing_at->format('M d, Y') }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Vendor:</span>
                                            <div class="text-gray-900">{{ $soilTest->vendor->name }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Kit Serial:</span>
                                            <div class="text-gray-900">{{ $soilTest->kit->serial_no }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testing Guide -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-yellow-50">
                                    <h3 class="text-lg font-semibold text-yellow-800">Testing Tips</h3>
                                </div>
                                <div class="p-4">
                                    <ul class="text-xs text-yellow-700 space-y-2">
                                        <li class="flex items-start">
                                            <svg class="w-3 h-3 text-yellow-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Clean sampling tools between locations</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-3 h-3 text-yellow-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Wait for device calibration between tests</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-3 h-3 text-yellow-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Record ambient conditions for each test</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-3 h-3 text-yellow-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Ensure strong GPS signal at each location</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-3 h-3 text-yellow-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Take multiple readings for accuracy</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Emergency Contact -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-4 py-3 border-b border-gray-200 bg-red-50">
                                    <h3 class="text-lg font-semibold text-red-800">Support</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-2 text-xs">
                                        <div class="flex items-center text-red-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24