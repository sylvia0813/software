@extends('layouts.main')

@php
    $categories = [
        'assign' => '已指派',
        'unassign' => '未指派',
    ];

    $sexs = [
        'male' => '男',
        'female' => '女',
    ];

    $roles = [
        'server' => '領檯人員',
        'waiter' => '服務生',
        'chef' => '廚師',
        'handyman' => '雜工',
        'manager' => '經理',
    ];

    $routes = [
        'assign' => 'order.waiter.unassign',
        'unassign' => 'order.waiter.assign',
    ];

    $route_btn = [
        'assign' => '取消指派',
        'unassign' => '指派',
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
            <div class="col-md-12">
                @foreach ($categories as $_key => $_value)
                    <div class="row">
                        <div class="alert alert-primary">{{ $_value }}</div>
                        @foreach ($group_waiters[$_key] ?? [] as $waiter)
                            <div class="col-md-3 mb-3">
                                <form action="{{ route($routes[$_key], ['order_id' => $order->id, 'waiter_id' => $waiter->id]) }}" method="post">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body px-4">
                                            <h4 class="text-center">#{{ $waiter->id }}</h4>
                                            <div class="row my-2">
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="name">性名</span>
                                                        </div>
                                                        <label for="" class="form-control">{{ $waiter->name }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">性別</span>
                                                        </div>
                                                        <label for="" class="form-control">{{ $sexs[$waiter->sex] ?? '不詳' }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">年紀</span>
                                                        </div>
                                                        <label for="" class="form-control">{{ $waiter->age ?? '不詳' }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">職位</span>
                                                        </div>
                                                        <label for="" class="form-control">{{ $roles[$waiter->role] }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary">{{ $route_btn[$_key] }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
