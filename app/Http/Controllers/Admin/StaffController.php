<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaffRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Throwable;

class StaffController extends Controller
{
    public function index(Request $request){
        $name = $request->input('name');

        $staffs = Admin::when($name, function($query, $name){
                $query->where('name', 'LIKE', "%$name%");
            })->orderByDesc('id')->paginate(10);
        return view('admin.staff.list', compact('staffs'));
    }

    public function create(){
        $groups = Group::all();
        return view('admin.staff.create', compact('groups'));
    }

    public function store(SaffRequest $request){
        $data = $request->all();

        $res = Admin::create($data);
        if($res){
            return redirect()->route('staff.index')->with('success', 'Thêm nhân viên mới thành công.');
        }
    }

    public function edit(Admin $admin){
        $groups = Group::all();
        return view('admin.staff.edit', compact('admin', 'groups'));
    }

    public function update(SaffRequest $request, Admin $admin){
        $data = $request->all();

        DB::beginTransaction();
        try {
            
            if($request->file('image')){
                $image = $request->file('image');
                $data['image'] = $this->saveImage($image);
            } else {
                $data['image'] = $admin->image;
            }

            $admin->update($data);
            DB::commit();
            return redirect()->route('staff.index')->with('success', 'Cập nhật thông tin nhân viên thành công.');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function destroy(Admin $staff){
        $staff->delete();
        return back()->with('success', 'Xóa nhân viên thành công.');
    }


    public function profile(){
        return view('admin.staff.profile');
    }


    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('admins', $imageName, 'public');
        if($res){
            $path = 'admins/'. $imageName;
        } 
        return $path;
    }
}
