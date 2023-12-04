@extends('pembeli/layout/main')

@section('container')
    <!-- Page Content -->

    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><br><br><br>
                    <div class="section-heading mt-5">
                        <h2>Keranjang</h2>
                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Select</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_keranjang as $i => $keranjang)
                            <tr align="center">
                                <td style="vertical-align: middle;">{{ $i + 1 }}</td>
                                <form id="formCheckout" action="{{ route('checkout') }}" method="get">
                                    @csrf

                                    <style>
                                        .checkboxKeranjang {
                                            transform: scale(1.4);
                                            -webkit-transform: scale(1.4);
                                        }
                                    </style>
                                    <td class="text-center pb-5" style="vertical-align: middle;">
                                        <input class="form-check-input checkboxKeranjang" autocomplete="off"
                                            id="selectedProducts" type="checkbox" name="selectedProducts[]"
                                            value="{{ $keranjang->produk->id }}">

                                    </td>
                                </form>
                                <td style="vertical-align: middle;"><img width="100px"
                                        src="{{ asset('storage/produk/' . $keranjang->produk->image) }}" alt="">
                                </td>
                                <td style="vertical-align: middle;">{{ $keranjang->produk->nama_produk }}</td>
                                <td style="vertical-align: middle;">{{ $keranjang->produk->harga_produk }}</td>
                                <td style="vertical-align: middle;">{{ $keranjang->jumlah_produk }}</td>
                                <td style="vertical-align: middle;">{{ $keranjang->produk->satuan }}</td>
                                <td style="vertical-align: middle;">{{ $keranjang->total_harga }}</td>
                                <td style="vertical-align: middle;">
                                    <form action="{{ route('keranjang.destroy', $keranjang->id) }}" method="post"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Anda yakin ingin menghapus produk ini?')">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <style>
                    .btn-checkout {
                        background-color: #2e90bf;
                        color: #fff;
                        font-size: 14px;
                        text-transform: capitalize;
                        font-weight: 300;
                        padding: 10px 20px;
                        border-radius: 5px;
                        display: inline-block;
                        transition: all 0.3s;
                        float: right;
                    }

                    .btn-checkout:hover {
                        background-color: #0f6d99;
                        color: #fff;
                    }
                </style>
                <div class="row">
                    <div class="col-12">
                        <button onclick="checkout()" class="btn btn-checkout">Checkout</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

<script>
    function checkout() {
        document.getElementById("formCheckout").submit();
    }
</script>
