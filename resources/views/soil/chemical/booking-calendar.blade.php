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
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Book Testing Dates</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Book Your Chemical Soil Test</h1>
                        <p class="text-gray-600">Select your preferred pickup and testing dates with <strong>{{ $vendor->name }}</strong></p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Booking Details Card -->
                        <div class="lg:col-span-2">
                            <!-- Vendor Summary -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                                    <h2 class="text-xl font-semibold text-green-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0a2 2 0 01-2 2H7a2 2 0 01-2-2m14 0V9a2 2 0 00-2-2H7a2 2 0 00-2-2v12"></path>
                                        </svg>
                                        Selected Vendor
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $vendor->name }}</h3>
                                            <div class="space-y-2 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span>{{ $vendor->location_name }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                    <span>{{ $vendor->contact }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-5 h-5 text-green-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-sm text-green-600 font-medium">{{ $vendor->availableKits->count() }} Kit(s) Available</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendar -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                                    <h2 class="text-xl font-semibold text-blue-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0v7m-3-9h6m-4 4l4 4 4-4"></path>
                                        </svg>
                                        Select Pickup Date
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <form id="booking-form" action="{{ route('chemical-soil.create-booking') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="farm_id" value="{{ $farm->id }}">
                                        <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                                        @if(request('field_id'))
                                            <input type="hidden" name="field_id" value="{{ request('field_id') }}">
                                        @endif
                                        
                                        <!-- Date Selection -->
                                        <div class="mb-6">
                                            <label for="pickup_date" class="block text-sm font-medium text-gray-700 mb-3">
                                                Choose Pickup Date <span class="text-red-500">*</span>
                                            </label>
                                            <div id="calendar-container" class="border rounded-lg">
                                                <!-- Calendar will be rendered here -->
                                            </div>
                                            <input type="hidden" id="pickup_date" name="pickup_date" required>
                                            @error('pickup_date')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Date Summary -->
                                        <div id="date-summary" class="hidden mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                            <h3 class="font-medium text-green-800 mb-3">Test Schedule Summary:</h3>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                                <div>
                                                    <span class="font-medium text-green-700">Pickup Date:</span>
                                                    <div id="pickup-date-display" class="text-green-900"></div>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-green-700">Testing Date:</span>
                                                    <div id="testing-date-display" class="text-green-900"></div>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-green-700">Drop-off Date:</span>
                                                    <div id="dropoff-date-display" class="text-green-900"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Allow Extra Day Option -->
                                        <div class="mb-6">
                                            <div class="flex items-center">
                                                <input type="checkbox" id="allow_extra_day" name="allow_extra_day" value="1"
                                                       class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                                <label for="allow_extra_day" class="ml-2 text-sm text-gray-700">
                                                    Allow an extra day for testing (recommended for larger farms)
                                                </label>
                                            </div>
                                            <p class="mt-1 text-xs text-gray-500">
                                                This extends your drop-off date by one day, providing buffer time for comprehensive testing
                                            </p>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="flex justify-between">
                                            <a href="{{ route('chemical-soil.vendors', ['farm_id' => $farm->id]) }}" 
                                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                                Back to Vendors
                                            </a>
                                            
                                            <button type="submit" id="confirm-booking-btn" disabled
                                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-400 cursor-not-allowed transition duration-150 ease-in-out">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Confirm Booking & Proceed to Payment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Summary Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Farm Details -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-800">Farm Details</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">Farm:</span>
                                            <div class="text-gray-900">{{ $farm->name }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Location:</span>
                                            <div class="text-gray-900">{{ $farm->location_name }}</div>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Size:</span>
                                            <div class="text-gray-900">{{ number_format($farm->size_hectares ?? 0, 1) }} hectares</div>
                                        </div>
                                        @php
                                            $farmSize = $farm->size_hectares ?? 0;
                                            $sampleCount = $farmSize <= 1 ? 3 : ($farmSize <= 5 ? 5 : ($farmSize <= 10 ? 8 : min(12, ceil($farmSize / 2))));
                                        @endphp
                                        <div>
                                            <span class="font-medium text-gray-700">Sample Locations:</span>
                                            <div class="text-gray-900">{{ $sampleCount }} locations</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Breakdown -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-blue-50">
                                    <h3 class="text-lg font-semibold text-blue-800">Pricing Breakdown</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Base Test Fee</span>
                                            <span class="font-medium text-gray-900">KES {{ number_format($pricing['base_price']) }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Sample Locations ({{ $pricing['sample_count'] }})</span>
                                            <span class="font-medium text-gray-900">KES {{ number_format($pricing['sample_count'] * $pricing['per_sample_price']) }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Subtotal</span>
                                                <span class="font-medium text-gray-900">KES {{ number_format($pricing['subtotal']) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">VAT (16%)</span>
                                                <span class="font-medium text-gray-900">KES {{ number_format($pricing['tax']) }}</span>
                                            </div>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3">
                                            <div class="flex justify-between">
                                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                                <span class="text-lg font-bold text-green-600">KES {{ number_format($pricing['total']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testing Timeline -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-4 py-3 border-b border-gray-200 bg-yellow-50">
                                    <h3 class="text-lg font-semibold text-yellow-800">4-Day Testing Process</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-blue-600">1</span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Pickup Day</h4>
                                                <p class="text-xs text-gray-600">Collect testing kit from vendor</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-green-600">2</span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Testing Day</h4>
                                                <p class="text-xs text-gray-600">Conduct soil tests on farm</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-purple-600">3</span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Return Day</h4>
                                                <p class="text-xs text-gray-600">Return kit for diagnostics</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                    <span class="text-sm font-bold text-yellow-600">4</span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Results Ready</h4>
                                                <p class="text-xs text-gray-600">Detailed analysis available</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

@include('layouts.mobile-footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    const unavailableDates = @json($unavailableDates);
    const pickupDateInput = document.getElementById('pickup_date');
    const dateSummary = document.getElementById('date-summary');
    const confirmBtn = document.getElementById('confirm-booking-btn');
    const allowExtraDay = document.getElementById('allow_extra_day');
    
    // Initialize calendar
    const calendarContainer = document.getElementById('calendar-container');
    let selectedDate = null;
    
    function initializeCalendar() {
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();
        
        renderCalendar(currentYear, currentMonth);
    }
    
    function renderCalendar(year, month) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDay = firstDay.getDay();
        
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        let calendarHTML = `
            <div class="calendar-header flex justify-between items-center p-4 bg-gray-50 border-b">
                <button type="button" onclick="previousMonth()" class="p-2 hover:bg-gray-200 rounded">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h2 class="text-lg font-semibold">${monthNames[month]} ${year}</h2>
                <button type="button" onclick="nextMonth()" class="p-2 hover:bg-gray-200 rounded">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
            <div class="calendar-grid">
                <div class="grid grid-cols-7 gap-1 p-4">
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Sun</div>
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Mon</div>
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Tue</div>
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Wed</div>
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Thu</div>
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Fri</div>
                    <div class="text-center text-sm font-medium text-gray-700 py-2">Sat</div>
        `;
        
        // Empty cells for days before month starts
        for (let i = 0; i < startingDay; i++) {
            calendarHTML += '<div class="p-2"></div>';
        }
        
        // Days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const currentDate = new Date(year, month, day);
            const dateString = currentDate.toISOString().split('T')[0];
            const isPast = currentDate <= today;
            const isUnavailable = unavailableDates.includes(dateString);
            const isSelected = selectedDate === dateString;
            
            let classes = 'p-3 text-center cursor-pointer rounded text-sm ';
            
            if (isPast) {
                classes += 'text-gray-400 cursor-not-allowed';
            } else if (isUnavailable) {
                classes += 'text-red-500 bg-red-100 cursor-not-allowed';
            } else if (isSelected) {
                classes += 'bg-green-600 text-white font-bold';
            } else {
                classes += 'hover:bg-green-100 text-gray-700';
            }
            
            const clickHandler = (!isPast && !isUnavailable) ? `onclick="selectDate('${dateString}')"` : '';
            
            calendarHTML += `<div class="${classes}" ${clickHandler}>${day}</div>`;
        }
        
        calendarHTML += '</div></div>';
        calendarContainer.innerHTML = calendarHTML;
    }
    
    // Make functions global
    window.selectDate = function(dateString) {
        selectedDate = dateString;
        pickupDateInput.value = dateString;
        
        // Re-render calendar to show selection
        const date = new Date(dateString);
        renderCalendar(date.getFullYear(), date.getMonth());
        
        // Update date summary
        updateDateSummary(dateString);
        
        // Enable submit button
        confirmBtn.disabled = false;
        confirmBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        confirmBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-green-500');
    };
    
    let currentCalendarMonth = today.getMonth();
    let currentCalendarYear = today.getFullYear();
    
    window.previousMonth = function() {
        currentCalendarMonth--;
        if (currentCalendarMonth < 0) {
            currentCalendarMonth = 11;
            currentCalendarYear--;
        }
        renderCalendar(currentCalendarYear, currentCalendarMonth);
    };
    
    window.nextMonth = function() {
        currentCalendarMonth++;
        if (currentCalendarMonth > 11) {
            currentCalendarMonth = 0;
            currentCalendarYear++;
        }
        renderCalendar(currentCalendarYear, currentCalendarMonth);
    };
    
    function updateDateSummary(pickupDateString) {
        const pickupDate = new Date(pickupDateString);
        const testingDate = new Date(pickupDate);
        testingDate.setDate(testingDate.getDate() + 1);
        
        const dropoffDate = new Date(testingDate);
        dropoffDate.setDate(dropoffDate.getDate() + (allowExtraDay.checked ? 2 : 1));
        
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        
        document.getElementById('pickup-date-display').textContent = pickupDate.toLocaleDateString('en-US', options);
        document.getElementById('testing-date-display').textContent = testingDate.toLocaleDateString('en-US', options);
        document.getElementById('dropoff-date-display').textContent = dropoffDate.toLocaleDateString('en-US', options);
        
        dateSummary.classList.remove('hidden');
    }
    
    // Handle extra day checkbox
    allowExtraDay.addEventListener('change', function() {
        if (selectedDate) {
            updateDateSummary(selectedDate);
        }
    });
    
    // Form validation
    document.getElementById('booking-form').addEventListener('submit', function(e) {
        if (!selectedDate) {
            e.preventDefault();
            alert('Please select a pickup date');
            return;
        }
        
        // Show loading state
        confirmBtn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.