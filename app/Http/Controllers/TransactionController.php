<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.index');
    }

    public function getDataTransaction(Request $request)
    {
        // Default to today's date if no date is provided
        $startDate = $request->startDate ? Carbon::createFromFormat('Y-m-d', $request->startDate)->startOfDay() : now()->startOfDay();
        $endDate = $request->endDate ? Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfDay() : now()->endOfDay();

        $transactions = Transaction::with(['user', 'customer'])
        ->whereBetween('created_at', [$startDate, $endDate])
            ->select(['id', 'custom_id', 'total_transaction', 'user_id', 'customer_id', 'created_at']);

        $transactionCount = $transactions->count();
        $totalTransaction = $transactions->sum('total_transaction');

        return DataTables::of($transactions)
            ->addColumn('action', function ($transaction) {
                return '<a href="' . route('transaction.show', ['transaction' => $transaction->id]) . '" class="btn btn-primary">Transaction Detail</a>';
            })
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at->format('H:i | d-m-Y');
            })
            ->editColumn('total_transaction', function ($transaction) {
                return 'Rp ' . number_format($transaction->total_transaction, 0, ',', '.');
            })
            ->addColumn('customer_name', function ($transaction) {
                return '<span style="text-transform: capitalize;">' . $transaction->customer->customer_name . '</span>';
            })
            ->rawColumns(['customer_name', 'action'])
            ->with('transactionCount', $transactionCount)
            ->with('totalTransaction', $totalTransaction)
            ->make(true);
    }


    public function getData(Request $request)
    {
        $categoryId = $request->get('category_id');
        $products = Product::select(['id', 'product_name', 'product_quantity', 'price']);

        if ($categoryId) {
            $products = $products->where('category_id', $categoryId);
        }

        return DataTables::of($products)
            ->editColumn('price', function ($product) {
                return number_format($product->price, 0, ',', '.');
            })
            ->editColumn('product_quantity', function ($product) {
                if ($product->product_quantity <= 4) {
                    return $product->product_quantity . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#bfc200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>';
                } else {
                    return $product->product_quantity;
                }
            })
            ->addColumn('action', function ($product) {
                if ($product->product_quantity == 0) {
                    return '<button class="btn btn-danger" disabled>Barang Habis</button>';
                } else {
                    return '<button class="btn btn-info add-to-cart" data-product-id="' . $product->id . '">Add to Cart</button>';
                }
            })
            ->rawColumns(['product_quantity', 'action'])
            ->make(true);
    }



    public function addTransaction()
    {
        $categories = Category::all(); // Asumsikan Anda memiliki model Category untuk mengambil data kategori

        return view('transactions.add-transaction', compact('categories'));
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
        // Tetapkan nilai default jika tidak ada input
        $customerName = $request->input('customer_name') ?: 'no name';
        $customerPhone = $request->input('customer_phone') ?: 'no phone number';

        // Buat atau temukan customer
        $customer = Customer::firstOrCreate(
            ['customer_phone' => $customerPhone],
            ['customer_name' => $customerName]
        );

        // Get user first name initials
        $user = Auth::user();
        $userFirstName = $user->name;
        $initials = strtoupper(substr($userFirstName, 0, 2));

        // Get current date components
        $date = now()->format('dmy');

        // Get today's transaction count for this user
        $todayTransactionCount = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        // Format the transaction count as a four-digit number
        $transactionNumber = str_pad($todayTransactionCount, 4, '0', STR_PAD_LEFT);

        // Generate the custom ID
        $customId = $initials . $date . $transactionNumber;

        // Create transaction
        $transaction = Transaction::create([
            'custom_id' => $customId,
            'user_id' => $user->id,
            'customer_id' => $customer->id,
            'status_transaksi' => 'Success',
            'total_transaction' => $request->totalTransaction,
        ]);

        // Create transaction details
        foreach ($request->products as $product) {
            $productDetails = Product::find($product['id']);

            $productDetails->product_quantity -= $product['quantity'];
            $productDetails->save();
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $productDetails->id,
                'product_name' => $productDetails->product_name,
                'product_quantity' => $product['quantity'],
                'total_purchase' => $product['total_price']
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        // Redirect or return success response
        return redirect()->route('transaction.index')->with('success', 'Transaction completed successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with('transactionDetails')
                                    ->with('user')
                                    ->with('customer')
                                    ->find($id);

        return view('transactions.transaction-detail',[
            'transaction' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::with('transactionDetails')
                                    ->with('user')
                                    ->with('customer')
                                    ->find($id);

        return view('transactions.transaction-edit',
        [
            'transaction' => $transaction,
        ]);
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
        DB::beginTransaction();

        try {
            $transaction = Transaction::findOrFail($id);

            // Validate request data
            $validatedData = $request->validate([
                'productIds' => 'required|array',
                'product_quantities' => 'required|array',
                'transaction_detail_ids' => 'nullable|array',
                'status' => 'required|string|in:Success,Failed'
            ]);

            $newStatus = $validatedData['status'];
            $currentStatus = $transaction->status_transaksi;
            $totalTransaction = 0;

            // Check for status change and update product quantities accordingly
            if ($currentStatus != $newStatus) {
                foreach ($transaction->transactionDetails as $detail) {
                    $product = $detail->product;
                    if ($currentStatus == 'Success' && $newStatus == 'Failed') {
                        // Return products to stock
                        $product->product_quantity += $detail->product_quantity;
                    } elseif ($currentStatus == 'Failed' && $newStatus == 'Success') {
                        // Check stock availability before reducing
                        if ($product->product_quantity < $detail->product_quantity) {
                            throw new \Exception('Insufficient stock for product: ' . $product->product_name);
                        }
                        $product->product_quantity -= $detail->product_quantity;
                    }
                    $product->save();
                }
                $transaction->status_transaksi = $newStatus;
            }

            $existingDetailIds = $transaction->transactionDetails->pluck('id')->toArray();

            // Remove items not included in the request
            foreach ($transaction->transactionDetails as $detail) {
                if (!in_array($detail->id, $validatedData['transaction_detail_ids'])) {
                    // If item is not in the request, remove it
                    $product = $detail->product;
                    if ($currentStatus == 'Success') {
                        $product->product_quantity += $detail->product_quantity;
                    }
                    $detail->delete();
                    $product->save();
                }
            }

            foreach ($validatedData['productIds'] as $index => $productId) {
                $quantity = $validatedData['product_quantities'][$index];
                $transactionDetailId = $validatedData['transaction_detail_ids'][$index] ?? null;

                $product = Product::findOrFail($productId);
                $currentPrice = $product->price;

                if ($transactionDetailId === null) {
                    // Add new transaction detail
                    if ($newStatus == 'Success' && $product->product_quantity < $quantity) {
                        throw new \Exception('Insufficient stock for product: ' . $product->product_name);
                    }

                    $totalPurchase = $quantity * $currentPrice;
                    $transaction->transactionDetails()->create([
                        'product_id' => $productId,
                        'product_name' => $product->product_name,
                        'product_quantity' => $quantity,
                        'total_purchase' => $totalPurchase
                    ]);

                    if ($newStatus == 'Success') {
                        $product->product_quantity -= $quantity;
                    }
                    $product->save();
                    $totalTransaction += $totalPurchase;
                } else {
                    // Update existing transaction detail
                    $transactionDetail = $transaction->transactionDetails()->findOrFail($transactionDetailId);

                    if ($quantity == 0) {
                        // Remove the transaction detail
                        if ($currentStatus == 'Success') {
                            $product->product_quantity += $transactionDetail->product_quantity;
                        }
                        $transactionDetail->delete();
                        $product->save();
                    } else {
                        // Update the transaction detail
                        $originalQuantity = $transactionDetail->product_quantity;
                        $totalPurchase = $quantity * $currentPrice;

                        if ($newStatus == 'Success' && $product->product_quantity + $originalQuantity < $quantity) {
                            throw new \Exception('Insufficient stock for product: ' . $product->product_name);
                        }

                        $transactionDetail->update([
                            'product_quantity' => $quantity,
                            'total_purchase' => $totalPurchase
                        ]);

                        if ($newStatus == 'Success') {
                            $product->product_quantity += $originalQuantity - $quantity;
                        }
                        $product->save();
                        $totalTransaction += $totalPurchase;
                    }
                }
            }

            // Update transaction total and status
            $transaction->update([
                'total_transaction' => $totalTransaction,
                'status_transaksi' => $newStatus
            ]);

            DB::commit();

            return redirect()->route('transaction.show', $id)->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Transaction Update Error: ', [
                'transaction_id' => $id,
                'message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while updating the transaction. Please try again.');
        }
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
