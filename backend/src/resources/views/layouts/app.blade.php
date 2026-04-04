<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLog</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div>
            <a href="/" class="link">日次記録</a>
            <a href="registerTop" class="link">登録画面</a>
            <a href="paymentTop" class="link">支払い記録</a>
        </div>
    </header>
    @yield('content')
</body>
</html>
