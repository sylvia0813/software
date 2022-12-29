@extends('layouts.main')

@php
    $status = [
        'pending' => '待處理',
        'processing' => '處理中',
        'finish' => '已完成',
        'arrived' => '已送達',
        'canceled' => '已取消',
    ];
@endphp

@section('content')
    <style>
        .table-xd-hover tbody:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message></x-message>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-secondary">訂單編號：{{ $order->id }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-borderless align-middle light-border table-xd-hover">
                                <thead>
                                    <tr class="text-secondary">
                                        <th width="10%"></th>
                                        <th width="10%">餐點</th>
                                        <th width="10%">單價</th>
                                        <th width="10%">數量</th>
                                        <th width="10%">備註</th>
                                        <th width="10%">狀態</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->meals as $index => $meal)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}.</td>
                                            <td>{{ $meal->meal->name }}</td>
                                            <td>{{ $meal->meal->price }}$</td>
                                            <td>{{ $meal->count }}</td>
                                            <td>{{ $meal->remake }}</td>
                                            <td>{{ $status[$meal->status] }}</td>
                                            <td>
                                                @if ($meal->status == 'finish')
                                                    <form action="{{ route('order.meal.arrived', ['order_meal_id' => $meal->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">已送達</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('order.checkout', ['order_id' => $order->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary float-end">結帳</button>
                                    <h5 class="d-inline text-danger">總金額：{{ $total_price }}</h5>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
