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
use App\Models\CategoryProduct;
use App\Models\Origin;
use App\Models\PriceImport;
use App\Models\PriceSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
        $categories = CategoryProduct::all();
        $origins = Origin::all();
        return view('admin.product.create', compact('categories','origins'));
    }

    
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $arrimages = $data['images'];

        DB::beginTransaction();
        try {
            unset($data['images']);

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
        $dateToday = Carbon::now()->format('d-m-Y');
        $priceImports =  PriceImport::where('product_id', $product->id)->orderBy('updated_at', 'DESC')->get();
        $priceSales =  PriceSale::where('product_id', $product->id)->orderBy('updated_at', 'DESC')->get();

        return view('admin.product.show', compact('product', 'dateToday', 'priceImports', 'priceSales'));
    }

    
    public function edit(Product $product)
    {
        $categories = CategoryProduct::all();
        $origins = Origin::all();

        return view('admin.product.edit', compact('product','categories','origins'));
    }

    
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            unset($data['images']);

            if($request->file('image')){
                $image = $request->file('image');
                $data['image'] = $this->saveImage($image);
            } else {
                $data['image'] = $product->image;
            }

            $product->update($data);

            DB::commit();
            return redirect()->route('product.show', $product->id)->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    
    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->input('product_id'));
            if ($product) {
                $product->delete();
                return response()->json(['success' => true]);
            } else {

                return response()->json(['error' => 'Không có dữ liệu sản phẩm'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
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

    public function priceImport(Request $request, $id){
        DB::beginTransaction();
        try {
            $price = new PriceImport();
            $price->product_id = $id;
            $price->price_import = $request->price_import_new;
            $price->save();
            
            DB::commit();
            return back()->with('success', 'Cập nhật giá nhập sản phẩm thành công');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function priceSale(Request $request, $id){
        DB::beginTransaction();
        try {
            $price = new PriceSale();
            $price->product_id = $id;
            $price->price_sale = $request->price_sale_new;
            $price->save();
            
            DB::commit();
            return back()->with('success', 'Cập nhật giá bán sản phẩm thành công');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
