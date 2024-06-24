<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(){
        return view('admin.discount.list');
    }

    public function creat(){
        return view('admin.discount.create');
    }

    public function store(DiscountRequest $request){

    }

    public function edit(Discount $discount){

    }

    public function update(DiscountRequest $request ,Discount $discount){

    }

    public function delete(Discount $discount){

    }

}
