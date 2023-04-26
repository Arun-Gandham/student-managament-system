<!doctype html>
<html lang="en">

<head>
    @include('layout.partials.head')
</head>

<body>
    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>

    @include('layout.partials.footer-scripts')
</body>

</html>
