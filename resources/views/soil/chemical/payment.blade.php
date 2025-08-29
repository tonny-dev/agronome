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
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Payment</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a4 4 0 01-4 4z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">Complete Your Payment</h1>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Review your booking details and complete payment to confirm your chemical soil test
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Payment Form -->
                        <div class="lg:col-span-2">
                            <!-- Booking Summary -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                                    <h2 class="text-xl font-semibold text-blue-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Booking Summary
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Test Details -->
                                        <div>
                                            <h3 class="font-semibold text-gray-800 mb-3">Test Details</h3>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Test Type:</span>
                                                    <span class="font-medium text-gray-900">Chemical Analysis</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Farm:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->farm->name }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Location:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->farm->location_name }}</span>
                                                </div>
                                                @if($soilTest->field)
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Field:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->field->name }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Schedule -->
                                        <div>
                                            <h3 class="font-semibold text-gray-800 mb-3">Schedule</h3>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Pickup Date:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->pickup_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Testing Date:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->testing_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Drop-off Date:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->dropoff_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Duration:</span>
                                                    <span class="font-medium text-gray-900">{{ $soilTest->dropoff_at->diffInDays($soilTest->pickup_at) + 1 }} days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Vendor Information -->
                                    <div class="mt-6 pt-6 border-t border-gray-200">
                                        <h3 class="font-semibold text-gray-800 mb-3">Equipment Vendor</h3>
                                        <div class="flex items-center">
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-900">{{ $soilTest->vendor->name }}</div>
                                                <div class="text-sm text-gray-600">{{ $soilTest->vendor->location_name }}</div>
                                                <div class="text-sm text-gray-600">{{ $soilTest->vendor->contact }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-sm text-green-600 font-medium">Kit: {{ $soilTest->kit->serial_no }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method Selection -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                                    <h2 class="text-xl font-semibold text-green-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Payment Method
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <form id="payment-form" action="{{ route('chemical-soil.process-payment', $soilTest) }}" method="POST">
                                        @csrf
                                        
                                        <!-- Payment Method Selection -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                                Choose Payment Method <span class="text-red-500">*</span>
                                            </label>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <!-- M-Pesa -->
                                                <div class="border rounded-lg p-4 cursor-pointer hover:border-green-500 hover:bg-green-50 transition-colors payment-method" data-method="mpesa">
                                                    <div class="flex items-center mb-3">
                                                        <input type="radio" id="mpesa" name="payment_method" value="mpesa" class="mr-3">
                                                        <label for="mpesa" class="flex items-center cursor-pointer">
                                                            <img src="{{ asset('images/mpesa-logo.png') }}" alt="M-Pesa" class="w-8 h-8 mr-2" onerror="this.style.display='none'">
                                                            <span class="font-semibold text-gray-800">M-Pesa</span>
                                                        </label>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Pay securely using your M-Pesa mobile money account</p>
                                                    <div class="mt-2 text-xs text-green-600">
                                                        • Instant payment confirmation
                                                        • Secure transaction
                                                        • No extra charges
                                                    </div>
                                                </div>

                                                <!-- Airtel Money -->
                                                <div class="border rounded-lg p-4 cursor-pointer hover:border-red-500 hover:bg-red-50 transition-colors payment-method" data-method="airtel">
                                                    <div class="flex items-center mb-3">
                                                        <input type="radio" id="airtel" name="payment_method" value="airtel" class="mr-3">
                                                        <label for="airtel" class="flex items-center cursor-pointer">
                                                            <img src="{{ asset('images/airtel-logo.png') }}" alt="Airtel Money" class="w-8 h-8 mr-2" onerror="this.style.display='none'">
                                                            <span class="font-semibold text-gray-800">Airtel Money</span>
                                                        </label>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Pay using your Airtel Money mobile account</p>
                                                    <div class="mt-2 text-xs text-red-600">
                                                        • Fast processing
                                                        • Secure payment gateway
                                                        • Mobile convenience
                                                    </div>
                                                </div>
                                            </div>
                                            @error('payment_method')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Phone Number Input -->
                                        <div class="mb-6">
                                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                                                Mobile Phone Number <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                                    <span class="text-gray-500 sm:text-sm">+254</span>
                                                </div>
                                                <input type="tel" 
                                                       id="phone_number" 
                                                       name="phone_number" 
                                                       value="{{ old('phone_number', substr(auth()->user()->mobile ?? '', -9)) }}"
                                                       required 
                                                       pattern="[0-9]{9}"
                                                       placeholder="7XXXXXXXX"
                                                       class="block w-full pl-12 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            </div>
                                            <p class="mt-1 text-xs text-gray-500">
                                                Enter your 9-digit mobile number (without +254)
                                            </p>
                                            @error('phone_number')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Terms and Conditions -->
                                        <div class="mb-6">
                                            <div class="flex items-start">
                                                <input type="checkbox" 
                                                       id="accept_terms" 
                                                       name="accept_terms" 
                                                       required
                                                       class="mt-1 rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                                <label for="accept_terms" class="ml-2 text-sm text-gray-700">
                                                    I agree to the 
                                                    <a href="#" class="text-green-600 hover:text-green-800 underline">Terms and Conditions</a> 
                                                    and 
                                                    <a href="#" class="text-green-600 hover:text-green-800 underline">Payment Policy</a>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Security Notice -->
                                        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                            <div class="flex">
                                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                <div>
                                                    <h4 class="text-sm font-semibold text-blue-800 mb-1">Secure Payment</h4>
                                                    <p class="text-xs text-blue-700">
                                                        Your payment information is encrypted and secure. You will receive an SMS prompt on your mobile device to authorize the payment.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="flex justify-between">
                                            <a href="{{ route('chemical-soil.booking', ['farm_id' => $soilTest->farm->id, 'vendor_id' => $soilTest->vendor->id]) }}" 
                                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                                Back to Booking
                                            </a>
                                            
                                            <button type="submit" 
                                                    id="process-payment-btn"
                                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a4 4 0 01-4 4z"></path>
                                                </svg>
                                                Process Payment - KES {{ number_format($soilTest->total_price) }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Order Summary -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-800">Order Summary</h3>
                                </div>
                                <div class="p-4">
                                    @php
                                        $farmSize = $soilTest->field ? $soilTest->field->size_hectares : $soilTest->farm->size_hectares;
                                        $sampleCount = $soilTest->samplingPlan ? $soilTest->samplingPlan->sample_count : ($farmSize <= 1 ? 3 : ($farmSize <= 5 ? 5 : ($farmSize <= 10 ? 8 : min(12, ceil($farmSize / 2)))));
                                        $basePrice = 2000;
                                        $perSamplePrice = 500;
                                        $subtotal = $basePrice + ($sampleCount * $perSamplePrice);
                                        $tax = $subtotal * 0.16;
                                        $total = $subtotal + $tax;
                                    @endphp
                                    
                                    <div class="space-y-3 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Chemical Test (Base)</span>
                                            <span class="font-medium text-gray-900">KES {{ number_format($basePrice) }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Sample Locations ({{ $sampleCount }})</span>
                                            <span class="font-medium text-gray-900">KES {{ number_format($sampleCount * $perSamplePrice) }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Subtotal</span>
                                                <span class="font-medium text-gray-900">KES {{ number_format($subtotal) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">VAT (16%)</span>
                                                <span class="font-medium text-gray-900">KES {{ number_format($tax) }}</span>
                                            </div>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3">
                                            <div class="flex justify-between">
                                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                                <span class="text-lg font-bold text-green-600">KES {{ number_format($total) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                        <p class="text-xs text-green-700">
                                            <strong>Money-back guarantee:</strong> Full refund if testing equipment fails diagnostics
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Security -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-blue-50">
                                    <h3 class="text-lg font-semibold text-blue-800">Payment Security</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3">
                                        <div class="flex items-center text-sm text-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            <span>SSL Encrypted Payment</span>
                                        </div>
                                        <div class="flex items-center text-sm text-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span>PCI DSS Compliant</span>
                                        </div>
                                        <div class="flex items-center text-sm text-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>No Card Details Stored</span>
                                        </div>
                                        <div class="flex items-center text-sm text-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>SMS Payment Confirmation</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Support -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-4 py-3 border-b border-gray-200 bg-yellow-50">
                                    <h3 class="text-lg font-semibold text-yellow-800">Need Help?</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-3 text-sm">
                                        <div class="flex items-center text-yellow-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <span>+254 700 123 456</span>
                                        </div>
                                        <div class="flex items-center text-yellow-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>support@agro.com</span>
                                        </div>
                                        <div class="mt-3 text-xs text-yellow-600">
                                            Payment support available 24/7
                                        </div>
                                    
