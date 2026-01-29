<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/loginon.css') }}">
</head>
<body>
<body class="auth-body">
    <div class="auth-wrapper">
        @yield('content')
    </div>
</body>

</body>
</html>
