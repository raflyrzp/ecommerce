<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pemesanan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_keranjang = Keranjang::all();
        $data_pengiriman = Pengiriman::all();


        return view('pembeli.checkout', [
            'data_keranjang' => $data_keranjang,
            'data_pengiriman' => $data_pengiriman,

            'title' => 'Checkout'
        ]);
    }

    public function checkout(Request $request)
    {
        $selectedProductIds = $request->selectedProducts;
        $data_pengiriman = Pengiriman::all();
        $data_keranjang = Keranjang::all();



        $subtotal = 0;

        foreach ($data_keranjang as $keranjang) {
            $totalHargaPerItem = $keranjang->produk->harga_produk * $keranjang->jumlah_produk;
            $subtotal += $totalHargaPerItem;
        }

        if ($selectedProductIds) {
            $selectedProducts = Keranjang::whereIn('id_produk', $selectedProductIds)
                ->join('produk', 'keranjang.id_produk', '=', 'produk.id')
                ->select('keranjang.*', 'produk.*')
                ->get();

            return view('pembeli.checkout', [
                'selectedProducts' => $selectedProducts,
                'data_pengiriman' => $data_pengiriman,
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'title' => 'Checkout'
            ]);
        } else {
            return redirect()->route('keranjang.index')->with('error', 'No products selected for checkout.');
        }
    }

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'telp' => 'required|numeric',
            'email' => 'required|email:dns',
            'provinsi' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required|numeric',
            'id_pengiriman' => 'required'
        ]);
        $selectedProductIds = is_array($request->selectedProducts) ? $request->selectedProducts : [$request->selectedProducts];

        $selectedProducts = Keranjang::whereIn('id_produk', $selectedProductIds)->get();

        $totalPrice = 0;
        foreach ($selectedProducts as $product) {
            $totalPrice += $product->total_harga;
            $pemesanan = new Pemesanan();
            $pemesanan->id_pembeli = auth()->user()->id;
            $pemesanan->id_produk = $product->id_produk;
            $pemesanan->total_harga = $totalPrice;
            $pemesanan->jumlah_produk = $product->jumlah_produk;
            $pemesanan->alamat = $request->alamat;
            $pemesanan->telp = $request->telp;
            $pemesanan->provinsi = $request->provinsi;
            $pemesanan->kota = $request->kota;
            $pemesanan->kode_pos = $request->kode_pos;
            $pemesanan->id_pengiriman = $request->id_pengiriman;
            $pemesanan->email = $request->email;
            $pemesanan->tgl_pemesanan = now();
            $pemesanan->save();

            $produk = Produk::find($product->id_produk);
            $produk->stok -= $product->jumlah_produk;
            $produk->save();
        }

        Keranjang::whereIn('id_produk', $selectedProductIds)->delete();

        return redirect()->route('home')->with(['success' => 'Berhasil melakukan pembelian!']);
    }
}
