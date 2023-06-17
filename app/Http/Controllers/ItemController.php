<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function addItem(ItemRequest $request)
    {
        $product = Product::find($request->product_id);
        $items = session()->has('items') ? session()->get('items') : [];
        if ($items[$product->id] ?? false) {
            $items[$product->id]['quantity'] += $request->quantity;
            $items[$product->id]['total_amount'] = $items[$product->id]['quantity'] * $product->price;
        } else {
            $total_amount = $product->price * $request->quantity;
            $item = [
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'total_amount' => $total_amount,
            ];
            $items[$product->id] = $item;
        }
        session()->put('items', $items);
        return redirect('/home')->with('status', [
            'message' => 'Item added to cart'
        ]);
    }

    public function deleteItem($id)
    {
        session()->forget('items.' . $id);
        return redirect('/home')->with('status', [
            'message' => 'Item deleted from cart'
        ]);
    }
}
