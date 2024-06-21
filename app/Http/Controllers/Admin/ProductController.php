<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
    {   
        $product_code = $request->input('product_code');

        $products = Product::when($product_code, function($query, $product_code){
                $query->where('product_code', $product_code);
            })
            ->orderByDesc('id')
            ->paginate(5);
        
        return view('admin.product.list', compact('products'));
    }

    
    public function create()
    {   
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories','brands'));
    }

    
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        
        $arrimages = $data['images'];
        DB::beginTransaction();
        try {
            unset($data['images']);
            unset($data['price_import']);
            unset($data['price_sale']);

            $product = Product::create($data);
            $this->createProductImage($product,$arrimages);
            DB::commit();

            return redirect()->route('product.show', $product->id)->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    public function show(Product $product)
    {
        $prices = Price::where('product_id', $product->id)->orderBy('updated_at', 'DESC')->get();
        $dateToday = Carbon::now()->format('d-m-Y');

        return view('admin.product.show', compact('product', 'prices', 'dateToday'));
    }

    
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $prices = Price::where('product_id', $product->id)->orderBy('updated_at', 'DESC')->first();

        return view('admin.product.edit', compact('product','categories','brands', 'prices'));
    }

    
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            unset($data['images']);
            unset($data['price_import']);
            unset($data['price_sale']);
            if($request->file('images')){
                $arrimages = $request->file('images');
                $this->createProductImage($product,$arrimages);
            }

            $product->update($data);

            DB::commit();
            return redirect()->route('product.show', $product->id)->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Xóa sản phẩm thành công.');
    }

    protected function createProductImage($product, $arrimages){
        DB::beginTransaction();
        try {
            if($product->images){
               foreach($product->images as $image){
                    $image->delete();
               }
            }
            foreach($arrimages as $image){
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $this->saveImage($image);
                $productImage->save();
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('products', $imageName, 'public');
        if($res){
            $path = 'products/'. $imageName;
        } 
        return $path;
    }

    public function createPrice($product, $price_import, $price_sale){
        DB::beginTransaction();
        try {
            $price = new Price();
            $price->product_id = $product->id;
            $price->price_import = $price_import;
            $price->price_sale = $price_sale;
            $price->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update_price_sale(Request $request, $id){
        DB::beginTransaction();
        try {
            $price = new Price();
            $price->product_id = $id;
            $price->price_import = $request->price_import_new;
            $price->price_sale = $request->price_sale_new;
            $price->save();
            
            DB::commit();
            return back()->with('msg', 'Cập nhật giá sản phẩm thành công');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
