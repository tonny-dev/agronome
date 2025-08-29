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
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Chemical Soil Testing Dashboard</h1>
                        <p class="text-gray-600">Conduct guided chemical soil tests and analyze results for better farming decisions</p>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Tests</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_tests'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Completed</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $stats['completed_tests'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">In Progress</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $stats['in_progress'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Avg Farm Size</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ number_format($stats['avg_farm_size'], 1) }}ha</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800">Start New Chemical Soil Test</h2>
                        </div>
                        <div class="p-6">
                            @if($farms->count() > 0)
                                <form action="{{ route('chemical-soil.select-farm') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Farm Selection -->
                                        <div>
                                            <label for="farm_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                Select Farm <span class="text-red-500">*</span>
                                            </label>
                                            <select name="farm_id" id="farm_id" required 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                                <option value="">Choose a farm...</option>
                                                @foreach($farms as $farm)
                                                    <option value="{{ $farm->id }}" data-fields="{{ $farm->fields->toJson() }}" 
                                                            data-size="{{ $farm->size_hectares }}" 
                                                            data-location="{{ $farm->location_name }}">
                                                        {{ $farm->name }} ({{ number_format($farm->size_hectares, 1) }}ha)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('farm_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Field Selection (for mixed farming) -->
                                        <div>
                                            <label for="field_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                Select Field (Optional)
                                            </label>
                                            <select name="field_id" id="field_id" 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                                <option value="">Select field (for mixed farming only)</option>
                                            </select>
                                            <p class="mt-1 text-xs text-gray-500">Only applicable for mixed farming systems</p>
                                            @error('field_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Farm Details Display -->
                                    <div id="farm-details" class="hidden mt-6 p-4 bg-gray-50 rounded-md">
                                        <h3 class="text-sm font-medium text-gray-700 mb-2">Farm Details:</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                            <div>
                                                <span class="font-medium">Location:</span>
                                                <span id="farm-location" class="text-gray-600"></span>
                                            </div>
                                            <div>
                                                <span class="font-medium">Size:</span>
                                                <span id="farm-size" class="text-gray-600"></span>
                                            </div>
                                            <div>
                                                <span class="font-medium">Estimated Samples:</span>
                                                <span id="estimated-samples" class="text-gray-600"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-start">
                                        <button type="submit" 
                                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                            Proceed to Chemical Test
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0a2 2 0 01-2 2H7a2 2 0 01-2-2m14 0V9a2 2 0 00-2-2H7a2 2 0 00-2-2v12"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No farms registered</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by registering your first farm.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('farmer.farmer_dashboard') }}" 
                                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Register Farm
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Tests -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Soil Tests</h2>
                        </div>
                        <div class="overflow-x-auto">
                            @if($soilTests->count() > 0)
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Farm
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Test Date
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Vendor
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($soilTests as $test)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $test->farm->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $test->farm->location_name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusColors = [
                                                            'draft' => 'bg-gray-100 text-gray-800',
                                                            'booked' => 'bg-blue-100 text-blue-800',
                                                            'paid' => 'bg-green-100 text-green-800',
                                                            'picked_up' => 'bg-yellow-100 text-yellow-800',
                                                            'testing' => 'bg-purple-100 text-purple-800',
                                                            'awaiting_return' => 'bg-orange-100 text-orange-800',
                                                            'returned' => 'bg-indigo-100 text-indigo-800',
                                                            'analysis_unlocked' => 'bg-green-100 text-green-800',
                                                            'cancelled' => 'bg-red-100 text-red-800',
                                                        ];
                                                    @endphp
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$test->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                        {{ ucfirst(str_replace('_', ' ', $test->status)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $test->pickup_at ? $test->pickup_at->format('M d, Y') : 'Not scheduled' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $test->vendor->name ?? 'Not assigned' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    @if($test->status === 'paid' && $test->canPickup())
                                                        <a href="{{ route('chemical-soil.confirmation', $test) }}" 
                                                           class="text-green-600 hover:text-green-900">Pickup Ready</a>
                                                    @elseif($test->status === 'picked_up' || $test->status === 'testing')
                                                        <a href="{{ route('chemical-soil.testing', $test) }}" 
                                                           class="text-purple-600 hover:text-purple-900">Continue Testing</a>
                                                    @elseif($test->status === 'awaiting_return')
                                                        <a href="{{ route('chemical-soil.return', $test) }}" 
                                                           class="text-orange-600 hover:text-orange-900">Return Kit</a>
                                                    @elseif($test->status === 'analysis_unlocked')
                                                        <a href="{{ route('chemical-soil.results', $test) }}" 
                                                           class="text-blue-600 hover:text-blue-900">View Results</a>
                                                    @else
                                                        <a href="{{ route('chemical-soil.confirmation', $test) }}" 
                                                           class="text-gray-600 hover:text-gray-900">View Details</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <!-- Pagination -->
                                <div class="px-6 py-4 border-t border-gray-200">
                                    {{ $soilTests->links() }}
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No soil tests yet</h3>
                                    <p class="mt-1 text-sm text-gray-500">Start your first chemical soil test to get detailed soil analysis.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>

            <!-- Right Sidebar -->
            <nav class="flex w-80 h-full hidden lg:block bg-white border-l">
                <div class="w-full p-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <h3 class="text-sm font-semibold text-green-800 mb-2">Chemical Soil Testing Guide</h3>
                        <ul class="text-xs text-green-700 space-y-1">
                            <li>• Select your farm for soil testing</li>
                            <li>• Choose chemical test type for detailed analysis</li>
                            <li>• Find nearby vendors with available testing kits</li>
                            <li>• Book convenient pickup and return dates</li>
                            <li>• Complete payment to confirm booking</li>
                            <li>• Pickup kit and follow guided testing process</li>
                            <li>• Return kit for professional analysis</li>
                            <li>• Receive detailed soil health reports</li>
                        </ul>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-blue-800 mb-2">Benefits of Chemical Testing</h3>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li>• Accurate pH and nutrient analysis</li>
                            <li>• Precise fertilizer recommendations</li>
                            <li>• Soil health monitoring over time</li>
                            <li>• Improved crop yield potential</li>
                            <li>• Cost-effective input management</li>
                            <li>• Environmental sustainability</li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

@include('layouts.mobile-footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const farmSelect = document.getElementById('farm_id');
    const fieldSelect = document.getElementById('field_id');
    const farmDetails = document.getElementById('farm-details');
    const farmLocation = document.getElementById('farm-location');
    const farmSize = document.getElementById('farm-size');
    const estimatedSamples = document.getElementById('estimated-samples');

    farmSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            const fields = JSON.parse(selectedOption.dataset.fields || '[]');
            const size = parseFloat(selectedOption.dataset.size);
            const location = selectedOption.dataset.location;
            
            // Update field options
            fieldSelect.innerHTML = '<option value="">Select field (for mixed farming only)</option>';
            fields.forEach(field => {
                const option = document.createElement('option');
                option.value = field.id;
                option.textContent = `${field.name} (${field.size_hectares}ha)`;
                fieldSelect.appendChild(option);
            });
            
            // Calculate estimated samples
            let samples = 3;
            if (size <= 1) samples = 3;
            else if (size <= 5) samples = 5;
            else if (size <= 10) samples = 8;
            else samples = Math.min(12, Math.ceil(size / 2));
            
            // Update farm details
            farmLocation.textContent = location || 'Not specified';
            farmSize.textContent = `${size}ha`;
            estimatedSamples.textContent = `${samples} locations`;
            
            farmDetails.classList.remove('hidden');
        } else {
            fieldSelect.innerHTML = '<option value="">Select field (for mixed farming only)</option>';
            farmDetails.classList.add('hidden');
        }
    });

    fieldSelect.addEventListener('change', function() {
        const selectedField = this.options[this.selectedIndex];
        
        if (selectedField.value && selectedField.textContent.includes('(') && selectedField.textContent.includes('ha)')) {
            const sizeMatch = selectedField.textContent.match(/\(([\d.]+)ha\)/);
            if (sizeMatch) {
                const fieldSize = parseFloat(sizeMatch[1]);
                
                // Recalculate samples for field
                let samples = 3;
                if (fieldSize <= 1) samples = 3;
                else if (fieldSize <= 5) samples = 5;
                else if (fieldSize <= 10) samples = 8;
                else samples = Math.min(12, Math.ceil(fieldSize / 2));
                
                farmSize.textContent = `${fieldSize}ha (field)`;
                estimatedSamples.textContent = `${samples} locations`;
            }
        } else if (farmSelect.value) {
            // Revert to farm size
            const selectedFarm = farmSelect.options[farmSelect.selectedIndex];
            const farmSizeValue = parseFloat(selectedFarm.dataset.size);
            
            let samples = 3;
            if (farmSizeValue <= 1) samples = 3;
            else if (farmSizeValue <= 5) samples = 5;
            else if (farmSizeValue <= 10) samples = 8;
            else samples = Math.min(12, Math.ceil(farmSizeValue / 2));
            
            farmSize.textContent = `${farmSizeValue}ha`;
            estimatedSamples.textContent = `${samples} locations`;
        }
    });
});
</script>
@endsection