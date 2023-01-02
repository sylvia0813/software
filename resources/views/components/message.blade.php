@if ($errors->any())
    <div class="alert alert-danger my-3">
        <b><i class="fas fa-exclamation-triangle"></i> 操作錯誤</b>
        @if ($errors->count() > 1)
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            {{ $errors->first() }}
        @endif
    </div>
@endif


@if (session()->has('success'))
    <div class="alert alert-success my-3">
        <b><i class="fas fa-check-circle"></i> 操作成功</b> {{ session()->get('success') }}
    </div>
@endif


@if (session()->has('warnings'))
    <div class="alert alert-warning my-3">
        <b><i class="fa-solid fa-circle-exclamation"></i> 注意</b>
        @php
            $warnings = session()->get('warnings');
        @endphp
        @if (is_array($warnings) && count($warnings) > 1)
            <ul class="my-0">
                @foreach ($warnings as $warning)
                    <li>{{ $warning }}</li>
                @endforeach
            </ul>
        @else
            @if (is_array($warnings))
                {{ $warnings[0] }}
            @else
                {{ $warnings }}
            @endif
        @endif
    </div>
@endif


@if (session()->has('info'))
    <div class="alert alert-info my-3">
        <b><i class="fa-solid fa-circle-info"></i> 提醒</b>
        @php
            $info = session()->get('info');
        @endphp
        @if (is_array($info) && count($info) > 1)
            <ul class="my-0">
                @foreach ($info as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @else
            @if (is_array($info))
                {{ $info[0] }}
            @else
                {{ $info }}
            @endif
        @endif
    </div>
@endif
