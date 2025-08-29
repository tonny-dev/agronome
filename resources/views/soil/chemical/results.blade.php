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
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">Soil Test Results</h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Comprehensive chemical analysis results for <strong>{{ $soilTest->farm->name }}</strong>
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            Test completed on {{ $soilTest->dropoff_at->format('M d, Y') }} | 
                            Kit: {{ $soilTest->kit->serial_no }} | 
                            Vendor: {{ $soilTest->vendor->name }}
                        </div>
                    </div>

                    <!-- Filter Controls -->
                    <div class="bg-white rounded-lg shadow-md mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <label for="sample-filter" class="block text-sm font-medium text-gray-700">Sample Location:</label>
                                        <select id="sample-filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                            <option value="all">All Locations</option>
                                            @foreach($soilTest->sampleLocations as $location)
                                                <option value="{{ $location->id }}">Location {{ $location->seq_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="depth-filter" class="block text-sm font-medium text-gray-700">Depth:</label>
                                        <select id="depth-filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                            <option value="all">All Depths</option>
                                            <option value="surface">Surface (0-15cm)</option>
                                            <option value="sub_surface_30cm">Sub-surface (30cm)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button id="download-report" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Download Report
                                    </button>
                                    <button id="share-results" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                        </svg>
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Results Area -->
                        <div class="lg:col-span-2">
                            <!-- Soil Health Overview -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                                    <h2 class="text-xl font-semibold text-green-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        Overall Soil Health Score
                                    </h2>
                                </div>
                                <div class="p-6">
                                    @php
                                        // Calculate average health metrics from all sample results
                                        $allResults = collect();
                                        foreach($soilTest->sampleLocations as $location) {
                                            foreach($location->depthResults as $result) {
                                                $allResults->push($result->soil_json);
                                            }
                                        }
                                        
                                        $avgPH = $allResults->avg('ph') ?? 6.5;
                                        $avgN = $allResults->avg('nitrogen') ?? 2.5;
                                        $avgP = $allResults->avg('phosphorus') ?? 15;
                                        $avgK = $allResults->avg('potassium') ?? 150;
                                        $avgOM = $allResults->avg('organic_matter') ?? 3.2;
                                        
                                        // Calculate health score (0-100)
                                        $phScore = $avgPH >= 6.0 && $avgPH <= 7.5 ? 100 : (abs(6.75 - $avgPH) > 1.5 ? 50 : 80);
                                        $nutrientScore = ($avgN > 2 ? 90 : 70) + ($avgP > 10 ? 5 : -10) + ($avgK > 100 ? 5 : -10);
                                        $omScore = $avgOM > 3 ? 95 : ($avgOM > 2 ? 80 : 60);
                                        $overallScore = ($phScore + min($nutrientScore, 100) + $omScore) / 3;
                                        
                                        $healthRating = $overallScore >= 85 ? 'Excellent' : ($overallScore >= 70 ? 'Good' : ($overallScore >= 55 ? 'Fair' : 'Poor'));
                                        $healthColor = $overallScore >= 85 ? 'green' : ($overallScore >= 70 ? 'blue' : ($overallScore >= 55 ? 'yellow' : 'red'));
                                    @endphp
                                    
                                    <div class="text-center mb-6">
                                        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full border-8 border-{{ $healthColor }}-200 bg-{{ $healthColor }}-50 mb-4">
                                            <div class="text-center">
                                                <div class="text-3xl font-bold text-{{ $healthColor }}-600">{{ number_format($overallScore, 0) }}</div>
                                                <div class="text-sm text-{{ $healthColor }}-500">out of 100</div>
                                            </div>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $healthRating }} Soil Health</h3>
                                        <p class="text-gray-600">
                                            @if($overallScore >= 85)
                                                Your soil is in excellent condition with optimal nutrient levels and pH balance.
                                            @elseif($overallScore >= 70)
                                                Your soil is in good condition with minor improvements possible.
                                            @elseif($overallScore >= 55)
                                                Your soil needs some attention to optimize crop production.
                                            @else
                                                Your soil requires significant improvement for optimal crop growth.
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Health Metrics -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                                            <div class="text-2xl font-bold text-blue-600">{{ number_format($phScore, 0) }}</div>
                                            <div class="text-sm text-blue-500">pH Balance Score</div>
                                            <div class="text-xs text-gray-600 mt-1">Current: {{ number_format($avgPH, 1) }}</div>
                                        </div>
                                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                                            <div class="text-2xl font-bold text-purple-600">{{ number_format(min($nutrientScore, 100), 0) }}</div>
                                            <div class="text-sm text-purple-500">Nutrient Score</div>
                                            <div class="text-xs text-gray-600 mt-1">N-P-K Balance</div>
                                        </div>
                                        <div class="text-center p-4 bg-green-50 rounded-lg">
                                            <div class="text-2xl font-bold text-green-600">{{ number_format($omScore, 0) }}</div>
                                            <div class="text-sm text-green-500">Organic Matter</div>
                                            <div class="text-xs text-gray-600 mt-1">{{ number_format($avgOM, 1) }}%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Analysis -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                                    <h2 class="text-xl font-semibold text-blue-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        Chemical Analysis Results
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <!-- Parameter Analysis -->
                                    <div class="space-y-6">
                                        <!-- pH Analysis -->
                                        <div class="border-l-4 border-blue-500 pl-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">pH Level</h3>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm text-gray-600">Average pH</span>
                                                <span class="font-semibold text-lg">{{ number_format($avgPH, 1) }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                @php
                                                    $phPercentage = max(0, min(100, (($avgPH - 4) / (8 - 4)) * 100));
                                                    $phColor = $avgPH >= 6.0 && $avgPH <= 7.5 ? 'bg-green-500' : 'bg-yellow-500';
                                                @endphp
                                                <div class="{{ $phColor }} h-2 rounded-full transition-all duration-300" style="width: {{ $phPercentage }}%"></div>
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                Optimal range: 6.0 - 7.5 | 
                                                Status: 
                                                <span class="font-medium {{ $avgPH >= 6.0 && $avgPH <= 7.5 ? 'text-green-600' : ($avgPH < 6.0 ? 'text-red-600' : 'text-yellow-600') }}">
                                                    {{ $avgPH >= 6.0 && $avgPH <= 7.5 ? 'Optimal' : ($avgPH < 6.0 ? 'Acidic' : 'Alkaline') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Nitrogen Analysis -->
                                        <div class="border-l-4 border-green-500 pl-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Nitrogen (N)</h3>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm text-gray-600">Average Nitrogen</span>
                                                <span class="font-semibold text-lg">{{ number_format($avgN, 1) }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                @php
                                                    $nPercentage = min(100, ($avgN / 5) * 100);
                                                    $nColor = $avgN > 2 ? 'bg-green-500' : ($avgN > 1 ? 'bg-yellow-500' : 'bg-red-500');
                                                @endphp
                                                <div class="{{ $nColor }} h-2 rounded-full transition-all duration-300" style="width: {{ $nPercentage }}%"></div>
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                Optimal range: >2% | 
                                                Status: 
                                                <span class="font-medium {{ $avgN > 2 ? 'text-green-600' : ($avgN > 1 ? 'text-yellow-600' : 'text-red-600') }}">
                                                    {{ $avgN > 2 ? 'Sufficient' : ($avgN > 1 ? 'Moderate' : 'Deficient') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Phosphorus Analysis -->
                                        <div class="border-l-4 border-purple-500 pl-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Phosphorus (P)</h3>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm text-gray-600">Available Phosphorus</span>
                                                <span class="font-semibold text-lg">{{ number_format($avgP, 0) }} ppm</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                @php
                                                    $pPercentage = min(100, ($avgP / 30) * 100);
                                                    $pColor = $avgP > 15 ? 'bg-green-500' : ($avgP > 8 ? 'bg-yellow-500' : 'bg-red-500');
                                                @endphp
                                                <div class="{{ $pColor }} h-2 rounded-full transition-all duration-300" style="width: {{ $pPercentage }}%"></div>
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                Optimal range: >15 ppm | 
                                                Status: 
                                                <span class="font-medium {{ $avgP > 15 ? 'text-green-600' : ($avgP > 8 ? 'text-yellow-600' : 'text-red-600') }}">
                                                    {{ $avgP > 15 ? 'High' : ($avgP > 8 ? 'Medium' : 'Low') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Potassium Analysis -->
                                        <div class="border-l-4 border-yellow-500 pl-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Potassium (K)</h3>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm text-gray-600">Exchangeable Potassium</span>
                                                <span class="font-semibold text-lg">{{ number_format($avgK, 0) }} ppm</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                @php
                                                    $kPercentage = min(100, ($avgK / 300) * 100);
                                                    $kColor = $avgK > 150 ? 'bg-green-500' : ($avgK > 80 ? 'bg-yellow-500' : 'bg-red-500');
                                                @endphp
                                                <div class="{{ $kColor }} h-2 rounded-full transition-all duration-300" style="width: {{ $kPercentage }}%"></div>
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                Optimal range: >150 ppm | 
                                                Status: 
                                                <span class="font-medium {{ $avgK > 150 ? 'text-green-600' : ($avgK > 80 ? 'text-yellow-600' : 'text-red-600') }}">
                                                    {{ $avgK > 150 ? 'High' : ($avgK > 80 ? 'Medium' : 'Low') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Organic Matter Analysis -->
                                        <div class="border-l-4 border-green-600 pl-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Organic Matter</h3>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm text-gray-600">Organic Matter Content</span>
                                                <span class="font-semibold text-lg">{{ number_format($avgOM, 1) }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                @php
                                                    $omPercentage = min(100, ($avgOM / 6) * 100);
                                                    $omColor = $avgOM > 3 ? 'bg-green-500' : ($avgOM > 2 ? 'bg-yellow-500' : 'bg-red-500');
                                                @endphp
                                                <div class="{{ $omColor }} h-2 rounded-full transition-all duration-300" style="width: {{ $omPercentage }}%"></div>
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                Optimal range: >3% | 
                                                Status: 
                                                <span class="font-medium {{ $avgOM > 3 ? 'text-green-600' : ($avgOM > 2 ? 'text-yellow-600' : 'text-red-600') }}">
                                                    {{ $avgOM > 3 ? 'Good' : ($avgOM > 2 ? 'Fair' : 'Poor') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location-wise Results -->
                            <div class="bg-white rounded-lg shadow-md">
                                <div class="px-6 py-4 border-b border-gray-200 bg-purple-50">
                                    <h2 class="text-xl font-semibold text-purple-800 flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Location-wise Analysis
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Depth</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">pH</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N (%)</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">P (ppm)</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">K (ppm)</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OM (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($soilTest->sampleLocations as $location)
                                                    @foreach($location->depthResults as $result)
                                                        @php
                                                            $soilData = $result->soil_json;
                                                        @endphp
                                                        <tr class="hover:bg-gray-50">
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $location->seq_no }}</td>
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $result->depth_type === 'surface' ? 'Surface' : '30cm' }}
                                                            </td>
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($soilData['ph'] ?? 6.5, 1) }}</td>
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($soilData['nitrogen'] ?? 2.5, 1) }}</td>
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($soilData['phosphorus'] ?? 15, 0) }}</td>
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($soilData['potassium'] ?? 150, 0) }}</td>
                                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($soilData['organic_matter'] ?? 3.2, 1) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Recommendations -->
                            <div class="bg-white rounded-lg shadow-md mb-6">
                                <div class="px-4 py-3 border-b border-gray-200 bg-green-50">
                                    <h3 class="text-lg font-semibold text-green-800">Recommendations</h3>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-4">
                                        <!-- pH Correction -->
                                        @if($avgPH < 6.0)
                                            <div class="border-l-4 border-red-500 pl-3">
                                                <h4 class="font-medium text-red-800">pH Correction Needed</h4>
                                                <p class="text-sm text-red-700 mt-1">Apply lime at 2-3 tons per hectare to raise pH</p>
                                                <div class="text-xs text-gray-600 mt-1">Cost estimate: KES 15,000-20,000</div>
                                            </div>