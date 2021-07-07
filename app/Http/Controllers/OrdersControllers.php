<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\OrdersProductsControllers;

class OrdersControllers extends Controller
{
    //Get all the orders
    public function index() {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function show($id) {
        try {
            $order = Order::findOrFail($id);

            return response()->json([
                'name' => $order->name,
                'total' => $order->total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid Record',
                'message' => 'The Order does not exists!'
            ]);
        }
    }

    public function store(Request $request) {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'products' => 'required'
            ]);

            if (!$validate->fails()) {
                //Check products exists 
                $totalRecords = $this->existsProducts($request->input('products'));

                if (!$totalRecords) {
                    return response()->json([
                        'error' => 'Products not availables!',
                        'message' => 'There are no products availables in the order. Please verify the products added in the order.'
                    ]);
                }
            
                // insert the values in orders
                $order_name = $request->all();
                $products = $request->input('products');

                $order = Order::create($order_name);
                $total = OrdersProductsControllers::createOrderProduct($order->id, $products);
                $order->total = $total;
                $order->save();
                

                return response()->json([
                    'message' => 'The order has been received',
                    'order' => $order->id,
                    'total' => $total,
                    'products' => $products
                ]);
            }

            return response()->json([
                'error' => 'Error with some data!',
                'message' => $validate->errors()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid Request!',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id) {
        // TODO
    }

    public function delete($id) {
        // TODO
    }

    /**
     * Check products exists
     */
    private function existsProducts($products) {
        $total = \DB::table('products')
                    ->whereIn('name', $products)
                    ->count();

        return $total === count($products);
    }
}
