<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DiscountController extends Controller
{
    public function index(){
        $discounts = Discount::all();

        return view('admin.discount.list', compact('discounts'));
    }

    public function create(){
        return view('admin.discount.create');
    }

    public function store(DiscountRequest $request){
        $data = $request->all();
        DB::beginTransaction();
        try {
            Discount::create($data);
            DB::commit();
            return redirect()->route('discount.index')->with('success', 'Thêm mã giảm giá thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(Discount $discount){
        return view('admin.discount.edit', compact('discount'));
    }

    public function update(DiscountRequest $request ,Discount $discount){
        $data = $request->all();

        DB::beginTransaction();
        try {
            $discount->update($data);

            DB::commit();
            return redirect()->route('discount.index')->with('success', 'Cập nhật thông tin mã giảm giá thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request){
        
        try {
            $discount = Discount::find($request->input('discount_id'));
            
            if ($discount) {
                $discount->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu mã giảm giá'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting group: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

}
