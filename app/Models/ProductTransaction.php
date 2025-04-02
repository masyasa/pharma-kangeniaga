<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $fillabel = [
        'product_transaction_id',
        'product_id',
        'price'

    ];
}
