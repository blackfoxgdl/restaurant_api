<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Order;
use App\Model\Product;

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
        dd($request);
        // try {

        //     dd($request);
        //     //$validate = Validator::make($request->all(), []);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'error' => 'Error with the order!',
        //         'message' => 'The order has not been created!'
        //     ]);
        // }
    }

    public function update(Request $request, $id) {
        // TODO
    }

    public function delete($id) {
        // TODO
    }
}
