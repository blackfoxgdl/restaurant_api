<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;
use App\Models\Product;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id'
    ];

    public function orders() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function products() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
