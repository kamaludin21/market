<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = DB::table('categories')
                    ->leftJoin('products', 'categories.id', '=', 'products.idCategory')
                    ->select('categories.*', DB::raw("COUNT(products.title) as jumlahProduk"))
                    ->groupBy('categories.id')
                    ->orderBy('categories.created_at', 'desc')
                    ->paginate(5);

        return view('kategori.index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $category = Category::firstOrCreate([
            'title' => $request->title
          ]);

        if ($category->wasRecentlyCreated) {
            return redirect('kategori')->with('success', 'Kategori berhasil ditambah');
        } else {
            return redirect('kategori')->with('danger', 'Kategori '.$request->title.' sudah ada, tambah dengan data yang berbeda');
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('kategori.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->save();
        return redirect('kategori')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
