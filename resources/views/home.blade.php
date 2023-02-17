@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    @role('admin')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Export Vehicle Orders') }}</div>

                <div class="card-body">
                    <form action="{{ route('vehicle-order.export') }}" method="GET">
                        @csrf
                        <div class="row">

                            <div class="form-group col-lg-6">
                                <label>From</label>
                                <input type="date" name="from" value="{{ old('from') }}"
                                    class="form-control @error('from') is-invalid @enderror ">
                                @error('from')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label>To</label>
                                <input type="date" name="to" value="{{ old('to') }}"
                                    class="form-control @error('to') is-invalid @enderror">
                                @error('to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                        </div>
                        @if(Session::has('export-error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('export-error') }}
                        </div>
                        @endif

                        {{-- <input type="text" name="dates" id="dtr" class="form-control"> --}}
                        <div class="text-right">
                            <button class="btn btn-primary text-nowrap">Export CSV</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @hasanyrole('admin|employee|supervisor')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Vehicle Order Statistics') }}</div>

                <div class="card-body">
                    <canvas id="orderVehicleChart" height="150" style="display: block; width: 100%; height: 100%;"
                        class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endhasanyrole()

    @hasanyrole('admin|supervisor')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Fuel Usage Statistics in Liter') }}</div>

                <div class="card-body">
                    <canvas id="fuelStatistics" height="150" style="display: block; width: 100%; height: 100%;"
                        class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endhasanyrole

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha256-t9UJPrESBeG2ojKTIcFLPGF7nHi2vEc7f5A2KpH/UBU=" crossorigin="anonymous"></script>

    <script>
        $(".alert").delay(2000).slideUp(300, function() {
            $(this).alert('close');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.getElementById("orderVehicleChart").getContext('2d');
                const balanceChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json(array_keys($chartData)),
                        datasets: [
                            {
                                label: `{{ __('Your Order Vehicle') }}`,
                                data: @json(array_values($chartData)),
                                backgroundColor: '#7887f5',
                                borderWidth: 2,
                                borderColor: '#6777ef',
                                pointBorderWidth: 5,
                                pointRadius: 1,
                                pointBackgroundColor: 'transparent',
                                pointHoverBackgroundColor: '#6777ef',
                            },
                            @hasanyrole('admin|supervisor')
                            {
                                label: `{{ __('Overall Order Vehicle') }}`,
                                data: @json(array_values($overallChartData)),
                                backgroundColor: '#67c2ef',
                                borderWidth: 2,
                                borderColor: '#3dbcfc',
                                pointBorderWidth: 5,
                                pointRadius: 1,
                                pointBackgroundColor: 'transparent',
                                pointHoverBackgroundColor: '#3dbcfc',
                            },
                            @endhasanyrole

                        ]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                    // drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    // stepSize: 1,
                                    callback: function (value, index, values) {
                                        return value.toLocaleString();
                                    }
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                    tickMarkLength: 15,
                                }
                            }]
                        },
                    }
                });

                @hasanyrole('admin|supervisor')
                const fctx = document.getElementById("fuelStatistics").getContext('2d');
                const fuelChart = new Chart(fctx, {
                    type: 'line',
                    data: {
                        labels: @json(array_keys($chartData)),
                        datasets: [
                            {
                                label: `{{ __('Fuel Usage Statistcs') }}`,
                                data: @json(array_values($fuelStatistics)),
                                backgroundColor: '#7887f5',
                                borderWidth: 2,
                                borderColor: '#6777ef',
                                pointBorderWidth: 5,
                                pointRadius: 1,
                                pointBackgroundColor: 'transparent',
                                pointHoverBackgroundColor: '#6777ef',
                            },
                        ]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                    // drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    // stepSize: 1,
                                    callback: function (value, index, values) {
                                        return value.toLocaleString();
                                    }
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                    tickMarkLength: 15,
                                }
                            }]
                        },
                    }
                });
                @endhasanyrole
            })
    </script>
    @endpush
</div>
@endsection