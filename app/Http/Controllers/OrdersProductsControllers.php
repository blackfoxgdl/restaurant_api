<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Order;

class OrdersProductsControllers extends Controller
{
    //
    static function createOrderProduct($id, $products) {
        $total = 0;
        $finalProd = [];
        $producto = \DB::table('products')
                        ->whereIn('name', $products)
                        ->get();

        foreach ($producto as $prod) {
            OrderProduct::create(['order_id' => $id, 'product_id' => $prod->id]);

            $total += floatval($prod->price);

            $singleProd = Product::find($prod->id);
            $singleProd->amount = intval($singleProd->amount) + 1;
            $singleProd->save();

            $finalProd[] = array(
                'name' => $singleProd->name,
                'total' => $singleProd->price
            );
        }

        $order = Order::find($id);
        $order->total = $total;
        $order->save();

        $response = array(
            'order_id' => $order->id,
            'total' => $total,
            'products' => $finalProd
        );
        
        return $response;
    }
}
