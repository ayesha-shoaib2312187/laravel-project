<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function home()
    {
        $products = Product::take(3)->get();
        return view('home', compact('products'));
    }


    public function products()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    // 🔍 Single product details
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Example hardcoded reviews
        $reviews = [
            ['name'=>'Sara','review'=>'Absolutely love it!'],
            ['name'=>'Ali','review'=>'High quality, perfect gift.'],
            ['name'=>'Nadia','review'=>'The quality is so good.'],
        ];

        return view('product-show', compact('product','reviews'));
    }

    // ✍️ Store a new review
    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'review' => 'required|string|max:500',
        ]);

        // Future: save review to DB
        Session::flash('success', 'Thank you for your review!');
        return redirect()->back();
    }
    public function category($slug)
    {
        $products = Product::where('category', $slug)->get();
        return view('products', compact('products','slug'));
    }

    // === Admin CRUD ===

    // Show all products (admin)
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('admin.products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'category'=>'required|string',
            'title'=>'required|string',
            'short'=>'required|string',
            'desc'=>'required|string',
            'price'=>'required|numeric',
            'image'=>'nullable|string',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success','Product added!');
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category'=>'required|string',
            'title'=>'required|string',
            'short'=>'required|string',
            'desc'=>'required|string',
            'price'=>'required|numeric',
            'image'=>'nullable|string',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success','Product updated!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted!');
    }
}
