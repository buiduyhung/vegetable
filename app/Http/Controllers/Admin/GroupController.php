<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    public function index(){
        $groups = Group::all();

        return view('admin.groups.list', compact('groups'));
    }

    public function create(){
        return view('admin.groups.create');
    }

    public function store(GroupRequest $request){
        $data = $request->all();
        DB::beginTransaction();
        try {
            Group::create($data);
            DB::commit();
            return redirect()->route('group.index')->with('success', 'Thêm nhóm thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(Group $group){
        return view('admin.groups.edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group){
        $data = $request->all();
        DB::beginTransaction();
        try {
            $group->update($data);

            DB::commit();
            return redirect()->route('group.index')->with('success', 'Cập nhật thông tin nhóm thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Request $request){
        try {
            $group = Group::find($request->input('group_id'));
            if ($group) {
                $group->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu nhóm'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting group: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function permission(Group $group){
        $modules = Module::all();
        $roles = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'active' => 'Kích hoạt'
        ];
        $roleArr = [];

        if($group->permissions){
            $roleJson = $group->permissions;

            if(!empty($roleJson)){
                $roleArr = json_decode($roleJson);
            }else{
                $rolesArr = [];
            }
        }
        
        
    
        return view('admin.groups.permission', compact('group', 'modules', 'roles', 'roleArr'));
    }

    public function store_permission(Request $request, Group $group){
        if(!empty($request->role)){
            $roles = $request->role;
        }else{
            $roles = [];
        }
        $roleJson = json_encode($roles);

        $group->permissions = $roleJson;
        $group->save();

        return redirect()->route('group.index')->with('success', 'Phân quyền thành công !');
    }   
}
