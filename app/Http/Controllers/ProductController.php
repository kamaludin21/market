<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = DB::table('products')
                    ->join('categories', 'products.idCategory', '=', 'categories.id')
                    ->orderBy('products.created_at', 'desc')
                    ->select('products.*', 'categories.title as kategori')
                    ->paginate(5);
        $categories = Category::all();
        return view('produk.index', ['products' => $products, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'idCategory' => 'required',
            'title' => 'required',
            'price' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension_image = $image->getClientOriginalExtension();
            $filename_image = rand().'.'.$extension_image;
            $image->move('img/produk', $filename_image);
            $image = $filename_image;
        }
        $product = Product::firstOrCreate([
            'idCategory' => $request->idCategory,
            'title' => $request->title,
            'price' => $request->price,
            'image' => $image
        ]);
        if ($product->wasRecentlyCreated) {
            return redirect('produk')->with('success', 'Produk berhasil ditambah');
        } else {
            return redirect('produk')->with('danger', 'Produk '.$request->title.' sudah ada, tambah dengan data yang berbeda');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('produk.edit', ['product' => $product, 'categories' => $category]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->idCategory = $request->idCategory;
        $product->title = $request->title;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            unlink('img/produk/'.$product->image);

            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'idCategory' => 'required',
                'title' => 'required',
                'price' => 'required'
            ]);

            $image = $request->file('image');
            $extension_image = $image->getClientOriginalExtension();
            $filename_image = rand().'.'.$extension_image;
            $image->move('img/produk', $filename_image);
            $product->image = $filename_image;
        }

        $product->save();
        return redirect('produk')->with('success', 'Produk berhasil diubah');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        unlink('img/produk/'.$product->image);
        $product->delete();
        return redirect('produk')->with('success', 'Produk berhasil dihapus');
    }
}
