<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;

class Category extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
