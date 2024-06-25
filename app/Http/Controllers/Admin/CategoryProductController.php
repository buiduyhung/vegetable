<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryProductRequest;
use App\Models\Category_product;
use App\Models\CategoryProduct;
use App\Models\Origin;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryProductController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        
        $categoryProducts = CategoryProduct::when($name, function($query, $name){
            $query->where('name', 'LIKE', "%$name%");
        })->orderByDesc('id')->get();
        return view('admin.categoryProduct.list', compact('categoryProducts'));
    }

    public function create()
    {
        return view('admin.categoryProduct.create');
    }

    public function store(CategoryProductRequest $request)
    {
        $data = $request->all();
        
        DB::beginTransaction();
        try {
            $data['image'] = $this->saveImage($data['image']);
            CategoryProduct::create($data);
            DB::commit();
            return redirect()->route('categoryProduct.index')->with('success', 'Thêm danh mục thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function edit(CategoryProduct $categoryProduct)
    {
        return view('admin.categoryProduct.edit', compact('categoryProduct'));
    }

    public function update(CategoryProductRequest $request, CategoryProduct $categoryProduct)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            
            if($request->file('image')){
                $image = $request->file('image');
                $data['image'] = $this->saveImage($image);
            } else {
                $data['image'] = $categoryProduct->image;
            }

            $categoryProduct->update($data);
            DB::commit();
            return redirect()->route('categoryProduct.index')->with('success', 'Cập nhật danh mục thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request){
        try {
            $categoryProduct = CategoryProduct::find($request->input('categoryProduct_id'));
            if ($categoryProduct) {
                $categoryProduct->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu danh mục sản phẩm'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting categoryProduct: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('categories', $imageName, 'public');
        if($res){
            $path = 'categories/'. $imageName;
        } 
        return $path;
    }

    public function hidden($id){
        CategoryProduct::where('id', $id)->update(['status' => '0']);
        return redirect()->route('categoryProduct.index')->with('success', 'Hiện danh mục sản phẩm thành công !');
    }

    public function active($id){
        CategoryProduct::where('id', $id)->update(['status' => '1']);
        return redirect()->route('categoryProduct.index')->with('success', 'Ẩn bài danh mục viết thành công !');
    }
    
}
