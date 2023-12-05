<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pemesanan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

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
        }



        // Set your Merchant Server Key
        MidtransConfig::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = config('midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        $transactionId = Pemesanan::where('status', 'pending')->get();

        return view('pembeli.payment', [
            'snapToken' => $snapToken,
            'totalPrice' => $totalPrice,
            'transactionId' => $transactionId,
            'title' => 'Payment'
        ]);
    }

    public function success(Pemesanan $transaction)
    {
        $transaction->status = 'dibayar';
        $transaction->save();

        $stokLatest = $transaction->produk->stok - $transaction->jumlah_barang;

        Produk::where('id', $transaction->produk->id)->update([
            'stok' => $stokLatest,
        ]);

        return view('pembeli.index', [
            'transaksis' => Pemesanan::latest()->get(),
        ])->with('success-payment', 'Pembayaran Berhasil');
    }
}
