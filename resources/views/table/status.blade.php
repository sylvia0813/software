@extends('layouts.main')

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
                    <form action="{{ route('table.update', ['table_id' => $table->id]) }}" method="post">
                        @csrf
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
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">更改人數</span>
                                            </div>
                                            <input type="number" class="form-control" name="capacity" id="capacity" value="{{ $table->capacity }}" min="1" required>
                                        </div>
                                    </div>
                                </div>
                                @role('server')
                                    <div class="mt-3 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">儲存</button>
                                    </div>
                                @endrole
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
