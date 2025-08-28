@extends('layouts.appbs')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Soil Sample: {{ $sample->sample_code }}</h2>
                <div>
                    <span class="badge badge-{{ $sample->status_color }} badge-lg">
                        {{ ucfirst(str_replace('_', ' ', $sample->status)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sample Information -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Sample Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Farm:</strong></td>
                            <td>{{ $sample->farm->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Field:</strong></td>
                            <td>{{ $sample->field->name ?? 'No specific field' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Collection Date:</strong></td>
                            <td>{{ $sample->collection_date->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Depth:</strong></td>
                            <td>{{ $sample->depth_cm }} cm</td>
                        </tr>
                        @if($sample->latitude && $sample->longitude)
                        <tr>
                            <td><strong>Location:</strong></td>
                            <td>{{ $sample->latitude }}, {{ $sample->longitude }}</td>
                        </tr>
                        @endif
                        @if($sample->weather_conditions)
                        <tr>
                            <td><strong>Weather:</strong></td>
                            <td>{{ $sample->weather_conditions }}</td>
                        </tr>
                        @endif
                    </table>
                    
                    @if($sample->notes)
                    <div class="mt-3">
                        <strong>Notes:</strong>
                        <p class="text-muted">{{ $sample->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Health Score -->
            @if($sample->healthScore)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-heartbeat"></i> Soil Health Score</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <h1 class="text-{{ $sample->healthScore->score_color }}">
                            {{ number_format($sample->healthScore->overall_score, 1) }}%
                        </h1>
                        <h5 class="text-{{ $sample->healthScore->score_color }}">
                            {{ $sample->healthScore->health_grade }}
                        </h5>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-4">
                            <small class="text-muted">pH Score</small>
                            <div class="font-weight-bold">{{ number_format($sample->healthScore->ph_score, 1) }}%</div>
                        </div>
                        <div class="col-4">
                            <small class="text-muted">Nutrients</small>
                            <div class="font-weight-bold">{{ number_format($sample->healthScore->nutrient_score, 1) }}%</div>
                        </div>
                        <div class="col-4">
                            <small class="text-muted">Organic Matter</small>
                            <div class="font-weight-bold">{{ number_format($sample->healthScore->organic_matter_score, 1) }}%</div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <small class="text-muted">{{ $sample->healthScore->interpretation }}</small>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Test Results -->
        <div class="col-md-8">
            @if($sample->chemicalResults->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-flask"></i> Chemical Test Results</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Result</th>
                                    <th>Optimal Range</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sample->chemicalResults as $result)
                                <tr>
                                    <td>
                                        <strong>{{ $result->parameter->parameter_name }}</strong>
                                        <br><small class="text-muted">{{ $result->parameter->description }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $result->formatted_value }}</strong>
                                    </td>
                                    <td>
                                        @if($result->parameter->optimal_min && $result->parameter->optimal_max)
                                            {{ $result->parameter->optimal_min }} - {{ $result->parameter->optimal_max }} {{ $result->parameter->unit }}
                                        @else
                                            <span class="text-muted">Not defined</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $isOptimal = $result->isOptimal();
                                            $badgeClass = $isOptimal === true ? 'success' : ($isOptimal === false ? 'warning' : 'secondary');
                                        @endphp
                                        <span class="badge badge-{{ $badgeClass }}">
                                            {{ $result->interpretation }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Recommendations -->
            @if($sample->recommendations->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Recommendations</h5>
                </div>
                <div class="card-body">
                    @foreach($sample->recommendations as $recommendation)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="card-title">
                                        <span class="badge badge-info">{{ ucfirst($recommendation->recommendation_type) }}</span>
                                        {{ $recommendation->product_name }}
                                    </h6>
                                    <p class="card-text">
                                        <strong>Application Rate:</strong> {{ $recommendation->formatted_quantity }}<br>
                                        @if($recommendation->application_method)
                                            <strong>Method:</strong> {{ $recommendation->application_method }}<br>
                                        @endif
                                        @if($recommendation->timing)
                                            <strong>Timing:</strong> {{ ucfirst(str_replace('_', ' ', $recommendation->timing)) }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-4 text-right">
                                    @if($recommendation->estimated_cost)
                                        <h5 class="text-success">{{ $recommendation->formatted_cost }}</h5>
                                        <small class="text-muted">per hectare</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Add Results Form -->
            @if($sample->status !== 'results_received')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Add Test Results</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('soil.add-results', $sample) }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="lab_reference" class="form-label">Lab Reference</label>
                                <input type="text" class="form-control" id="lab_reference" name="lab_reference" 
                                       placeholder="Lab report reference number">
                            </div>
                            <div class="col-md-6">
                                <label for="test_date" class="form-label">Test Date</label>
                                <input type="date" class="form-control" id="test_date" name="test_date" 
                                       value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div id="test-parameters">
                            <!-- Parameters will be loaded here -->
                        </div>

                        <button type="button" class="btn btn-outline-primary" onclick="loadParameters()">
                            Load Test Parameters
                        </button>
                        
                        <button type="submit" class="btn btn-success" style="display: none;" id="submit-results">
                            <i class="fas fa-save"></i> Save Results
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function loadParameters() {
    fetch('/api/chemical-test-parameters')
        .then(response => response.json())
        .then(parameters => {
            const container = document.getElementById('test-parameters');
            container.innerHTML = '<h6>Enter Test Results:</h6>';
            
            parameters.forEach((param, index) => {
                container.innerHTML += `
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">${param.parameter_name} (${param.unit})</label>
                            <input type="hidden" name="results[${index}][parameter_id]" value="${param.id}">
                        </div>
                        <div class="col-md-6">
                            <input type="number" step="0.0001" class="form-control" 
                                   name="results[${index}][result_value]" 
                                   placeholder="Enter ${param.parameter_name} value" required>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('submit-results').style.display = 'inline-block';
        })
        .catch(error => {
            console.error('Error loading parameters:', error);
            alert('Error loading test parameters');
        });
}
</script>
@endsection
