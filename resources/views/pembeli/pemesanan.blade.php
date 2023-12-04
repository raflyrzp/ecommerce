@extends('pembeli/layout/main')

@section('container')
    <!-- Page Content -->
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><br><br><br>
                    <div class="section-heading mt-5">
                        <h2>Pemesanan</h2>
                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Jumlah Produk</th>
                            <th>Tanggal</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Total Harga</th>
                            <th>Rekening</th>
                            {{-- <th>Telp</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pemesanan as $i => $pemesanan)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><img src="{{ asset('storage/produk/' . $pemesanan->produk->image) }}" alt=""
                                        width="100px"></td>
                                <td>{{ $pemesanan->produk->nama_produk }}</td>
                                <td>{{ $pemesanan->produk->harga_produk }}</td>
                                <td>{{ $pemesanan->jumlah_produk }}</td>
                                <td>{{ $pemesanan->tgl_pemesanan }}</td>
                                <td>{{ $pemesanan->alamat }}</td>
                                <td> <a href=""
                                        class="btn
                                @if ($pemesanan->status === 'diproses') btn-default
                                @elseif($pemesanan->status === 'dikirim') btn-info
                                @elseif($pemesanan->status === 'diterima') btn-success @endif"
                                        data-toggle="modal"
                                        data-target="#editModal{{ $pemesanan->id }}">{{ $pemesanan->status }}</a>
                                </td>
                                <td>{{ $pemesanan->total_harga }}</td>
                                <td>{{ $pemesanan->rekening }}</td>
                                {{-- <td>{{ $pemesanan->telp }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

<script>
    function checkout() {
        document.getElementById("formCheckout").submit();
    }
</script>
