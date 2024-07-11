<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaffRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;
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

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'group_id' => 'required|integer|exists:groups,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->group_id = $request->group_id;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('staff.index')->with('success', 'Thêm nhân viên mới thành công.');

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


    public function destroy(Request $request)
    {
        try {
            $admin = Admin::find($request->input('staff_id'));
            if ($admin) {
                $admin->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu nhân viên'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
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
