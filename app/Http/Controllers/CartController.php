<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Transaction;
use App\Customer;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myCart()
    {
        $myCart = DB::table('transactions')
            ->join('users', 'transactions.idUser', '=', 'users.id')
            ->join('customers', 'transactions.idCustomer', '=', 'customers.id')
            ->join('products', 'transactions.idProduct', '=', 'products.id')
            ->where([
                ['transactions.idUser', '=', Auth::user()->id],
                ['transactions.status', '=', 'cart']
            ])
            ->select('transactions.*', 'users.name', 'products.title', 'products.price', 'customers.telepon', 'customers.alamat')
            ->get();
        return view('customer.cart', ['carts' => $myCart]);
    }

    public function create(Request $request, $idProduct)
    {
        $idUser = Auth::user()->id;
        $customer = Customer::where('idUser', $idUser)->first();
        $checkCart = Transaction::where([
            ['idUser', '=', $idUser],
            ['status', '=', 'cart']
        ])->get();

        if ($checkCart->isEmpty()) {
            $newCart = Transaction::firstOrCreate([
                'ticket' => strtoupper(Str::random(6)),
                'idUser' => $idUser,
                'idCustomer' => $customer->id,
                'idProduct' => $idProduct,
                'jumlah' => 1,
                'status' => 'cart'
            ]);
            return redirect('katalog')->with('success', 'Product berhasil masuk keranjang');
        } else {
            $getIdleCart = Transaction::where([
                ['idUser', '=', $idUser],
                ['status', '=', 'cart']
            ])->first();

            $getProductStatus = Transaction::where('ticket', '=', $getIdleCart->ticket)
            ->where(function ($query) use ($idProduct) {
                $query->where('idProduct', '=', $idProduct);
            })->get();

            if ($getProductStatus->isEmpty()) {
                Transaction::firstOrCreate([
                    'ticket' => $getIdleCart->ticket,
                    'idUser' => $idUser,
                    'idCustomer' => $customer->id,
                    'idProduct' => $idProduct,
                    'jumlah' => 1,
                    'status' => 'cart'
                ]);
                return redirect('katalog')->with('success', 'Product baru berhasil masuk keranjang');
            } else {
                $getProduct = Transaction::where('ticket', '=', $getIdleCart->ticket)
                ->where(function ($query) use ($idProduct) {
                    $query->where('idProduct', '=', $idProduct);
                })->first();

                $update = Transaction::where('id', $getProduct->id)
                ->update(['jumlah' => $getProduct->jumlah+1]);
                return redirect('katalog')->with('success', 'Menambah jumlah product didalam cart');
            }
        }
    }

    public function checkout($ticket)
    {
        $checkout = Transaction::where('ticket', $ticket)->update(['status' => 'checkout']);
        return redirect('customer/mytransaksi')->with('success', 'Berhasil checkout');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect('customer/cart')->with('success', 'Produk berhasil dihapus');
    }
}
