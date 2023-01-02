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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <canvas id="sales" height="70"></canvas>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <canvas id="income" height="200"></canvas>
                            </div>
                            <div class="col-md-6">
                                <canvas id="popular" height="200"></canvas>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <canvas id="efficiency" height="100"></canvas>
                            </div>
                        </div>
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

@php
    $counts = $meals->map(fn($q) => $q->salesCountToday());
    $prices = $meals->map(fn($q) => $q->salesPriceToday());
    $serves = $waiters->map(fn($q) => $q->serveCountToday());
@endphp

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart($('#sales'), {
            data: {
                labels: [
                    @foreach ($meals as $meal)
                        '{{ $meal->name }}',
                    @endforeach
                ],
                datasets: [{
                    type: 'bar',
                    label: '今日銷售業績',
                    data: [{{ $counts->implode(',') }}],
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
        new Chart($('#income'), {
            data: {
                labels: [
                    @foreach ($meals as $meal)
                        '{{ $meal->name }}',
                    @endforeach
                ],
                datasets: [{
                    type: 'pie',
                    label: '餐點收入百分比',
                    data: [{{ $prices->implode(',') }}],
                }],
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let ar = [];
                                ar.push(context.dataset.label + '：' + Math.floor(context.formattedValue / {{ $salesTotalPiceToday }} * 100) + '%');
                                return ar.join('\n');
                            }
                        }
                    },
                }
            }
        });
        new Chart($('#popular'), {
            data: {
                labels: [
                    @foreach ($meals as $meal)
                        '{{ $meal->name }}',
                    @endforeach
                ],
                datasets: [{
                    type: 'pie',
                    label: '餐點受歡迎程度',
                    data: [{{ $counts->implode(',') }}],
                }],
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let ar = [];
                                ar.push(context.dataset.label + '：' + Math.floor(context.formattedValue / {{ $salesTotalCountToday }} * 100) + '%');
                                return ar.join('\n');
                            }
                        }
                    },
                }
            }
        });
        new Chart($('#efficiency'), {
            data: {
                labels: [
                    @foreach ($waiters as $waiter)
                        '{{ $waiter->name }}',
                    @endforeach
                ],
                datasets: [{
                    type: 'bar',
                    label: '員工效率',
                    data: [{{ $serves->implode(',') }}],
                }],
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + '單';
                            },
                            stepSize: 10,
                        },
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + '：' + context.formattedValue + '單';
                            }
                        }
                    },
                }
            }
        });
    </script>
@endpush
