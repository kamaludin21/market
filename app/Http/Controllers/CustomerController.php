<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Customer;
use Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = DB::table('customers')
                    ->join('users', 'customers.idUser', '=', 'users.id')
                    ->get();
        return view('customer.index', ['customers' => $customers]);
    }

    public function store(Request $request)
    {
        $customer = Customer::firstOrCreate([
            'idUser' => Auth::user()->id,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]);

        if ($customer->wasRecentlyCreated) {
            return redirect('katalog')->with('success', 'Berhasil, selamat berbelanja');
        } else {
            return redirect('katalog')->with('danger', 'Gagal registrasi');
        }
    }
}
