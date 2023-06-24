<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        try {

            $request->validate([
                'items' => 'required|array',
                'items.*.product_id' => 'required|integer',
                'items.*.quantity' => 'required|integer',
                'total' => 'required|numeric',
            ]);

            $sale = Sale::create([
                'total' => $request->total,
            ]);

            foreach ($request->items as $item) {
                $product = Product::select('price')->find($item['product_id']);

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                ]);
            }

            return response()->json(['message' => 'Success!'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            \Log::error(__METHOD__, [
                'message' => 'Error creating sales record',
                'itens' => $request->all()
            ]);

            return response()->json(['message' => 'Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
