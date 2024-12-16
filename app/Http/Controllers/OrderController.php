<?php
namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::where('status', 'waiting verification')->get();
    return view('admin.orders.index', compact('orders'));
}

public function verify(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:processed,rejected',
    ]);

    $order->update([
        'status' => $request->status,
    ]);

    return redirect()->route('admin.orders')->with('success', 'Order status updated successfully.');
}
}
?>