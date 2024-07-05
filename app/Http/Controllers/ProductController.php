<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    public function getProductsData()
    {
        $products = Product::select(['id', 'product_name', 'product_quantity', 'price']);

        return DataTables::of($products)
            ->addColumn('total_price', function ($product) {
                return number_format($product->price, 0, ',', '.');
            })
            ->addColumn('action', function ($product) {
                return '<button type="button" class="btn btn-info add-product" data-product-id="' . $product->id . '" data-product-name="' . $product->product_name . '" data-product-quantity="' . $product->product_quantity . '" data-product-price="' . $product->price . '">Add</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getData()
    {
        $products = Product::select(['id', 'product_name', 'product_quantity', 'price']);

        return DataTables::of($products)
            ->editColumn('price', function ($product) {
                return number_format($product->price, 0, ',', '.');
            })
            ->addColumn('action', function ($product) {
                $detailUrl = route('product.show', $product->id);
                $deleteUrl = route('product.destroy', $product->id);
                $restoreUrl = route('product.restore', $product->id);

                $actionButtons = '<a href="' . $detailUrl . '" class="btn btn-info">Detail</a>';

                if ($product->trashed()) {
                    $actionButtons .= ' <a href="' . $restoreUrl . '" class="btn btn-success">Restore</a>';
                } else {
                    $actionButtons .= ' <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>';
                }

                return $actionButtons;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);
        // return $product;
        return view('products.show', [
            'product' => $product,
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
        $product = Product::with('category')->find($id);
        $categories = Category::all();
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
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
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_quantity' => 'required|integer',
            'price' => 'required|string',
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        // Check if the logged-in user is the owner
        $isOwner = Auth::user()->role === 'owner';

        // Prevent non-owner users from reducing the product quantity
        if (!$isOwner && $request->input('product_quantity') < $product->product_quantity) {
            return redirect()->route('product.edit', $id)->with('warning', 'You are not allowed to reduce the product quantity.');
        }

        $product->product_name = $request->input('product_name');
        $product->product_quantity = $request->input('product_quantity');

        $price = str_replace('.', '', $request->input('price'));
        $product->price = floatval($price);
        // $product->price = $request->input('price');

        $category = Category::where('category_name', $request->input('category_name'))->first();
        if ($category) {
            $product->category_id = $category->id;
        }

        if ($request->hasFile('image')) {
            // Handle the image upload
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = '/storage/' . $imagePath;
        }

        $product->save();

        return redirect()->route('product.show', $product->id)->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('product.index')->with('success', 'Product restored successfully.');
    }
}
