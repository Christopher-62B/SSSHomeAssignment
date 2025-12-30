<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Library System')</title>
</head>
<body>

    @include('partials.nav')

    <main style="padding: 20px;">
        @yield('content')
    </main>

</body>
</html>
