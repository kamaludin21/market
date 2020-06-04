<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use Auth;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customer = Customer::where('idUser', Auth::user()->id)->get();
        $products = Product::orderBy('products.created_at', 'desc')->get();
        return view('katalog', ['products' => $products, 'customer' => $customer]);
    }
}
