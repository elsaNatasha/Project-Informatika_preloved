<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        // dd($orders);
        return view('pages.orders.index', compact('orders'));
        // $orders = Order::where('status', 'waiting verification')->get();
        // return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'telp' => 'required|numeric',
            'alamat' => 'required',
            'produk' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Order::create([
                'user_id' => auth()->id(),
                'name' => $request->nama,
                'phone' => $request->telp,
                'address' => $request->alamat,
                'status' => 'pending'
            ]);

            $lastOrder = Order::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->first()->id;
                
            $arrReqIdProduk = $request->produk;
            $arrIdProduk = explode(',', $arrReqIdProduk);
            
            foreach ($arrIdProduk as $arr) {
                OrderItem::create([
                    'order_id' => $lastOrder,
                    'product_id' => $arr,
                    'quantity' => 1
                ]);
            }

            Cart::where('user_id', auth()->id())
                ->whereIn('product_id', $arrIdProduk)
                ->delete();

            DB::commit();

            return back()->with('success', 'Berhasil order, silahkan cek halaman pesanan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal melakukan checkout.']);
            // throw $th;
        }
    }

    public function show($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);
        $products = OrderItem::join('products as p', 'p.id', '=', 'order_items.product_id')
            ->where('order_id', $id)
            ->select('p.productname', 'p.price')
            ->get();

            $isPay = count(Transaction::where('order_id', $id)->get()) > 0;
            // dd($isPay);
        // dd($products);
        return view('pages.orders.show', compact('id', 'order', 'products', 'isPay'));
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
