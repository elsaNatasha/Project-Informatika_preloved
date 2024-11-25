<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan periode waktu
        $filter = $request->input('filter', 'bulanan');
        $month = $request->input('month', date('n'));

        // Ambil transaksi berdasarkan filter
        if ($filter == 'bulanan') {
            $transactions = Transaction::whereMonth('created_at', $month)->get();
        } elseif ($filter == 'mingguan') {
            $transactions = Transaction::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->get();
        } else {
            $transactions = Transaction::all();
        }

        // Hitung total pemasukan, barang terjual, dan barang dibatalkan
        $totalRevenue = $transactions->where('status', 'terjual')->sum('amount');
        $itemsSold = $transactions->where('status', 'terjual')->count();
        $itemsCancelled = $transactions->where('status', 'dibatalkan')->count();

        return view('financial-report.index', compact('transactions', 'totalRevenue', 'itemsSold', 'itemsCancelled', 'filter', 'month'));
    }
}