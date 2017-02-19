<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Freznos Paypal for Laravel 5.x</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

@include('layouts.top-nav')

<div class="container">

    @yield('content')

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-md-12">
                <p>Freznos Paypal for Laravel 5.x - <a href="https://github.com/frezno/paypal-sdk-laravel5" target="_blank">Get Source at GitHub</a><p>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
