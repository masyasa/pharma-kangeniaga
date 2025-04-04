<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'date',
        'status',
        'amount_paid',
        'proof',
        'notes'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
}
