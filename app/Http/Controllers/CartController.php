<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Display the cart page
    public function index()
    {
        $cart = Session::get('cart', []);
        $grandTotal = 0;

        // Calculate the grand total of all items in the cart
        foreach ($cart as $item) {
            $price = $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 0;
            $grandTotal += $price * $quantity;
        }

        // Pass cart and total to the view
        return view('cart', compact('cart', 'grandTotal'));
    }

    // Add a product to the cart
    public function add($id)
    {
        $product = $this->getProductById($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Invalid product.');
        }

        $cart = Session::get('cart', []);

        // If product already in cart, increase quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "title" => $product['title'],
                "price" => $product['price'],
                "quantity" => 1,
                "image" => $product['image'],
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update the quantity of a specific product
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $quantity = (int)$request->quantity;
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                // Remove item if quantity is zero or less
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    // Decrease quantity of a product by 1
    public function decrement($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] -= 1;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]); // Remove if quantity reaches 0
            }
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    // Remove a product completely from the cart
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    // Clear the entire cart
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Cart cleared!');
    }

    // Dummy product data for demonstration
    private function getProductById($id)
    {
        $products = [
            1 => ['title' => 'Crochet Flower Bouquet', 'price' => 2500, 'image' => 'bouquet.png'],
            2 => ['title' => 'Amigurumi Bunny', 'price' => 3200, 'image' => 'Amigurumi Bunny.webp'],
            3 => ['title' => 'Boho Tote Bag', 'price' => 1200, 'image' => 'boho bag.webp'],
            4 => ['title'=>'Cozy Throw','short'=>'Warm blanket','desc'=>'Warm and comfy crochet blanket','price'=>2800,'image'=>'blanket.jpg'],
            5 => ['title'=>'Crochet Teddy','short'=>'Cute teddy','desc'=>'Cute handmade teddy','price'=>2000,'image'=>'teddy.jpg'],
            6 => ['title'=>'Mini Backpack','short'=>'Small backpack','desc'=>'Stylish small crochet backpack','price'=>2500,'image'=>'backpack.jpg'],
            7 => ['title'=>'Crochet Keychain','short'=>'Cute keychain','desc'=>'Handmade crochet keychain','price'=>500,'image'=>'keychain.webp'],
            8 => ['title'=>'Crochet Sweater','short'=>'Cozy sweater','desc'=>'Handmade crochet sweater','price'=>3500,'image'=>'sweater.jpg'],
            9 => ['title'=>'Crochet Beanie','short'=>'Warm beanie','desc'=>'Handmade crochet beanie hat','price'=>1200,'image'=>'beanie.jpeg'],

        ];

        return $products[$id] ?? null;
    }
}
