<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Retrieve the uploaded file
        $image = $request->file('image');

        // Generate a unique name for the file
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Move the file to the public/images directory
        $image->move(public_path('payments'), $imageName);

        Transaction::create([
            'order_id' => $request->order_id,
            'payment_proof' => $imageName
        ]);
        // Optional: Return a success message or save the filename to the database
        return back()->with('success', 'Berhasil upload bukti pembayaran!')->with('image', $imageName);
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
