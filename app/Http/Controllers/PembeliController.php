<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    function index()
    {
        $data_produk = Produk::all();
        return view('pembeli.index', [
            'data_produk' => $data_produk,
            'title' => 'Home',
        ]);
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            return redirect('pembeli');
        } else {
            return redirect(route('pembeli.login'))->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    public function regist()
    {
        return view('pembeli.regist');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'status' => 'required|in:tersedia,habis',
            'alamat' => 'required',
            'telepon' => 'required|max:15|numeric'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Pembeli::create($validatedData);

        return redirect()->route('pembeli.login')->with('success', 'Registration successfull! Please login');
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
