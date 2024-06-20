<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        
        $categories = Category::when($name, function($query, $name){
            $query->where('name', 'LIKE', "%$name%");
        })->orderByDesc('id')->get();
        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:categories,name|string',
            'image' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data['image'] = $this->saveImage($data['image']);
            Category::create($data);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
        
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            if($request->file('image')){
                $image = $request->file('image');
                $data['image'] = $this->saveImage($image);
            }
            $category->update($data);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Xóa danh mục thành công.');
    }

    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('categories', $imageName, 'public');
        if($res){
            $path = 'categories/'. $imageName;
        } 
        return $path;
    }
}
