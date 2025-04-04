<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'address',
        'courier',
        'tracking_number',
        'status',
        'shipped_date',
        'delivered_date'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
