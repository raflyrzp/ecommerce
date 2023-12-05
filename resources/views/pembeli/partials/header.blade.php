<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('pembeli/images/logo.png') }}" width="100px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ $title === 'Home' ? 'active' : '' }}"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item {{ $title === 'Shop' ? 'active' : '' }}"><a href="about.html" class="nav-link">Shop</a></li>
                <li class="nav-item {{ $title === 'About' ? 'active' : '' }}"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item cta cta-colored {{ $title === 'Cart' ? 'active' : '' }}"><a href="{{ route('keranjang.index') }}" class="nav-link"><span
                            class="icon-shopping_cart"></span>[{{ count(App\Models\Keranjang::all()) }}]</a></li>

            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
