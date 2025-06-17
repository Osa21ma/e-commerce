<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request){

        $cart = session()->get('cart');
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->save();

        foreach($cart as $productId=>$item)
        {
            $orderItem= new OrderItems();
            $orderItem->order_id=$order->id;
            $orderItem->product_id = $productId;
            $orderItem->quantity = $item['quantity'];
            $orderItem->total = $item['price'] * $item['quantity'];
            $orderItem->save();
        }

        session()->forget('cart');
        return redirect('home');
    }
}
