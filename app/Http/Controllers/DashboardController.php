<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch the number of transactions today
        $transactionCountToday = Transaction::whereDate('created_at', Carbon::today())->count();

        // Fetch the income of the current month
        $incomeThisMonth = Transaction::whereMonth('created_at', Carbon::now()->month)->sum('total_transaction');

        // Fetch the total product variety
        $totalProductVariety = Product::count();

        // Fetch the total number of products sold
        $totalProductsSold = Transaction::join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->sum('transaction_details.product_quantity');

        // Fetch the product data sold during the selected date range
        $productsSold = Product::leftJoin('transaction_details', 'products.id', '=', 'transaction_details.product_id')
        ->selectRaw('products.*, SUM(transaction_details.product_quantity) as quantity')
        ->groupBy('products.id')
        ->get();

        // return $productsSold;

        return view('dashboard.index', compact('transactionCountToday', 'incomeThisMonth', 'totalProductVariety', 'totalProductsSold', 'productsSold'));
    }

    public function chartData(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // If start date is not provided, default to today's date
        if (!$startDate) {
            $startDate = Carbon::today()->toDateString();
        }

        // If end date is not provided, default to today's date
        if (!$endDate) {
            $endDate = Carbon::today()->toDateString();
        }

        // Fetch transaction data based on the provided date range
        $transactionData = Transaction::where('status_transaksi', 'Success')
            ->whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->get(['created_at'])
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d-m-Y');
            })
            ->map(function ($item) {
                return $item->count();
            });

        // Extract labels and transaction count data
        $labels = $transactionData->keys()->toArray();
        $transactionData = $transactionData->values()->toArray();

        // Calculate total transaction count and amount for the provided date range
        $totalTransactionCount = Transaction::where('status_transaksi', 'Success')
        ->whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->count();
        $totalTransactionAmount = Transaction::where('status_transaksi', 'Success')
        ->whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->sum('total_transaction');

        return response()->json([
            'labels' => $labels,
            'transactionData' => $transactionData,
            'totalTransactionCount' => $totalTransactionCount,
            'totalTransactionAmount' => $totalTransactionAmount,
        ]);
    }

    public function productData(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // If start date is not provided, default to today's date
        if (!$startDate) {
            $startDate = Carbon::today()->toDateString();
        }

        // If end date is not provided, default to today's date
        if (!$endDate) {
            $endDate = Carbon::today()->toDateString();
        }

        // Fetch product data sold during the selected date range
        $productsSold = Product::leftJoin('transaction_details', 'products.id', '=', 'transaction_details.product_id')
        ->whereBetween('transaction_details.created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->selectRaw('products.*, SUM(transaction_details.product_quantity) as quantity')
            ->groupBy('products.id')
            ->get();

        return response()->json([
            'productsSold' => $productsSold,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
