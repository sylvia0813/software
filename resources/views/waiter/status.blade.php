@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message></x-message>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($waiters as $user)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4>#{{ $user->id }}</h4>
                            <div class="row my-2">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="name">性名</span>
                                        </div>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="未輸入">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text h-100" id="order">桌號</span>
                                        </div>
                                        <select class="form-select" name="order" id="order" size="5">
                                            @foreach ($user->orders as $order)
                                                <option value="{{ $order->id }}">{{ $order->table->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
