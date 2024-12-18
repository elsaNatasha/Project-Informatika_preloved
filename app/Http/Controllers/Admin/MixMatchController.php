<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MixMatchRecommendations;
use App\Models\Product;

class MixMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $tops = Product::whereIn('cat_id', ['2', '4', '5', '6', '10', '11'])->get();
        $bottoms = Product::whereIn('cat_id', ['7', '8', '9', '12'])->get();
        // dd($tops);
        return view('pages.admin.mix-match.index', compact('datas', 'tops', 'bottoms'));
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
        // dd($request->all());
        $request->validate([
            'top' => 'required',
            'bottom' => 'required',
        ]);

        MixMatchRecommendations::create([
            'top_id' => $request->top,
            'bottom_id' => $request->bottom,
        ]);

        session()->flash('success', 'Mix & match berhasil ditambahkan!');
        return redirect()->route('admin.mix-match');
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
        $data = MixMatchRecommendations::findOrFail($id);
        $data->delete();

        session()->flash('success', 'Mix & match berhasil dihapus!');
        return redirect()->route('admin.mix-match');
    }
}
