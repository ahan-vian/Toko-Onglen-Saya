<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        "name",
        "price",
        "description",
        "image",
        "stock",
    ];

    public function carts(){
        return $this->hasMany(Product::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
