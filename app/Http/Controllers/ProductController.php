<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $products = [
        ['id'=>1,'category'=>'flowers','title'=>'Crochet Flower Bouquet','short'=>'Handmade crochet bouquet','desc'=>'Beautiful handmade crochet bouquet','price'=>2500,'image'=>'bouquet.png'],
        ['id'=>2,'category'=>'toys','title'=>'Amigurumi Bunny','short'=>'Soft plush bunny','desc'=>'Handmade plush bunny toy','price'=>1800,'image'=>'Amigurumi Bunny.webp'],
        ['id'=>3,'category'=>'bags','title'=>'Boho Tote Bag','short'=>'Eco-friendly tote','desc'=>'Eco-friendly crochet handbag','price'=>2200,'image'=>'boho bag.webp'],
        ['id'=>4,'category'=>'blankets','title'=>'Cozy Throw','short'=>'Warm blanket','desc'=>'Warm and comfy crochet blanket','price'=>2800,'image'=>'blanket.jpg'],
        ['id'=>5,'category'=>'toys','title'=>'Crochet Teddy','short'=>'Cute teddy','desc'=>'Cute handmade teddy','price'=>2000,'image'=>'teddy.jpg'],
        ['id'=>6,'category'=>'bags','title'=>'Mini Backpack','short'=>'Small backpack','desc'=>'Stylish small crochet backpack','price'=>2500,'image'=>'backpack.jpg'],
        ['id'=>7,'category'=>'accessories','title'=>'Crochet Keychain','short'=>'Cute keychain','desc'=>'Handmade crochet keychain','price'=>500,'image'=>'keychain.webp'],
        ['id'=>8,'category'=>'apparel','title'=>'Crochet Sweater','short'=>'Cozy sweater','desc'=>'Handmade crochet sweater','price'=>3500,'image'=>'sweater.jpg'],
        ['id'=>9,'category'=>'apparel','title'=>'Crochet Beanie','short'=>'Warm beanie','desc'=>'Handmade crochet beanie hat','price'=>1200,'image'=>'beanie.jpeg'],
    ];

    // 🏠 Home page - show first 3 products
    public function home()
    {
        $products = array_slice($this->products, 0, 3);
        return view('home', compact('products'));
    }

    // 🛍️ Products page - show all
    public function products()
    {
        $products = $this->products;
        return view('products', compact('products'));
    }

    // 🔍 Single product details
    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', (int)$id);
        if(!$product) abort(404);

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

        // Normally you'd save to database — but for now, just flash message
        Session::flash('success', 'Thank you for your review!');
        return redirect()->back();
    }

    // 🧺 Category filter
    public function category($slug)
    {
        $products = array_filter($this->products, fn($p) => $p['category'] === $slug);
        return view('products', compact('products','slug'));
    }
}
