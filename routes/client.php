<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')
    ->as('client.')
    ->group(function () {

        Route::get('/', function () {
            return view('client.dashboard');
        });


        Route::get('/', [ProductController::class, 'home'])->name('home');
        Route::get('detail/{slug}', [ProductController::class, 'detail'])->name('detail');
        Route::get('cart', [ProductController::class, 'cart'])->name('cart');
        Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
        Route::get('contact', [ProductController::class, 'contact'])->name('contact');
        Route::get('shop', [ProductController::class, 'shop'])->name('shop');

        Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
        Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('order/save', [OrderController::class, 'save'])->name('order.save');

        Route::resource('products', ProductController::class);
    });
