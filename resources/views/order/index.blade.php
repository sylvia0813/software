@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message></x-message>
            </div>
        </div>
        <form action="{{ route('order.new', ['table_id' => $table_id]) }}" method="post">
            @csrf
            <div class="row mt-5">
                <div class="col-md-12">
                    <h5 class="alert alert-primary">選擇餐點</h5>
                    <div class="row">
                        @forelse ($meals as $index => $meal)
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <img src="{{ $meal->image_url }}" class="card-img-top" alt="">
                                    <div class="card-body d-flex flex-column justify-content-end">
                                        <h5 class="card-title">餐點名稱：{{ $meal->name }}</h5>
                                        <p class="card-text">價錢：<span class="price">{{ $meal->price }}</span>$</p>
                                        <p class="card-text">備註：<br>{{ $meal->description }}</p>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">數量</span>
                                            </div>
                                            <input type="number" class="form-control" name="meals[{{ $meal->id }}]" id="meals_{{ $index }}" placeholder="請選擇數量" min="0" max="{{ $meal->stock }}" value="0" onchange="calcTotal()">
                                        </div>
                                        <div>
                                            <small class="float-end text-danger">剩餘: {{ $meal->stock }} 份</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-danger">目前沒有任何餐點可供應</div>
                            </div>
                        @endforelse
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <span class="float-end">總價: <span id="total">0</span>$</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3 float-end">確認送出</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function select(id) {
            $('#table_' + id).prop('checked', true);
            $('.select-table').each((i, e) => {
                $(e).removeClass('btn-danger').text('選擇');
            })
            $('.select-table[data-id=' + id + ']').addClass('btn-danger').text('已選擇');
        }

        function calcTotal() {
            let total = 0;
            $('.price').each((i, e) => {
                total += $(e).text() * $('#meals_' + i).val();
            });
            $('#total').text(total);
        }
    </script>
@endpush
