@extends('layouts.main')

@php
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
                @foreach ($roles as $key => $value)
                    <div class="row">
                        <h5 class="alert alert-primary">{{ $value }}</h5>
                        @foreach ($users[$key] ?? [] as $user)
                            <div class="col-md-3 mb-3">
                                <form action="{{ route('user.update', ['user_id' => $user->id]) }}" method="post">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body px-4 text-center">
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
                                                            <span class="input-group-text">性別</span>
                                                        </div>
                                                        <select class="form-select" name="sex" id="sex">
                                                            <option value="">未選擇</option>
                                                            @foreach ($sexs as $key => $value)
                                                                <option value="{{ $key }}" @selected($user->sex == $key)>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">年紀</span>
                                                        </div>
                                                        <input type="number" class="form-control" name="age" id="age" value="{{ $user->age }}" placeholder="未輸入">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">職位</span>
                                                        </div>
                                                        <select class="form-select" name="role" id="role">
                                                            @foreach ($roles as $key => $value)
                                                                <option value="{{ $key }}" @selected($user->role == $key)>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @role('manager')
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary">儲存</button>
                                                </div>
                                            @endrole
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
