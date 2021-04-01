<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <!-- Main Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Dynamical -->
    <title>@yield('title') / {{ config('app.name') }}</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

    <!-- Custom -->
    <link href="{{ asset('blog/clean-blog.css') }}" rel="stylesheet">
</head>

<body>
    @include('blocks.header')

    <main class="container">
        <div class="row">
            <div class="col-lg-8">
                @yield('content')
            </div>
            <div class="col-lg-4">
                @include('blocks.aside')
            </div>
        </div>
    </main>

    @include('blocks.footer')

    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('blog/clean-blog.js') }}"></script>
</body>
</html>
