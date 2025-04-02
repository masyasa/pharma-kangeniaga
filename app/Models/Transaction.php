<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_amount',
        'is_paid',
        'address',
        'city',
        'post_code',
        'phone_number',
        'proof',
        'notes'
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
}
