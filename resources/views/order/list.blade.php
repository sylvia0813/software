@extends('layouts.main')

@php
    $status = [
        'pending' => '待處理',
        'processing' => '處理中',
        'finish' => '已完成',
        'arrived' => '已送達',
        'canceled' => '已廢棄',
    ];

    $step = [
        'pending' => 'processing',
        'processing' => 'finish',
    ];

    $step2 = [
        'pending' => '開始處理',
        'processing' => '處理完成',
    ];
@endphp

@push('styles')
    <style>
        .table-xd-hover tbody:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
    </style>
@endpush

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
                    <div class="card-body p-4">
                        <div class="row">
                            <table class="table table-borderless align-middle light-border table-xd-hover">
                                <thead>
                                    <tr class="text-secondary">
                                        <th width="10%">訂單編號</th>
                                        <th width="10%">桌號</th>
                                        <th width="10%">餐點</th>
                                        <th width="10%">數量</th>
                                        <th width="10%">備註</th>
                                        <th width="10%">狀態</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                @forelse ($orders as $order)
                                    <tbody>

                                        @foreach ($order->meals as $meal)
                                            <tr>
                                                @if ($loop->first)
                                                    <td rowspan="{{ count($order->meals) }}"># {{ $order->id }}</td>
                                                    <td rowspan="{{ count($order->meals) }}">{{ $order->table->name }}</td>
                                                @endif
                                                <td>{{ $meal->meal->name }}</td>
                                                <td>{{ $meal->count }}</td>
                                                <td>{{ $meal->remark }}</td>
                                                <td>{{ $status[$meal->status] }}</td>
                                                <td>
                                                    @if ($meal->status == 'pending' || $meal->status == 'processing')
                                                        @role('chef')
                                                            <form action="{{ route('order.meal.' . $step[$meal->status], ['order_id' => $order->id, 'meal_id' => $meal->id]) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">{{ $step2[$meal->status] }}</button>
                                                            </form>
                                                        @endrole
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td class="text-center p-4" colspan="7">目前沒有任何訂單</td>
                                        </tr>
                                    </tbody>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
