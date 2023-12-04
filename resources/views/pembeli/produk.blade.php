@extends('pembeli/layout/main')

@section('container')
    <!-- Page Content -->

    <div class="page-heading about-heading header-text"
        style="background-image: url({{ asset('storage/produk/' . $produk->image) }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Detail</h4>
                        <h2>{{ $produk->nama_produk }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Detail Produk</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="{{ asset('storage/produk/' . $produk->image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="left-content"
                        style="height:100%; display:flex; flex-direction:column; justify-content: end;">
                        <h1 class="mb-2">{{ $produk->nama_produk }}</h1>
                        {{-- <p style="font-size: 1.5em;">Stok : {{ $produk->stok }}</p> --}}
                        <p style="font-size: 1.5em;">IDR. {{ $produk->harga_produk }}</p>
                        {{-- <p style="font-size: 1.2em;">{{ $produk->stok }} {{ $produk->satuan }}</p> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-heading mt-5">
                        <h2>Deskripsi</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="text-justify">{{ $produk->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
