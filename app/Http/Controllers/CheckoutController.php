<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Support\Facades\Log;


class CheckoutController extends Controller
{
    public function showCheckoutForm(Request $request)
    {
        // Dekode produk yang dipilih
        $selectedProductIds = json_decode($request->input('selected_products'));

        // Ambil produk yang sesuai dari database
        $selectedProducts = Products::whereIn('id', $selectedProductIds)->get();

        $totalPrice = $request->input('total_price');

        return view('cart.checkout', compact('selectedProducts', 'totalPrice'));
    }


    public function processCheckout(Request $request)
    {
        Log::info('HTTP Method:', [$request->method()]);
        Log::info('Request Data: ', $request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'selected_products' => 'required|array',
            'quantities' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        $selectedProducts = json_decode($request->selected_products, true);
        $quantities = $request->quantities;

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        foreach ($selectedProducts as $productId) {
            $product = Products::findOrFail($productId);
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantities[$productId] ?? 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index', ['order_id' => $order->id]);
    }


}
