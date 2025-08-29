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
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Equipment Vendors</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Available Equipment Vendors</h1>
                        <p class="text-gray-600">Find nearby agro-vets and extension offices with available soil testing kits for <strong>{{ $farm->name }}</strong></p>
                    </div>

                    <!-- Farm Info Card -->
                    <div class="bg-white rounded-lg shadow mb-6 p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $farm->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $farm->location_name }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Farm Size</p>
                                <p class="font-semibold text-gray-800">{{ number_format($farm->size_hectares ?? 0, 1) }}ha</p>
                            </div>
                        </div>
                    </div>

                    @if($availableVendors->count() > 0)
                        <!-- Map View Toggle -->
                        <div class="mb-6 flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ $availableVendors->count() }} Vendor(s) Available
                            </h2>
                            <div class="flex space-x-2">
                                <button id="list-view-btn" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    List View
                                </button>
                                <button id="map-view-btn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
                                    </svg>
                                    Map View
                                </button>
                            </div>
                        </div>

                        <!-- List View -->
                        <div id="list-view" class="space-y-6">
                            @foreach($availableVendors as $vendor)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="flex-1">
                                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $vendor->name }}</h3>
                                                <div class="flex items-center text-gray-600 mb-2">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span>{{ $vendor->location_name }}</span>
                                                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                                        {{ number_format($vendor->distance, 1) }}km away
                                                    </span>
                                                </div>
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                    <span>{{ $vendor->contact }}</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-sm text-green-600 font-medium">{{ $vendor->availableKits->count() }} Kit(s) Available</span>
                                                </div>
                                                <p class="text-xs text-gray-500">Last updated: {{ now()->diffForHumans() }}</p>
                                            </div>
                                        </div>

                                        <!-- Available Kits -->
                                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                            <h4 class="font-medium text-gray-700 mb-2">Available Testing Kits:</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                @foreach($vendor->availableKits as $kit)
                                                    <div class="flex items-center text-sm text-gray-600">
                                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span>Kit #{{ $kit->serial_no }}</span>
                                                        <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Available</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Pricing Information -->
                                        <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                            <h4 class="font-medium text-blue-800 mb-2">Chemical Soil Test Pricing:</h4>
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <span class="text-blue-700">Base Test Fee:</span>
                                                    <span class="font-semibold text-blue-900">KES 2,000</span>
                                                </div>
                                                <div>
                                                    <span class="text-blue-700">Per Sample Location:</span>
                                                    <span class="font-semibold text-blue-900">KES 500</span>
                                                </div>
                                                <div class="col-span-2 pt-2 border-t border-blue-200">
                                                    <span class="text-blue-700">Estimated Total for {{ $farm->name }}:</span>
                                                    @php
                                                        $farmSize = $farm->size_hectares ?? 0;
                                                        $sampleCount = $farmSize <= 1 ? 3 : ($farmSize <= 5 ? 5 : ($farmSize <= 10 ? 8 : min(12, ceil($farmSize / 2))));
                                                        $subtotal = 2000 + ($sampleCount * 500);
                                                        $tax = $subtotal * 0.16;
                                                        $total = $subtotal + $tax;
                                                    @endphp
                                                    <span class="font-bold text-blue-900">KES {{ number_format($total) }}</span>
                                                    <span class="text-xs text-blue-600">({{ $sampleCount }} samples + 16% VAT)</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <div class="flex justify-between items-center">
                                            <button onclick="showVendorDetails({{ $vendor->id }})" 
                                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View Details
                                            </button>
                                            <a href="{{ route('chemical-soil.booking', ['farm_id' => $farm->id, 'vendor_id' => $vendor->id]) }}" 
                                               class="inline-flex items-center px-6 py-2 bg-green-600 text-white font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0v7m-3-9h6m2 5h.01"></path>
                                                </svg>
                                                Book This Vendor
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Map View (Hidden by default) -->
                        <div id="map-view" class="hidden">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div id="vendors-map" style="height: 500px;" class="w-full">
                                    <!-- Map will be initialized here -->
                                </div>
                                <div class="p-4 bg-gray-50 border-t">
                                    <p class="text-sm text-gray-600">
                                        <strong>Green markers:</strong> Available vendors | 
                                        <strong>Blue marker:</strong> Your farm location
                                    </p>
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- No Vendors Available -->
                        <div class="bg-white rounded-lg shadow-md p-8 text-center">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Vendors Available</h3>
                            <p class="text-gray-600 mb-6">
                                Unfortunately, there are no soil testing equipment vendors with available kits within 50km of your farm location.
                            </p>
                            
                            <!-- Alternative Options -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                                <div class="bg-blue-50 rounded-lg p-6">
                                    <svg class="mx-auto h-8 w-8 text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h4 class="font-medium text-blue-800 mb-2">Request New Vendor</h4>
                                    <p class="text-sm text-blue-700 mb-4">Submit a request to add nearby agro-vets to our network</p>
                                    <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Submit Request
                                    </button>
                                </div>
                                
                                <div class="bg-yellow-50 rounded-lg p-6">
                                    <svg class="mx-auto h-8 w-8 text-yellow-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h4 class="font-medium text-yellow-800 mb-2">Check Back Later</h4>
                                    <p class="text-sm text-yellow-700 mb-4">Vendors may have kits available in the coming days</p>
                                    <button class="px-4 py-2 bg-yellow-600 text-white text-sm rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                        Set Alert
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="{{ route('chemical-soil.test-guide', ['farm_id' => $farm->id]) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Test Guide
                        </a>
                    </div>
                </div>
            </main>

            <!-- Right Sidebar -->
            <nav class="flex w-80 h-full hidden lg:block bg-white border-l">
                <div class="w-full p-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-green-800 mb-3">Vendor Selection Tips</h3>
                        <ul class="text-xs text-green-700 space-y-2">
                            <li class="flex items-start">
                                <svg class="w-3 h-3 text-green-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Choose closest vendor to minimize travel time</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-3 h-3 text-green-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Confirm available dates before booking</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-3 h-3 text-green-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Contact vendor directly if you have questions</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-3 h-3 text-green-600 mt-1 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>All listed vendors are verified partners</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-blue-800 mb-3">What's Included</h3>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>• Chemical testing device</li>
                            <li>• pH testing kit</li>
                            <li>• Nutrient analysis strips</li>
                            <li>• GPS location device</li>
                            <li>• Sampling tools and containers</li>
                            <li>• Instruction manual</li>
                            <li>• Technical support</li>
                        </ul>
                    </div>
                    
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-yellow-800 mb-3">Need Help?</h3>
                        <div class="space-y-2 text-xs text-yellow-700">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>+254 700 123 456</span>
                            </div>
                            <div class="flex items-center">
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
    const listViewBtn = document.getElementById('list-view-btn');
    const mapViewBtn = document.getElementById('map-view-btn');
    const listView = document.getElementById('list-view');
    const mapView = document.getElementById('map-view');

    // View toggle functionality
    listViewBtn.addEventListener('click', function() {
        showListView();
    });

    mapViewBtn.addEventListener('click', function() {
        showMapView();
    });

    function showListView() {
        listView.classList.remove('hidden');
        mapView.classList.add('hidden');
        
        listViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
        listViewBtn.classList.add('bg-green-600', 'text-white');
        
        mapViewBtn.classList.remove('bg-green-600', 'text-white');
        mapViewBtn.classList.add('bg-gray-200', 'text-gray-700');
    }

    function showMapView() {
        listView.classList.add('hidden');
        mapView.classList.remove('hidden');
        
        mapViewBtn.classList.remove('bg-gray-200', 'text-gray-700');
        mapViewBtn.classList.add('bg-green-600', 'text-white');
        
        listViewBtn.classList.remove('bg-green-600', 'text-white');
        listViewBtn.classList.add('bg-gray-200', 'text-gray-700');
        
        // Initialize map when switching to map view
        initializeMap();
    }

    // Mock vendor details modal
    window.showVendorDetails = function(vendorId) {
        alert('Vendor details modal would open here for vendor ID: ' + vendorId);
        // In production, this would open a modal with detailed vendor information
    };

    // Initialize map (you woul