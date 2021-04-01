<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title') / {{ config('app.name') }}</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/dashboard.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="{{ route('page-admin-dashboard') }}">{{ config('app.name') }}</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('action-admin-logout') }}">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" id="accordion">
                        <li class="nav-item admin-nav-item">
                            <a class="nav-link" href="{{ route('page-admin-dashboard') }}">
                                <span class="fa-stack fa-lg"><i class="fas fa-home"></i></span> Dashboard
                            </a>
                        </li>
                        <li class="nav-item admin-nav-item">
                            <a class="nav-link" href="{{ route('page-admin-article-list') }}">
                                <span class="fa-stack fa-lg"><i class="fas fa-newspaper"></i></span> Articles
                            </a>
                        </li>
                        <li class="nav-item admin-nav-item">
                            <a class="nav-link" href="#">
                                <span class="fa-stack fa-lg"><i class="fas fa-list"></i></span> Categories
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/jquery/jquery.slim.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
