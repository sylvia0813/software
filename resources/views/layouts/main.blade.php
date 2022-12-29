<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>軟體工程期末專題</title>

    {{-- js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    {{-- css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">軟體工程期末專題</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('table.status') }}">桌面狀態</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.list') }}">訂單列表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('meal.list') }}">庫存狀態</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">銷售分析</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.list') }}">員工檔案</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('waiter.status') }}">服務生狀態</a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                {{-- <li>
                                    <a class="dropdown-item" href="#">密碼設定</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">信箱設定</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">學校資料維護</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li> --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="btn-link dropdown-item" type="submit">登出</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">登入</a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <div class="main">
        @yield('content')
    </div>

    <footer class="bg-light mt-5">
        <div class="container-fluid">
            <div class="px-5 py-2 pt-4">
                <ul style="list-style: none; padding-left: unset;">
                    <li>
                        <h5>軟體工程期末專題</h5>
                    </li>
                    <li class="fw-bold my-2">組員: 陳駿騰、蔡岳哲、談宇容</li>
                </ul>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
