<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('page-home-index') }}">
            <img src="{{ asset('icons/brand-img.png') }}" width="30" height="30" class="d-inline-block align-top mr-1" alt="Logo" loading="lazy">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page-home-index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page-article-list') }}">Articles</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($header_categories as $item)
                            <a class="dropdown-item" href="{{ route('page-category-detail', $item->slug) }}">{{ $item->name }}</a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('page-category-list') }}">All categories</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page-contact-index') }}">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page-about-index') }}">About me</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead" style="background-image: url('@yield('header-image')')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h2>@yield('header-title')</h2>
                    <span class="subheading">@yield('header-desc')</span>
                </div>
            </div>
        </div>
    </div>
</header>
