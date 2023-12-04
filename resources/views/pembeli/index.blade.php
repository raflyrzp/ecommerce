  @extends('pembeli/layout/main')

  @section('container')
      <!-- Page Content -->
      <!-- Banner Starts Here -->
      <div class="banner header-text">
          <div class="owl-banner owl-carousel">
              <div class="banner-item-01">
                  <div class="text-content">
                      <h4>Best Offer</h4>
                      <h2>New Arrivals On Sale</h2>
                  </div>
              </div>
              <div class="banner-item-02">
                  <div class="text-content">
                      <h4>Flash Deals</h4>
                      <h2>Get your best products</h2>
                  </div>
              </div>
              <div class="banner-item-03">
                  <div class="text-content">
                      <h4>Last Minute</h4>
                      <h2>Grab last minute deals</h2>
                  </div>
              </div>
          </div>
      </div>
      <!-- Banner Ends Here -->

      <div class="latest-products">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="section-heading">
                          <h2>Produk Kami</h2>
                      </div>
                  </div>
                  @foreach ($data_produk as $produk)
                      <div class="col-md-4">
                          <div class="product-item">
                              <a href="{{ route('produk.show', $produk->id) }}"><img
                                      src="{{ asset('/storage/produk/' . $produk->image) }}" height="200px"
                                      style="object-fit: cover;"></a>
                              <div class="down-content">
                                  <a href="#">
                                      <h4>{{ $produk->nama_produk }}</h4>
                                  </a>
                                  <h6>IDR. {{ number_format($produk->harga_produk, 0, ',', '.') }}</h6>
                                  <p>{{ substr($produk->deskripsi, 0, 100) }}...</p><br>
                                  <ul class="stars">
                                      <li>Stok : {{ $produk->stok . ' ' . $produk->satuan }}</li>
                                  </ul>
                                  @if ($produk->stok < 1)
                                      <span style="color: red;">Habis</span>
                                  @else
                                      <span><a href="#" role="button" data-bs-toggle="modal"
                                              data-bs-target="#addToCart{{ $produk->id }}"><i class="bi bi-cart-plus"></i>
                                              Simpan</a></span>
                                  @endif
                              </div>
                          </div>
                      </div>

                      <!-- Modal -->
                      <div class="modal fade" id="addToCart{{ $produk->id }}" data-bs-backdrop="static"
                          data-bs-keyboard="false" tabindex="-1" aria-labelledby="addToCart{{ $produk->id }}Label"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="addToCart{{ $produk->id }}Label">Add to Cart</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <form action="{{ route('keranjang.store') }}" method="post">
                                      <div class="modal-body">
                                          @csrf
                                          <input type="hidden" name="id_pembeli" value="{{ auth()->user()->id }}">
                                          <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                                          <input type="hidden" name="harga_produk" value="{{ $produk->harga_produk }}">
                                          <div class="mb-3">
                                              <label for="jumlah_produk" class="col-form-label">Jumlah :</label>
                                              <input type="number" name="jumlah_produk" class="form-control"
                                                  id="jumlah_produk" value="1">
                                          </div>

                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary"
                                              data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>

      <div class="best-features">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="section-heading">
                          <h2>About BMW 64</h2>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="left-content">
                          <h4>Looking for the best products?</h4>
                          <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">This
                                  template</a> is free to use for your business websites. However,
                              you have no permission to redistribute the downloadable ZIP file on any template collection
                              website. <a rel="nofollow" href="https://templatemo.com/contact">Contact us</a> for more
                              info.</p>
                          <ul class="featured-list">
                              <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                              <li><a href="#">Consectetur an adipisicing elit</a></li>
                              <li><a href="#">It aquecorporis nulla aspernatur</a></li>
                              <li><a href="#">Corporis, omnis doloremque</a></li>
                              <li><a href="#">Non cum id reprehenderit</a></li>
                          </ul>
                          <a href="about.html" class="filled-button">Read More</a>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="right-image">
                          <img src="{{ asset('pembeli/assets/images/feature-image.jpg') }}" alt="">
                      </div>
                  </div>
              </div>
          </div>
      </div>
  @endsection
