<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Klasmen Sepak Bola App</title>
    {{-- CSS --}}
    @include('layouts.styles')
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-3">
        @yield('content')
    </div>

    {{-- JS --}}
    @include('layouts.scripts')
</body>

</html>
