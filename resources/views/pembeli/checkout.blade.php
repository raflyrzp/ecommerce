@extends('pembeli/layout/main')

@section('container')
    <!-- Page Content -->

    <div class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><br><br><br>
                    <div class="section-heading mt-5">
                        <h2>Checkout</h2>
                    </div>
                </div>

                <form action="{{ route('proses.checkout') }}" method="post" id="checkoutForm">
                    @csrf
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedProducts as $i => $keranjang)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td class="text-center">
                                        <input type="hidden" name="selectedProducts[]"
                                            value="{{ $keranjang->produk->id }}">
                                        <input class="form-check-input" type="checkbox" name="selectedProducts[]"
                                            value="{{ $keranjang->produk->id }}" checked disabled>
                                    </td>
                                    <td><img width="100px" src="{{ asset('storage/produk/' . $keranjang->produk->image) }}"
                                            alt=""></td>
                                    <td>{{ $keranjang->produk->nama_produk }}</td>
                                    <td>{{ $keranjang->produk->harga_produk }}</td>
                                    <td>{{ $keranjang->jumlah_produk }}</td>
                                    <td>{{ $keranjang->produk->satuan }}</td>
                                    <td>{{ $keranjang->total_harga }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="id_pembeli" value="{{ auth()->user()->id }}">
                    <div class="mb-3">
                        <label for="alamat" class="col-form-label">Alamat :</label>
                        <input type="text" name="alamat" class="form-control" id="alamat"
                            value="{{ auth()->user()->alamat }}">
                    </div>
                    <div class="mb-3">
                        <label for="rekening" class="col-form-label">No. Rekening :</label>
                        <input type="text" name="rekening" class="form-control" id="rekening"
                            value="{{ auth()->user()->rekening }}">
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="col-form-label">No. Telepon :</label>
                        <input type="text" name="telp" class="form-control" id="telp"
                            value="{{ auth()->user()->telp }}">
                    </div>
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
                    <button type="submit" id="prepareCheckout" class="btn btn-checkout">Checkout</button>
                </form>

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            updateSelectedProducts();
        });

        $('#prepareCheckout').click(function() {
            updateSelectedProducts();
            $('#checkoutForm').submit();
        });

        function updateSelectedProducts() {
            var selectedProducts = [];
            $('input[name="selectedProducts"]:checked').each(function() {
                selectedProducts.push($(this).val());
            });
            $('input[name="selectedProducts"]').val(JSON.stringify(selectedProducts));
        }
    });
</script>
