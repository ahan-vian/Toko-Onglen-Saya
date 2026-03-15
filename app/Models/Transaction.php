<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'amount',
    ];

    public function product(){
        return $this->hasOne(Product::class);
    }

    public function order(){
        return $this->hasOne(Order::class);
    }
}
