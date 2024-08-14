<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', function() {
            return view('admin.dashboard');
        });

        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('create', [CategoryController::class, 'create'])->name('create');
                Route::post('store', [CategoryController::class, 'store'])->name('store');
                Route::get('show/{id}', [CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
            });

            Route::resource('products', ProductController::class);
    });