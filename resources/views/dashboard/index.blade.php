@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message></x-message>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="sales" width="400" height="100"></canvas>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2 text-danger">
                                <small>* 本日銷售總數：{{ $salesTotalCountToday }} 份</small>
                                <br>
                                <small>* 本日銷售總額：{{ $salesTotalPiceToday }} 元</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart($('#sales'), {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($meals as $meal)
                        '{{ $meal->name }}',
                    @endforeach
                ],
                datasets: [{
                    label: '當日銷售業績',
                    data: [
                        @foreach ($meals as $meal)
                            '{{ $meal->salesCountToday() }}',
                        @endforeach
                    ],
                }],
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + '份';
                            },
                            stepSize: 10,
                        },
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + '：' + context.formattedValue + '份';
                            }
                        }
                    },
                }
            }
        });
    </script>
@endpush
