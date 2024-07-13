<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OriginRequest;
use App\Models\Origin;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OriginController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $origins = Origin::when($name, function($query, $name){
            $query->where('name', 'LIKE', "%$name%");
        })->orderByDesc('id')->paginate(8);

        return view('admin.origin.list', compact('origins'));
    }

    public function create()
    {
        return view('admin.origin.create');
    }

    public function store(OriginRequest $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            Origin::create($data);
            DB::commit();
            return redirect()->route('origin.index')->with('success', 'Thêm xuất xứ sản phẩm thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function edit(Origin $origin)
    {
        return view('admin.origin.edit', compact('origin'));
    }

    public function update(OriginRequest $request, Origin $origin)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $origin->update($data);
            DB::commit();
            return redirect()->route('origin.index')->with('success', 'Cập nhật thông tin xuất xứ sản phẩm thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function destroy(Request $request){
        try {
            $origin = Origin::find($request->input('origin_id'));
            if ($origin) {
                $origin->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu xuất xứ sản phẩm'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting categoryProduct: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function hidden($id){
        Origin::where('id', $id)->update(['status' => '0']);
        return redirect()->route('origin.index')->with('success', 'Hiện xuất xứ thành công !');
    }

    public function active($id){
        Origin::where('id', $id)->update(['status' => '1']);
        return redirect()->route('origin.index')->with('success', 'Ẩn xuất xứ thành công !');
    }
}
