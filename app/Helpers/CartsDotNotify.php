<?php

use App\Transaction;

function CartsDotNotify($id)
{
    $checkCart = Transaction::where([
        ['idUser', '=', $id],
        ['status', '=', 'cart']
    ])->get();

    if ($checkCart->isEmpty()) {
        return "";
    } else {
        return "dot";
    }
}
