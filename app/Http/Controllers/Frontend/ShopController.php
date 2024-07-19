<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PriceImport;
use App\Models\PriceSale;

class ShopController extends Controller
{
    public function index(){
        $topSellingProducts = Product::orderByDesc('sold')->get()->take(10);
        $latestProducts = Product::orderByDesc('id')->get()->take(12);

        $posts = Post::orderByDesc('updated_at')->get()->take(3);

        return view('frontend.index', compact('topSellingProducts','latestProducts', 'posts'));
    }

    public function shop(Request $request){
        $keyword = $request->input('search');

        $products = Product::when($keyword, function($query,$keyword){
            return $query->where('name','like',"%$keyword%");
        });
        $products = $this->filter($products, $request);
        $products = $this->sortByAndPaginate($products, $request);

        return view('frontend.shop', compact('products'));
    }

    public function getProductByCategory($category_id, Request $request){
        $products = Product::where('category_id', $category_id);
        $products = $this->filter($products, $request);
        $products = $this->sortByAndPaginate($products, $request);

        return view('frontend.shop', compact('products'));
    }

    public function getProductByBrand(Request $request, $brand_id = ''){
        if(!empty($brand_id)){
            $products = Product::where('origin_id', $brand_id);
        }
        else{
            $products = Product::query();
        }
        $products = $this->filter($products, $request);
        $products = $this->sortByAndPaginate($products, $request);

        return view('frontend.shop', compact('products'));
    }

    public function product(Product $product){
        $relatedProducts = Product::where('category_id', $product->category_id)->whereNot('id', $product->id)->get();
        $comments = Comment::where('product_id', $product->id)->get();

        return view('frontend.product', compact('product','relatedProducts', 'comments'));
    }

    protected function filter($products, $request){

        /* xuất xứ */
        $brands = $request->input('brand') ?? [];
        $arr_brands = array_keys($brands);

        $products = $products->when($arr_brands, function($query, $arr_brands){
            return $query->whereIn('origin_id', $arr_brands);
        });

        return $products;
    }

    protected function sortByAndPaginate($products,Request $request){
        $sortBy = $request->input('sort_by') ?? 'latest';


        switch ($sortBy) {
            case 'latest':
                $products = $products->orderByDesc('id');
                break;
            case 'oldest':
                $products = $products->orderBy('id');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-desending':
                $products = $products->orderByDesc('price');
                break;

            default: $products = $products->orderByDesc('id');
        }

        $perPage = $request->input('show') ?? '9';

        $products = $products->paginate($perPage);
        $products->appends(['sort_by' => $sortBy , 'show' => $perPage]);

        return $products;
    }

    public function contact(){

        return view('frontend.contact');
    }
}
