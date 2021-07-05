<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductsControllers extends Controller
{
    // Get all products
    public function index() {
        $products = Product::all();

        return response()->json($products);
    }

    // Get specific product
    public function show($id) {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'name' => $product->name,
                'price' => $product->price,
                'amount' => $product->amount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid product!',
                'message' => 'The product does not exists!'
            ]);
        }
    }

    // Post new product
    public function store(Request $request) {
        try {
            // Validate
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'amount' => 'required'
            ]);

            if ($validate->fails()) {
                $product = $request->all();
                $newProd = Product::create($product);

                return response()->json([
                    'message' => 'The product was created successfully!',
                    'id' => $newProd->id,
                    'name' => $newProd->name,
                    'price' => $newProd->price,
                    'amount' => $newProd->amount
                ]);
            }

            return response()->json([
                'error' => 'Error with some data!',
                'message' => $validate->errors()
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'Invalid request!',
                'message' => $e->getMessage()
            ]);
        }
    }

    // Upodate new prodict
    public function update(Request $request, $id) {
        // TODO
    }

    // Delete product
    public function delete($id) {
        // TODO
    }
}
