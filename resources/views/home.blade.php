@extends('layouts.main')

@php
    $status = [
        'occupied' => '使用中',
        'available' => '可使用',
        'uncleaned' => '需清潔',
        'reserved' => '已預定',
    ];

    $colors = [
        'occupied' => 'danger',
        'available' => 'success',
        'uncleaned' => 'warning',
        'reserved' => 'primary',
    ];
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message></x-message>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($tables as $table)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body px-4 text-center">
                            <div class="row">
                                <div class="col-md-8 ">
                                    <div class="alert-secondary alert">{{ $table->name }}</div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="alert-secondary alert">{{ $table->capacity }}<br>人桌</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-{{ $colors[$table->status] }}">{{ $status[$table->status] }}</div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('order.index', ['table_id' => $table->id]) }}" class="btn btn-primary">入桌</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
