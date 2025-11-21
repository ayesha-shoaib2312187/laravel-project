<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = [
            ['slug' => 'blankets', 'name' => 'Blankets', 'image' => 'blanket.jpg'],
            ['slug' => 'toys', 'name' => 'Toys', 'image' => 'bunny.jpg'],
            ['slug' => 'bags', 'name' => 'Bags', 'image' => 'bag.jpg'],
        ];

        return view('home', compact('categories'));
    }
}
