@extends('backend.layout.admin')

@section('name-page')
    Edit Settings
@stop

@section('content')
    <div class="container mt-4">
        <h2>Edit Settings</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update', $setting->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hotel Name -->
            <div class="form-group">
                <label for="hotel_name">Hotel Name</label>
                <input 
                    type="text" 
                    name="hotel_name" 
                    id="hotel_name" 
                    class="form-control @error('hotel_name') is-invalid @enderror"
                    value="{{ old('hotel_name', $setting->hotel_name) }}"
                    required>
                @error('hotel_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tax Number -->
            <div class="form-group">
                <label for="tax_number">Tax Number</label>
                <input 
                    type="text" 
                    name="tax_number" 
                    id="tax_number" 
                    class="form-control @error('tax_number') is-invalid @enderror"
                    value="{{ old('tax_number', $setting->tax_number) }}"
                    required>
                @error('tax_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Company Number -->
            <div class="form-group">
                <label for="company_number">Company Number</label>
                <input 
                    type="text" 
                    name="company_number" 
                    id="company_number" 
                    class="form-control @error('company_number') is-invalid @enderror"
                    value="{{ old('company_number', $setting->company_number) }}"
                    required>
                @error('company_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $setting->email) }}"
                    required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- City -->
            <div class="form-group">
                <label for="city">City</label>
                <input 
                    type="text" 
                    name="city" 
                    id="city" 
                    class="form-control @error('city') is-invalid @enderror"
                    value="{{ old('city', $setting->city) }}"
                    required>
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Street -->
            <div class="form-group">
                <label for="street">Street</label>
                <input 
                    type="text" 
                    name="street" 
                    id="street" 
                    class="form-control @error('street') is-invalid @enderror"
                    value="{{ old('street', $setting->street) }}"
                    required>
                @error('street')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
@stop
