<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total',
    ];

    public function orders() {
        return $this->hasMany(Order_Product::class);
    }
}
