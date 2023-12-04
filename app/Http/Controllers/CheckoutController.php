<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pemesanan;
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

        return view('pembeli.checkout', [
            'data_keranjang' => $data_keranjang,
            'title' => 'Checkout'
        ]);
    }

    public function checkout(Request $request)
    {
        $selectedProductIds = $request->input('selectedProducts');

        $selectedProducts = Keranjang::whereIn('id_produk', $selectedProductIds)
            ->join('produk', 'keranjang.id_produk', '=', 'produk.id')
            ->select('keranjang.*', 'produk.*')
            ->get();

        return view('pembeli.checkout', [
            'selectedProducts' => $selectedProducts,
            'title' => 'checkout'
        ]);
    }

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'rekening' => 'required|numeric',
            'telp' => 'required|numeric'
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
            $pemesanan->rekening = $request->rekening;
            $pemesanan->tgl_pemesanan = now();
            $pemesanan->save();
        }

        Keranjang::whereIn('id_produk', $selectedProductIds)->delete();

        return redirect()->route('home')->with(['success' => 'Berhasil melakukan pembelian!']);
    }
}
