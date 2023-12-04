<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <h2> <img src="{{ asset('pembeli/assets/images/BMW.png') }}" width="50px" alt=""> BMW
                    <em>64</em>
                </h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ $title === 'Home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">Beranda
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Kontak</a>
                    </li>
                    {{-- <li class="nav-item {{ $title === 'Keranjang' || $title === 'Checkout' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('keranjang.index') }}"><i class="bi bi-cart-fill"></i></a>
                    </li> --}}

                    <li class="nav-item dropdown {{ $title === 'Keranjang' || $title === 'Checkout' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                src="{{ asset('pembeli/assets/images/client-01.png') }}" class="rounded-circle"
                                width="23px" height="23px" alt="">&nbsp; {{ auth()->user()->username }}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <a class="dropdown-item" href="{{ route('keranjang.index', auth()->user()->id) }}"><i
                                    class="bi bi-cart4"></i> Keranjang</a>
                            <a class="dropdown-item" href="{{ route('pembeli.pemesanan', auth()->user()->id) }}"><i
                                    class="bi bi-bag-heart"></i> Pemesanan</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="return confirm('Anda yakin ingin logout?')"><i
                                    class="bi bi-box-arrow-left"></i> Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
