<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getCartData()
    {
        $cartItems = Cart::with('product')->select(['id', 'product_id', 'user_id', 'quantity']);

        return DataTables::of($cartItems)
            ->addColumn('product_name', function ($cartItem) {
                return $cartItem->product->product_name;
            })
            ->addColumn('price', function ($cartItem) {
                return number_format($cartItem->product->price, 0, ',', '.');
            })
            ->addColumn('total_price', function ($cartItem) {
                return number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.');
            })
            ->addColumn('action', function ($cartItem) {
                $detailUrl = route('product.show', $cartItem->product_id);
                $deleteUrl = route('cart.destroy', $cartItem->id);

                return '<a href="' . $detailUrl . '" class="btn btn-info">Detail</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function clearCart()
    {
        $userId = Auth::id();

        Cart::where('user_id', $userId)->delete();

        return response()->json(['success' => true, 'message' => 'Cart cleared successfully.']);
    }

    public function addItem($id)
    {
        // Retrieve the product by its ID
        $product = Product::findOrFail($id);

        $user = Auth::user();

        // Check if the product is already in the cart
        $existingCartItem = Cart::where('product_id', $product->id)
                                ->where('user_id', $user->id)
                                ->first();

        if ($existingCartItem) {
            // If the product is already in the cart, increase its quantity
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            $cartItem = new Cart();
            $cartItem->product_id = $product->id;
            $cartItem->user_id = $user->id; // Associate the user with the cart item
            $cartItem->quantity = 1; // Set initial quantity to 1
            $cartItem->save();
        }

        // return redirect()->route('transaction.addTransaction')->with('success', 'Item added to cart successfully.');
        $cartData = $this->getCartData();
        return response()->json(['success' => true, 'message' => 'Item added to cart successfully.', 'cartData' => $cartData]);
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
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('transaction.addTransaction')->with('success', 'Item removed from cart successfully.');
    }
}
