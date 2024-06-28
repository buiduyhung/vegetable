<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class TotalController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('admin.total.index', compact('products'));
    }
}
