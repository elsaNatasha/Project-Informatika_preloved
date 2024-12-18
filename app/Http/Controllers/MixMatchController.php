<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MixMatchRecommendations;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Cart;

class MixMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($products);
        $datas = MixMatchRecommendations::join('products as top', 'mix_match_recommendations.top_id', '=', 'top.id')
            ->join('products as bottom', 'mix_match_recommendations.bottom_id', '=', 'bottom.id')
            ->select(
                'mix_match_recommendations.id',
                'top.productname as top_name',
                'top.description as top_desc',
                'top.photo as top_photo',
                'bottom.productname as bottom_name',
                'bottom.description as bottom_desc',
                'bottom.photo as bottom_photo'
            )->get();
            
        return view("pages.mix-match.index", compact('datas'));
    }

    public function kustomisasi()
    {
        // $products = Product::get();
        $products = Product::with('category', 'favorites')->get();
        $tops = Product::whereIn('cat_id', ['2', '4', '5', '6', '10', '11'])->get();
        $bottoms = Product::whereIn('cat_id', ['7', '8', '9', '12'])->get();

        $favorites = Favorite::where('user_id', auth()->id())->get();
        $carts = Cart::where('user_id', auth()->id())->get();

        $newArr = $products->map(function($item) use (&$favorites, &$carts) {
            $item['isFavorite'] = $favorites->firstWhere('product_id', $item->id) ? true : false;
            $item['isAddedCart'] = $carts->firstWhere('product_id', $item->id) ? true : false;
            return $item;
        });

        $products = $newArr;
        
        return view("pages.mix-match.kustomisasi", compact("products", "tops", "bottoms"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
