<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function showCheckoutForm(Request $request)
    {
        $selectedProducts = $request->input('selected_products', []);
        $totalPrice = $request->input('total_price', 0);

        return view('checkout', compact('selectedProducts', 'totalPrice'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'selected_products' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        // Simpan data pesanan ke database
        $order = Order::create([
            'user_id' => Auth::id(), // Ambil ID pengguna yang sedang login
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

       // Simpan data order items
        foreach ($request->selected_products as $product) {
            $order->items()->create([
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        // Redirect ke halaman pembayaran atau konfirmasi
        return redirect()->route('payment.show', ['order_id' => $order->id]);
        }


}
