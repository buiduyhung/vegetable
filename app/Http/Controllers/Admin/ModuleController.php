<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(){
        $modules = Module::all();
        return view('admin.module.list', compact('modules'));
    }

    public function create(){
        return view('admin.module.create');
    }

    public function store(Request $request){
        $module = new Module();
        $module->name = $request->name;
        $module->title = $request->title;
        $module->save();

        return redirect()->route('module.index')->with('success', 'Thêm module thành công');
    }

    public function edit($id){
        $module = Module::find($id);
        return view('admin.module.edit', compact('module'));
    }

    public function update(Request $request, $id){
        $module = Module::find($id);
        $module->name = $request->name;
        $module->title = $request->title;
        $module->save();

       return redirect()->route('module.index')->with('success', 'Cập nhật module thành công');
    }

    public function destroy($id){
        $module = Module::find($id);
        $module->delete();
        return redirect()->route('module.index')->with('success', 'Xóa module thành công');
    }
}
