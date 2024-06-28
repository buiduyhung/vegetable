<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserController extends Controller
{
    public function index(Request $request){
        $email = $request->email;

        $users = User::when($email, function($query, $email){
            $query->where('email', $email);
        })->orderByDesc('id')->paginate(10);
        return view('admin.user.list', compact('users'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(UserRequest $request){
        $data = $request->all();

        DB::beginTransaction();
        try {
            $data['image'] = $this->saveImage($data['image']);
            User::create($data);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Thêm khách hàng thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function edit(User $user){
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user){
        $data = $request->all();

        DB::beginTransaction();
        try {
            if($request->file('image')){
                $image = $request->file('image');
                $data['image'] = $this->saveImage($image);
            } else {
                $data['image'] = $user->image;
            }

            $user->update($data);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Cập nhật thông tin tài khoản khách hàng thành công !');
        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function handleStatus(User $user){
        $status = $user->status;
        if($status === 1){
            $user->status = 0;
        }
        else{
            $user->status = 1;
        }
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->input('user_id'));
            if ($user) {
                $user->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Không có dữ liệu thành viên'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    protected function saveImage($image){
        $imageName = $image->hashName();
        $res = $image->storeAs('users', $imageName, 'public');
        if($res){
            $path = 'users/'. $imageName;
        } 
        return $path;
    }
}