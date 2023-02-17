@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Drivers') }}</div>
                <livewire:driver-list>
            </div>
        </div>
    </div>
</div>
@endsection