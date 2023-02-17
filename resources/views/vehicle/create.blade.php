@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Vehicle') }}</div>


                <div class="card-body">

                    <form action="{{ route('vehicle.store') }}" method="POST">
                        @csrf
                        @method('POST')


                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="honda.." value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror ">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Plate Number</label>
                            <input type="text" name="plate" placeholder="N 1234 .." value="{{ old('plate') }}"
                                class="form-control @error('plate') is-invalid @enderror ">
                            @error('plate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="type" placeholder="car, bus, truck..." value="{{ old('type') }}"
                                class="form-control @error('type') is-invalid @enderror ">
                            @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Fuel Consumtion (KM)</label>
                            <input type="text" name="fuel_per_km" placeholder="2" value="{{ old('fuel_per_km') }}"
                                class="form-control @error('fuel_per_km') is-invalid @enderror ">
                            @error('fuel_per_km')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection