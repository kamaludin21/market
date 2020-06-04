<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'ticket', 'idUser', 'idCustomer', 'idProduct', 'jumlah', 'status'
    ];
}
