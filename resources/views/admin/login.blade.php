<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login / {{ config('app.name') }}</title>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('action-admin-login') }}">
            <img class="mb-4" src="{{ url('resources/icons/brand-img.png') }}" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            @csrf
            <label for="inputEmail" class="sr-only">Email address</label>
            <input id="inputEmail" type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input id="inputPassword" type="password" name="password" class="form-control" placeholder="Password" required="">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
</body>
</html>
