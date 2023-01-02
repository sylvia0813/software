@extends('layouts.main')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100 mt-5">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="bg-white rounded m-auto shadow">
                    <div class="p-4">
                        <div class="mt-2">
                            <h2 style="font-weight: bold;">系統登入</h2>
                        </div>
                        <div class="mt-3">
                            <form method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="account" class="form-label">帳號</label>
                                    {{-- <input type="text" class="form-control" id="account" name="account" value="" placeholder="學號或員編" required> --}}
                                    <select name="account" id="account" class="form-select" required>
                                        <option value="" hidden>請選擇角色</option>
                                        <option value="admin">測試所有權限</option>
                                        <option value="server">領檯人員</option>
                                        <option value="waiter">服務生</option>
                                        <option value="chef">廚師</option>
                                        <option value="handyman">雜工</option>
                                        <option value="manager">經理</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">密碼</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="密碼" value="1234" readonly>
                                </div>
                                <div class="mb-3 text-end">
                                    <label class="user-select-none" style="cursor:pointer;" for="remember_me">
                                        記住我
                                        <input type="checkbox" name="remember_me" id="remember_me">
                                    </label>
                                </div>

                                <x-message></x-message>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">登入</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
