<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;


class CheckoutController extends Controller
{

    public function store(Request $request)
    {
        dd($request);
    }

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
        // dd(Auth::user()->id);

        $produk = Cart::where('user_id', Auth::user()->id)->get();
        dd($produk);

        Log::info('HTTP Method:', [$request->method()]);
        Log::info('Request Data: ', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            // 'selected_products' => 'array',
            'quantities' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        // Simpan data order ke database
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'status' => 'pending', // Status default
        ]);

        $selectedProducts = json_decode($request->selected_products, true);
        $quantities = $request->quantities;

        foreach ($selectedProducts as $productId) {
            $product = Products::findOrFail($productId);
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantities[$productId] ?? 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('checkout.show')->with('success', 'Order created successfully. Please upload your payment proof.');
    }

    public function uploadPaymentProof(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        $order = Order::findOrFail($request->order_id);

        // Upload file bukti pembayaran
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'payment_proof_' . $order->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/payment_proofs', $filename);

            // Simpan nama file ke dalam database
            $order->update([
                'payment_proof' => $filename,
                'status' => 'waiting verification', // Update status
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Payment proof uploaded successfully. Please wait for verification.');
    }

}
