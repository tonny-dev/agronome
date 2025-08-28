@extends('layouts.appbs')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-vial"></i> Collect Soil Sample
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('soil.store') }}">
                        @csrf

                        <!-- Farm Selection -->
                        <div class="form-group mb-3">
                            <label for="farm_id" class="form-label">Select Farm *</label>
                            <select class="form-control @error('farm_id') is-invalid @enderror" 
                                    id="farm_id" name="farm_id" required onchange="loadFields(this.value)">
                                <option value="">Choose a farm...</option>
                                @foreach($farms as $farm)
                                    <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                                        {{ $farm->name }} ({{ $farm->location }})
                                    </option>
                                @endforeach
                            </select>
                            @error('farm_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Field Selection -->
                        <div class="form-group mb-3">
                            <label for="field_id" class="form-label">Select Field (Optional)</label>
                            <select class="form-control @error('field_id') is-invalid @enderror" 
                                    id="field_id" name="field_id">
                                <option value="">Select farm first...</option>
                            </select>
                            @error('field_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Collection Date -->
                        <div class="form-group mb-3">
                            <label for="collection_date" class="form-label">Collection Date *</label>
                            <input type="datetime-local" 
                                   class="form-control @error('collection_date') is-invalid @enderror" 
                                   id="collection_date" name="collection_date" 
                                   value="{{ old('collection_date', now()->format('Y-m-d\TH:i')) }}" required>
                            @error('collection_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- GPS Coordinates -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="number" step="0.00000001" 
                                           class="form-control @error('latitude') is-invalid @enderror" 
                                           id="latitude" name="latitude" value="{{ old('latitude') }}"
                                           placeholder="e.g., -1.286389">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="number" step="0.00000001" 
                                           class="form-control @error('longitude') is-invalid @enderror" 
                                           id="longitude" name="longitude" value="{{ old('longitude') }}"
                                           placeholder="e.g., 36.817223">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="getCurrentLocation()">
                                <i class="fas fa-map-marker-alt"></i> Get Current Location
                            </button>
                        </div>

                        <!-- Sample Depth -->
                        <div class="form-group mb-3">
                            <label for="depth_cm" class="form-label">Sample Depth (cm) *</label>
                            <input type="number" min="5" max="100" 
                                   class="form-control @error('depth_cm') is-invalid @enderror" 
                                   id="depth_cm" name="depth_cm" value="{{ old('depth_cm', 20) }}" required>
                            <small class="form-text text-muted">Recommended: 15-20 cm for most crops</small>
                            @error('depth_cm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Weather Conditions -->
                        <div class="form-group mb-3">
                            <label for="weather_conditions" class="form-label">Weather Conditions</label>
                            <textarea class="form-control @error('weather_conditions') is-invalid @enderror" 
                                      id="weather_conditions" name="weather_conditions" rows="2"
                                      placeholder="e.g., Sunny, dry conditions, no recent rainfall">{{ old('weather_conditions') }}</textarea>
                            @error('weather_conditions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="form-group mb-4">
                            <label for="notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3"
                                      placeholder="Any additional observations or notes about the sample location">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('soil.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Record Sample
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadFields(farmId) {
    const fieldSelect = document.getElementById('field_id');
    fieldSelect.innerHTML = '<option value="">Loading...</option>';
    
    if (!farmId) {
        fieldSelect.innerHTML = '<option value="">Select farm first...</option>';
        return;
    }
    
    fetch(`/get_fields_from_farm?farm_id=${farmId}`)
        .then(response => response.json())
        .then(fields => {
            fieldSelect.innerHTML = '<option value="">No specific field</option>';
            fields.forEach(field => {
                fieldSelect.innerHTML += `<option value="${field.id}">${field.name} (${field.allocation} ha)</option>`;
            });
        })
        .catch(error => {
            console.error('Error loading fields:', error);
            fieldSelect.innerHTML = '<option value="">Error loading fields</option>';
        });
}

function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude.toFixed(8);
            document.getElementById('longitude').value = position.coords.longitude.toFixed(8);
        }, function(error) {
            alert('Error getting location: ' + error.message);
        });
    } else {
        alert('Geolocation is not supported by this browser.');
    }
}
</script>
@endsection
