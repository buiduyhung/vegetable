<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OriginRequest;
use App\Models\Origin;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\DB;

class OriginController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $origins = Origin::when($name, function($query, $name){
            $query->where('name', 'LIKE', "%$name%");
        })->orderByDesc('id')->paginate(5);

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

    public function update(Request $request, Origin $origin)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);
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

    public function destroy(Origin $origin)
    {
        $origin->delete();
        return back()->with('success', 'Xóa dữ liệu thành công.');
    }
}
