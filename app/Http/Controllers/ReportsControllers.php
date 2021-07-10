<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;

class ReportsControllers extends Controller
{
    public function index($start, $end) {
        /**
         * SELECT p.name, p.price, p.amount FROM `order_products` as op 
         * inner join `orders` as o on o.id = op.order_id 
         * inner join `products` as p on p.id = op.product_id 
         * where op.created_at between '2021-01-01' and '2021-07-30' 
         * group by p.name 
         * order by p.amount desc 
         */
        try {
            $startDate = date($start);
            $endDate = date($end);

            $records = \DB::table('order_products')
                            ->join('orders', 'order_products.order_id', '=', 'orders.id')
                            ->join('products', 'order_products.product_id', '=', 'products.id')
                            ->whereBetween('order_products.created_at', [$startDate, $endDate])
                            ->groupBy('products.name', 'products.price', 'products.amount')
                            ->orderBy('products.amount', 'desc')
                            ->select('products.name', 'products.price', 'products.amount')
                            ->get();
            
            
            if (count($records) > 0) {
                return response()->json($records);
            }

            return response()->json([
                'message' => 'There are no products sold in this range of dates.'
            ]);
        } catch (\Exceptions $e) {
            return response()->json([
                'error' => 'Error at the moment to generate the report!',
                'message' => $e->getMessage()
            ]);
        }
    }
}
