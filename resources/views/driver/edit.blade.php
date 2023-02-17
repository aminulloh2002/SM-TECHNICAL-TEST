@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Driver') }}</div>

                <div class="card-body">

                    <form action="{{ route('driver.update',$driver) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="john.." value="{{ old('name', $driver->name) }}"
                                class="form-control @error('name') is-invalid @enderror ">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" placeholder="6289.."
                                value="{{ old('phone', $driver->phone) }}"
                                class="form-control @error('phone') is-invalid @enderror ">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="malang.."
                                value="{{ old('address', $driver->address) }}"
                                class="form-control @error('address') is-invalid @enderror ">
                            @error('address')
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