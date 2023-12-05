{{-- @extends('pembeli/layout/main')

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
</script> --}}


@extends('pembeli.layout.main')

@section('container')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('pembeli/images/checkout-bg.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('proses.checkout') }}" method="post" id="checkoutForm" class="billing-form">
        @csrf
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 ftco-animate">

                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selectedProducts as $i => $keranjang)
                                    <tr class="text-center">
                                        <td class="text-center px-5 pb-5" style="vertical-align: middle;">

                                            <style>
                                                .checkboxKeranjang {
                                                    transform: scale(1.4);
                                                    -webkit-transform: scale(1.4);
                                                }
                                            </style>
                                            <input type="hidden" name="selectedProducts[]"
                                                value="{{ $keranjang->produk->id }}">
                                            <input class="form-check-input checkboxKeranjang" autocomplete="off"
                                                id="selectedProducts" type="checkbox" name="selectedProducts[]"
                                                value="{{ $keranjang->produk->id }}" checked disabled>

                                        </td>

                                        <td class="image-prod">
                                            <img width="100px"
                                                src="{{ asset('storage/produk/' . $keranjang->produk->image) }}"
                                                alt="">
                                        </td>

                                        <td class="product-name">
                                            <h3>{{ $keranjang->produk->nama_produk }}</h3>
                                        </td>

                                        <td class="price">
                                            IDR.{{ number_format($keranjang->produk->harga_produk, 0, ',', '.') }},00
                                        </td>

                                        <td class="quantity">
                                            {{ $keranjang->jumlah_produk }}
                                        </td>

                                        <td class="total">
                                            IDR.{{ number_format($keranjang->total_harga, 0, ',', '.') }},00
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" id="provinsi"
                                        value="{{ auth()->user()->fullname }}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}"
                                        required>

                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat">Address</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ auth()->user()->alamat }}"
                                        required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kota">Town / City</label>
                                    <input type="text" class="form-control" id="kota" name="kota" value="{{ auth()->user()->kota }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provinsi">Province</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ auth()->user()->provinsi }}"
                                        required>

                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telp">Phone</label>
                                    <input type="text" class="form-control" id="telp" name="telp" value="{{ auth()->user()->telp }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kode_pos">Postcode / ZIP *</label>
                                    <input type="text" class="form-control" id="kode_pos" value="{{ auth()->user()->kode_pos }}"
                                        name="kode_pos" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_pengiriman">Delivery Service</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="id_pengiriman" id="id_pengiriman" class="form-control">
                                            @foreach ($data_pengiriman as $pengiriman)
                                                <option value="{{ $pengiriman->id }}">{{ $pengiriman->nama_pengiriman }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row mt-5 pt-3 d-flex">
                                <div class="col-md-6 d-flex">
                                    <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                        <h3 class="billing-heading mb-4">Cart Total</h3>
                                        <p class="d-flex">
                                            <span>Subtotal</span>
                                            <span>IDR.
                                                {{ number_format($subtotal, 0, ',', '.') }},00</span>
                                        </p>
                                        <p class="d-flex">
                                            <span>Delivery</span>
                                            <span>IDR. 0,00</span>
                                        </p>
                                        <p class="d-flex">
                                            <span>Discount</span>
                                            <span>0%</span>
                                        </p>
                                        <hr>
                                        <p class="d-flex total-price">
                                            <span>Total</span>
                                            <span>IDR.
                                                {{ number_format($total, 0, ',', '.') }},00</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cart-detail bg-light p-3 p-md-4">
                                        <h3 class="billing-heading mb-4">Payment Method</h3>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="optradio" class="mr-2"> Direct
                                                        Bank
                                                        Tranfer</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="optradio" class="mr-2"> Check
                                                        Payment</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="optradio" class="mr-2">
                                                        Paypal</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" value="" class="mr-2"> I have
                                                        read and
                                                        accept the terms and conditions</label>
                                                </div>
                                            </div>
                                        </div>
                                        <p><button type="submit" class="btn btn-primary py-3 px-4">Place an
                                                order</button></p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .col-md-8 -->
                    </div>
                </div>
        </section> <!-- .section -->
    </form><!-- END -->
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
