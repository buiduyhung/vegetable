<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->product_id = $product->id;
        $comment->content = $request->input('comment');
        $comment->save();

        return back()->with('success', 'Bình luận về sản phẩm thành công');
    }
}
