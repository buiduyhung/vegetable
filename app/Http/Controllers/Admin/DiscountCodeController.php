<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function index(){
        $discountCodes = DiscountCode::all();
        return view('admin.discountCode.list', compact('discountCodes'));
    }

    public function create(){
        return view('admin.discountCode.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'status' => 'required',
        ]);

        $discountCode = new DiscountCode();
        $discountCode->name = $request->name;
        $discountCode->title = $request->title;
        $discountCode->desc = $request->desc;
        $discountCode->status = $request->status;
        $discountCode->save();

        return redirect()->route('discountCode.index')->with('success', 'Thêm mã code thành công !');
    }

    public function edit(Request $request, $id){

        $discountCode = DiscountCode::find($id);
        return view('admin.discountCode.edit', compact('discountCode'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'status' => 'required',
        ]);

        $discountCode = DiscountCode::find($id);
        $discountCode->name = $request->name;
        $discountCode->title = $request->title;
        $discountCode->desc = $request->desc;
        $discountCode->status = $request->status;
        $discountCode->update();

        return redirect()->route('discountCode.index')->with('success', 'Cập nhật mã code thành công !');
    }

    public function destroy($id){

        $discountCode = DiscountCode::find($id);
        $discountCode->delete();
        return redirect()->route('discountCode.index')->with('success', 'Xóa mã code thành công !');
    }
}
