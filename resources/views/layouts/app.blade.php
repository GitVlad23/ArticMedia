<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript" src="geolocation_ip.js"></script>
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>
