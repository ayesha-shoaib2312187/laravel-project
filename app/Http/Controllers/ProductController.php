<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
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
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('products', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != 'all') {
            // Check if it's an ID or slug? Assuming ID for now from frontend or slug
            // But wait, the frontend sends a string currently.
            // I should support searching by category name or ID.
            // Let's assume frontend sends category ID if I change it, or slug.
            // For now, let's look up category by name or slug if it's a string, or just ID.
            $category = Category::where('name', $request->category)->orWhere('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            } else {
                // Fallback to old behavior string search?
                $query->where('category', $request->category);
            }
        }

        $products = $query->with('category')->get(['id', 'title', 'price', 'image', 'category_id', 'category']);

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
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
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
        // Populate legacy field
        $category = Category::find($request->category_id);
        $data['category'] = $category ? $category->name : '';

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
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
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
        // Populate legacy field
        $category = Category::find($request->category_id);
        $data['category'] = $category ? $category->name : '';

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
