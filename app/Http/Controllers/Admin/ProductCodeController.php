<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCodeRequest;
use App\Models\ProductCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductCodeController extends Controller
{
    public function index(){
        $productCodes = ProductCode::OrderBy('created_at', 'desc')->paginate(5);

        return view('admin.productCode.list', compact('productCodes'));
    }

    public function create(){
        return view('admin.productCode.create');
    }

    public function store(ProductCodeRequest $request){
        $data = $request->all();

        DB::beginTransaction();
        try {
            ProductCode::create($data);
            DB::commit();
            return redirect()->route('productCode.index')->with('success', 'Thêm mã sản phẩm thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(ProductCode $productCode){
        return view('admin.productCode.edit', compact('productCode'));
    }

    public function update(Request $request, ProductCode $productCode){
        $data = $request->all();

        DB::beginTransaction();
        try {
            $productCode->update($data);

            DB::commit();
            return redirect()->route('productCode.index')->with('success', 'Cập nhật thông tin mã sản phẩm thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request){
        try {
            $productCode = ProductCode::find($request->input('productCode_id'));

            if ($productCode) {
                $productCode->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu mã sản phẩm'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting group: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function active($id){
        ProductCode::where('id', $id)->update(['status' => '0']);
        return redirect()->route('productCode.index')->with('success', 'Ẩn mã sản phẩm thành công !');
    }

    public function hidden($id){
        ProductCode::where('id', $id)->update(['status' => '1']);
        return redirect()->route('productCode.index')->with('success', 'Hiện mã sản phẩm thành công !');
    }
}
