<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('users', 'transactions.idUser', '=', 'users.id')
            ->join('customers', 'transactions.idCustomer', '=', 'customers.id')
            ->where('transactions.status', '=', 'checkout')
            ->select('transactions.*', 'users.name', 'customers.telepon', 'customers.alamat')
            ->paginate(5);

        return view('transaksi.index', ['transactions' => $transactions]);
    }

    public function detail($ticket)
    {
        $transaction = DB::table('transactions')
            ->join('users', 'transactions.idUser', '=', 'users.id')
            ->join('customers', 'transactions.idCustomer', '=', 'customers.id')
            ->join('products', 'transactions.idProduct', '=', 'products.id')
            ->where('transactions.ticket', '=', $ticket)
            ->select('transactions.*', 'users.name', 'products.title', 'products.price', 'customers.telepon', 'customers.alamat')
            ->get();
        return view('transaksi.detail', ['transaction' => $transaction]);
    }
}
