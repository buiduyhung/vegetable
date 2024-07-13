<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\PriceUpdate;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\CategoryProduct;
use App\Models\Origin;
use App\Models\PriceSale;
use App\Models\ProductCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $productCodes = ProductCode::all();
        // $productName = $request->input('product_name');
        $products = Product::OrderBy('created_at', 'desc')->paginate(8);

        // json file search
        $productList = Product::all();
        $path = public_path().'/json/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'products.json', json_encode($productList));

        return view('admin.product.list', compact('products', 'productCodes'));
    }

    public function create()
    {
        $categories = CategoryProduct::all();
        $origins = Origin::all();
        $productCodes = ProductCode::all();

        return view('admin.product.create', compact('categories','origins', 'productCodes'));
    }


    public function store(Request $request)
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
        $priceUpdate = PriceUpdate::where('product_id', $product->id)->get();
        $dateToday = Carbon::now()->format('d-m-Y');

        return view('admin.product.show', compact('product', 'dateToday', 'priceUpdate'));
    }

    public function edit(Request $product)
    {
        $categories = CategoryProduct::all();
        $origins = Origin::all();
        $codes = ProductCode::all();

        return view('admin.product.edit', compact('product','categories','origins', 'codes'));
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
            $price = new PriceUpdate();
            $price->product_id = $id;
            $price->price_import = $request->price_import_new;
            $price->save();

            $product = Product::where('id', $id)->first();
            $product->price_import = $request->price_import_new;
            $product->update();

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
            $price = new PriceUpdate();
            $price->product_id = $id;
            $price->price_sale = $request->price_sale_new;
            $price->save();

            $product = Product::where('id', $id)->first();
            $product->price_sale = $request->price_sale_new;
            $product->update();

            DB::commit();
            return back()->with('success', 'Cập nhật giá bán sản phẩm thành công');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function hidden($id){
        Product::where('id', $id)->update(['status' => '1']);
        return redirect()->route('product.index')->with('success', 'Hiện sản phẩm thành công !');
    }

    public function active($id){
        Product::where('id', $id)->update(['status' => '0']);
        return redirect()->route('product.index')->with('success', 'Ẩn sản phẩm thành công !');
    }
}
