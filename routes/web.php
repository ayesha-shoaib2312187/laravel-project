<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ContactInfoController;


//  Home &  Products
Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{id}/review', [ProductController::class, 'storeReview'])->name('product.review');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category.show');

// ✉ Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//  Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//  Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

//  Thank You Page
Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thankyou');

//  Dashboard & Admin Panel (Protected by authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'products' => \App\Models\Product::count(),
            'categories' => \App\Models\Category::count(),
            'orders' => \App\Models\Order::count(),
            'users' => \App\Models\User::count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Orders
    Route::get('/my-orders', [App\Http\Controllers\UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/my-orders/{order}', [App\Http\Controllers\UserOrderController::class, 'show'])->name('user.orders.show');

    Route::resource('admin/products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Contact Messages (view and delete only)
    Route::resource('admin/contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy'])->names([
        'index' => 'admin.contact-messages.index',
        'show' => 'admin.contact-messages.show',
        'destroy' => 'admin.contact-messages.destroy',
    ]);

    Route::post('admin/contact-messages/{contactMessage}/reply', [ContactMessageController::class, 'reply'])->name('admin.contact-messages.reply');

    // Orders (view and update status)
    Route::resource('admin/orders', OrderController::class)->only(['index', 'show', 'update'])->names([
        'index' => 'admin.orders.index',
        'show' => 'admin.orders.show',
        'update' => 'admin.orders.update',
    ]);

    // Policies (full CRUD)
    Route::resource('admin/policies', PolicyController::class)->names([
        'index' => 'admin.policies.index',
        'create' => 'admin.policies.create',
        'store' => 'admin.policies.store',
        'edit' => 'admin.policies.edit',
        'update' => 'admin.policies.update',
        'destroy' => 'admin.policies.destroy',
    ]);

    // Contact Information (single row, editable)
    Route::get('admin/contactInfo', [ContactInfoController::class, 'index'])->name('admin.contactInfo.index');
    Route::put('admin/contactInfo', [ContactInfoController::class, 'update'])->name('admin.contactInfo.update');

    // Categories (full CRUD)
    Route::resource('admin/categories', \App\Http\Controllers\Admin\CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    Route::get('/contactInfo', [ContactInfoController::class, 'index']);

});
