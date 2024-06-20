<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $brands = Brand::when($name, function($query, $name){
            $query->where('name', 'LIKE', "%$name%");
        })->orderByDesc('id')->paginate(5);
        return view('admin.brand.list', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:brands,name|string'
        ]);
        DB::beginTransaction();
        try {
            Brand::create($data);
            DB::commit();
            return redirect()->route('brand.index')->with('success', 'Thêm thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            $brand->update($data);
            DB::commit();
            return redirect()->route('brand.index')->with('success', 'Cập nhật thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Xóa dữ liệu thành công.');
    }
}
