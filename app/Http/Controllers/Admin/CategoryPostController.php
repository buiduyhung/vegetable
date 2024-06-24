<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryPostRequest;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryPostController extends Controller
{
    public function index(){
        $categoryPosts = CategoryPost::all();

        return view('admin.categoryPost.list', compact('categoryPosts'));
    }

    public function create(){
        return view('admin.categoryPost.create');
    }

    public function store(CategoryPostRequest $request){
        $data = $request->all();
        DB::beginTransaction();
        try {
            CategoryPost::create($data);
            DB::commit();
            return redirect()->route('categoryPost.index')->with('success', 'Thêm danh mục bài viết thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(CategoryPost $categoryPost){
        return view('admin.categoryPost.edit', compact('categoryPost'));
    }

    public function update(CategoryPostRequest $request ,CategoryPost $categoryPost){
        $data = $request->all();

        DB::beginTransaction();
        try {
            $categoryPost->update($data);

            DB::commit();
            return redirect()->route('categoryPost.index')->with('success', 'Cập nhật thông tin danh mục bài viết thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request){
        
        try {
            $categoryPost = CategoryPost::find($request->input('categoryPost_id'));
            
            if ($categoryPost) {
                $categoryPost->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu danh mục bài viết'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting group: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }


}
