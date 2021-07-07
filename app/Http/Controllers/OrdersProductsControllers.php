<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\OrderProduct;

class OrdersProductsControllers extends Controller
{
    //
    static function createOrderProduct($id, $products) {
        $total = 0;
        $producto = \DB::table('products')
                        ->whereIn('name', $products)
                        ->get();

        foreach ($producto as $prod) {
            OrderProduct::create(['order_id' => $id, 'product_id' => $prod->id]);

            $total += floatval($prod->price);
        }
        
        return $total;
    }
}
