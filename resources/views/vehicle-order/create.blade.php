@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Create Vehicle Order') }}</div>

                <div class="card-body">
                    <form action="{{ route('vehicle-order.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label>Vehicle</label>
                            <select class="form-control @error('vehicle') is-invalid @enderror" name="vehicle">
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @endforeach
                            </select>
                            @error('vehicle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Driver</label>
                            <select class="form-control @error('driver') is-invalid @enderror" name="driver">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('driver')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Approver</label>
                            <select class="form-control @error('approver') is-invalid @enderror" name="approver">
                                <option>Select Approver</option>
                                @foreach($approvers as $approver)
                                <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                                @endforeach
                            </select>
                            @error('approver')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Number of vehicles</label>
                            <input type="number" min="1" name="number_of_vehicle"
                                placeholder="how many vehicles do you need?" value="{{ old('number_of_vehicle') }}"
                                class="form-control @error('number_of_vehicle') is-invalid @enderror ">
                            @error('number_of_vehicle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" name="purpose" placeholder="to deliver nickel..."
                                value="{{ old('purpose') }}"
                                class="form-control @error('purpose') is-invalid @enderror ">
                            @error('purpose')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Travel Distance</label>
                            <div class="input-group">
                                <input type="number" name="travel_distance" value="{{ old('travel_distance') }}"
                                    class="form-control @error('travel_distance') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        KM
                                    </div>
                                </div>
                            </div>
                            @error('travel_distance')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" value="{{ old('purpose') }}"
                                class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end_date" value="{{ old('purpose') }}"
                                class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date')
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