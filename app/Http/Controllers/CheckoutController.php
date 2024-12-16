<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Midtrans\Config;
use Midtrans\Snap;
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

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi untuk Midtrans
        $transactionDetails = [
            'order_id' => 'ORDER-' . $order->id, // Gunakan ID order yang unik
            'gross_amount' => $order->total_price, // Total harga
        ];

        // Data item yang akan dikirim ke Midtrans
        $itemDetails = [];
        foreach ($order->items as $item) {
            $itemDetails[] = [
                'id' => $item->product_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->productname, // Nama produk
            ];
        }

        // Data pembeli
        $customerDetails = [
            'first_name' => $request->name,
            'email' => Auth::user()->email, // Email pengguna (diasumsikan dari tabel users)
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Payload untuk Snap Midtrans
        $payload = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Generate Snap Token
        try {
            $snapToken = Snap::getSnapToken($payload);

            // Redirect ke halaman pembayaran Midtrans
            return view('payment.snap', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to process payment. Please try again.']);
        }
    }
}
