@extends('layouts.appbs')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Soil Testing Dashboard</h2>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $stats['total_samples'] }}</h4>
                            <p class="mb-0">Total Samples</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-vial fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $stats['pending_results'] }}</h4>
                            <p class="mb-0">Pending Results</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ number_format($stats['avg_health_score'] ?? 0, 1) }}%</h4>
                            <p class="mb-0">Avg Health Score</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <a href="{{ route('soil.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus"></i> New Sample
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Samples -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Soil Samples</h5>
                    <a href="{{ route('soil.index') }}" class="btn btn-primary btn-sm">View All</a>
                </div>
                <div class="card-body">
                    @if($stats['recent_samples']->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sample Code</th>
                                        <th>Farm</th>
                                        <th>Collection Date</th>
                                        <th>Health Score</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats['recent_samples'] as $sample)
                                    <tr>
                                        <td><strong>{{ $sample->sample_code }}</strong></td>
                                        <td>{{ $sample->farm->name }}</td>
                                        <td>{{ $sample->collection_date->format('M d, Y') }}</td>
                                        <td>
                                            @if($sample->healthScore)
                                                <span class="badge badge-{{ $sample->healthScore->score_color }}">
                                                    {{ number_format($sample->healthScore->overall_score, 1) }}% 
                                                    ({{ $sample->healthScore->health_grade }})
                                                </span>
                                            @else
                                                <span class="text-muted">Not calculated</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $sample->status_color }}">
                                                {{ ucfirst(str_replace('_', ' ', $sample->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('soil.show', $sample) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-vial fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No soil samples yet</h5>
                            <p class="text-muted">Start by collecting your first soil sample</p>
                            <a href="{{ route('soil.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Collect Sample
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
