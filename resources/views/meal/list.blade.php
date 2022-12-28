@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message></x-message>
            </div>
        </div>
        <div class="row mt-5">
            @forelse ($meals as $index => $meal)
                <div class="col-md-4">
                    <form class="h-100" action="{{ route('meal.update', ['meal_id' => $meal->id]) }}" method="post">
                        @csrf
                        <div class="card h-100">
                            <img src="{{ $meal->image_url }}" class="card-img-top" alt="">
                            <div class="card-body d-flex flex-column justify-content-end">
                                <h5 class="card-title">餐點名稱：{{ $meal->name }}</h5>
                                <p class="card-text">價錢：<span class="price">{{ $meal->price }}</span>$</p>
                                <p class="card-text">備註：<br>{{ $meal->description }}</p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">庫存</span>
                                    </div>
                                    <input type="number" class="form-control" name="stock" id="stock_{{ $index }}" placeholder="請選擇數量" min="0" value="{{ $meal->stock }}">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">儲存</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-danger">目前沒有任何餐點可供應</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
