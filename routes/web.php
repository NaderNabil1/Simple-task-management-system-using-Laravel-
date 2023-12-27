<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// BackEnd routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function(){
    // Dashboard route
    Route::any('/dashboard', [App\Http\Controllers\BackEnd\DashboardController::class, 'index'])->name('dashboard');
    Route::any('/filter', [App\Http\Controllers\BackEnd\DashboardController::class, 'filter'])->name('filter');

    });

    // User routes
    Route::prefix('users')->group(function(){
        Route::any('/', [App\Http\Controllers\BackEnd\UserController::class, 'index'])->name('users');
        Route::any('/add', [App\Http\Controllers\BackEnd\UserController::class, 'add'])->name('add-user');
        Route::any('/edit/{id}', [App\Http\Controllers\BackEnd\UserController::class, 'edit'])->name('edit-user');
        Route::any('/delete/{id}', [App\Http\Controllers\BackEnd\UserController::class, 'delete'])->name('delete-user');
        Route::any('/{id}', [App\Http\Controllers\BackEnd\UserController::class, 'show'])->name('show-user');
    });
    // Admin routes
    Route::prefix('admins')->group(function(){
        Route::any('/', [App\Http\Controllers\BackEnd\AdminController::class, 'index'])->name('be-admins');
        Route::any('/add', [App\Http\Controllers\BackEnd\AdminController::class, 'add'])->name('add-admin');
        Route::any('/edit/{id}', [App\Http\Controllers\BackEnd\AdminController::class, 'edit'])->name('edit-admin');
        Route::any('/delete/{id}', [App\Http\Controllers\BackEnd\AdminController::class, 'delete'])->name('delete-admin');
    });

    // Order routes
    Route::prefix('tasks')->group(function(){
        Route::any('/', [App\Http\Controllers\BackEnd\TaskController::class, 'index'])->name('be-tasks');
        Route::any('/add', [App\Http\Controllers\BackEnd\TaskController::class, 'add'])->name('add-task');
        Route::any('/edit/{id}', [App\Http\Controllers\BackEnd\TaskController::class, 'edit'])->name('edit-task');
        Route::any('/delete/{id}', [App\Http\Controllers\BackEnd\TaskController::class, 'delete'])->name('delete-task');
    });


// FrontEnd routes
Route::prefix('/')->group(function(){
    // Page routes
    Route::any('/', [App\Http\Controllers\FrontEnd\PageController::class, 'home'])->name('home');
    Route::any('/about', [App\Http\Controllers\FrontEnd\PageController::class, 'about'])->name('about');
    Route::any('/contact', [App\Http\Controllers\FrontEnd\PageController::class, 'contact'])->name('contact');

    // Blog routes
    Route::prefix('blog')->group(function(){
        Route::any('/', [App\Http\Controllers\FrontEnd\BlogController::class, 'index'])->name('blog');
        Route::any('/{slug}', [App\Http\Controllers\FrontEnd\BlogController::class, 'show'])->name('show-blog');
    });

    // Event routes
    Route::prefix('events')->group(function(){
        Route::any('/', [App\Http\Controllers\FrontEnd\EventController::class, 'index'])->name('events');
        Route::any('/{slug}', [App\Http\Controllers\FrontEnd\EventController::class, 'show'])->name('show-event');
    });

    // Category routes
    Route::prefix('categories')->group(function(){
        Route::any('/', [App\Http\Controllers\FrontEnd\CategoryController::class, 'index'])->name('categories');
        Route::any('/{slug}', [App\Http\Controllers\FrontEnd\CategoryController::class, 'subcategories'])->name('subcategories');
        Route::any('/{slug}/products', [App\Http\Controllers\FrontEnd\ProductController::class, 'products'])->name('products');

        // Product routes
        Route::any('/{slug}/products/{prodSlug}', [App\Http\Controllers\FrontEnd\ProductController::class, 'show'])->name('product-details');
    });

    // Account routes
//    Route::any('/my-account', [App\Http\Controllers\FrontEnd\UserController::class, 'index'])->name('my-account');
    Route::any('/edit-account', [App\Http\Controllers\FrontEnd\UserController::class, 'edit'])->name('edit-account');
    Route::any('/reset-password', [App\Http\Controllers\FrontEnd\UserController::class, 'reset_password'])->name('reset-password');
    Route::any('/change-password', [App\Http\Controllers\FrontEnd\UserController::class, 'change_password'])->name('change-password');

    // Orders routes
    Route::any('/orders', [App\Http\Controllers\FrontEnd\OrderController::class, 'index'])->name('orders');
    Route::any('/order/{id}', [App\Http\Controllers\FrontEnd\OrderController::class, 'show'])->name('show-order');

    // Address routes
    Route::any('/addresses', [App\Http\Controllers\FrontEnd\ShippingAddressController::class, 'addresses'])->name('addresses');
    Route::any('/add-address', [App\Http\Controllers\FrontEnd\ShippingAddressController::class, 'add_address'])->name('add-address');
    Route::any('/edit-address/{addressID}', [App\Http\Controllers\FrontEnd\ShippingAddressController::class, 'edit_address'])->name('edit-address');
    Route::any('/delete-address/{addressID}', [App\Http\Controllers\FrontEnd\ShippingAddressController::class, 'delete_address'])->name('delete-address');

    //Cart routes
    Route::any('/cart', [App\Http\Controllers\FrontEnd\CartController::class, 'index'])->name('cart');
    Route::any('add-to-cart', [App\Http\Controllers\FrontEnd\CartController::class, 'add_to_cart'])->name('add-to-cart');
    Route::any('{id}/remove-item', [App\Http\Controllers\FrontEnd\CartController::class, 'remove_item'])->name('remove-item');
    Route::any('{id}/{size}/remove-item', [App\Http\Controllers\FrontEnd\CartController::class, 'session_remove_item'])->name('session-remove-item');
    Route::any('/update-cart', [App\Http\Controllers\FrontEnd\CartController::class, 'update_cart'])->name('update-cart');
    Route::any('/clear-cart', [App\Http\Controllers\FrontEnd\CartController::class, 'clear_cart'])->name('clear-cart');
    Route::any('/checkout/login', [App\Http\Controllers\FrontEnd\CartController::class, 'checkout_login'])->name('checkout-login');
    Route::any('/checkout', [App\Http\Controllers\FrontEnd\CartController::class, 'checkout'])->name('checkout');
    Route::any('/get-cities', [App\Http\Controllers\FrontEnd\CartController::class, 'get_cities'])->name('get-cities');
    Route::any('/thankyou', [App\Http\Controllers\FrontEnd\CartController::class, 'confirm_order'])->name('thankyou');

    // Testimonial routes
    Route::any('/add-testimonial', [App\Http\Controllers\FrontEnd\TestimonialController::class, 'add'])->name('add-testimonial');
});
