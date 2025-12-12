<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
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

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $products = $query->get(['id', 'title', 'price', 'image', 'category']);

        return response()->json($products);
    }

    // 🔍 Single product details
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = $product->reviews()->orderBy('created_at', 'desc')->get();

        return view('product-show', compact('product', 'reviews'));
    }

    // ✍️ Store a new review
    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'review' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $data = [
            'product_id' => $product->id,
            'name' => $request->name,
            'review' => $request->review,
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '_review.' . $request->image->extension();
            $request->image->move(public_path('images/reviews'), $imageName);
            $data['image'] = $imageName;
        }

        Review::create($data);

        Session::flash('success', 'Thank you for your review!');
        return redirect()->back();
    }
    public function category($slug)
    {
        $products = Product::where('category', $slug)->get();
        return view('products', compact('products', 'slug'));
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
            'category' => 'required|string',
            'title' => 'required|string',
            'short' => 'required|string',
            'desc' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['stock'] = $request->has('stock') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product added!');
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
            'category' => 'required|string',
            'title' => 'required|string',
            'short' => 'required|string',
            'desc' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|boolean',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $data['stock'] = $request->has('stock') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
