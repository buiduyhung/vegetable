<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\String_;
use Throwable;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();

        return view('admin.post.list', compact('posts'));
    }

    public function create(){
        $categoryPosts = CategoryPost::all();

        return view('admin.post.create', compact('categoryPosts'));
    }

    public function store(PostRequest $request){
        $data = $request->all();

        DB::beginTransaction();
        try {
            $data['image'] = $this->saveImage($data['image']);

            Post::create($data);

            DB::commit();
            return redirect()->route('post.index')->with('success', 'Thêm bài viết thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(Post $post){
        $categoryPosts = CategoryPost::all();

        return view('admin.post.edit', compact('post', 'categoryPosts'));
    }

    public function update(Request $request ,Post $post){
        $request->validate([
            'image' => 'nullable|image',
            'title' => 'required',
            'content' => 'required',
            'categoryPost_id' => 'required',
            'status' => 'required',
            'desc' => 'required',
        ]);

        $data = $request->all();

        DB::beginTransaction();
        try {
            $post->update($data);

            DB::commit();
            return redirect()->route('post.index')->with('success', 'Cập nhật thông tin bài viết thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request){

        try {
            $post = Post::find($request->input('post_id'));

            if ($post) {
                $post->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu bài viết'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting group: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('posts', $imageName, 'public');
        if($res){
            $path = 'posts/'. $imageName;
        }
        return $path;
    }

    public function show(Post $post){

    }

    public function active(Post $post){
        $status = $post->status;
        if($status === 1){
            $post->status = 0;
        }
        else{
            $post->status = 1;
        }
        $post->save();
        return redirect()->route('post.index')->with('success', 'Ẩn bài viết thành công !');
    }

    public function hidden(Post $post){
        $status = $post->status;
        if($status === 0){
            $post->status = 1;
        }
        else{
            $post->status = 0;
        }
        $post->save();

        return redirect()->route('post.index')->with('success', 'Hiển thị bài viết thành công !');
    }
}
