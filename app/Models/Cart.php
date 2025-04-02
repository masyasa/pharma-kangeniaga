<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];
    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
