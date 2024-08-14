<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function home()
    {
        $data = Product::query()->latest('id')->paginate(8);

        $dataCate = Category::query()->latest('id')->paginate(6);

        return view('client.layouts.master', compact('data', 'dataCate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($slug)
    {
        $product = Product::query()->with('variants')->where('slug', $slug)->first();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        return view('client.layouts.detail', compact('product', 'colors', 'sizes'));
    }

    public function contact()
    {
        return view('client.layouts.contact');
        
    }
    public function shop()
    {
        $data = Product::query()->latest('id')->paginate(5);


        return view('client.layouts.shop', compact('data'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    
}
