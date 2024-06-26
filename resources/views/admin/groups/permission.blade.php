@extends('admin.layout.master')

@section('content')


<div class="container-fluid">

    <h1 class="mt-4">Phân quyền nhóm : {{ $group->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('group.index') }}">Danh sách nhóm</a></li>
        <li class="breadcrumb-item active">Phân quyền nhóm</li>
    </ol>

    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <hr>
                <div class="table-responsive">
                    <form action="{{ route('group.storePermission', $group) }}" method="POST">
                        @csrf
                        <table class="table table-bordered text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4" style="background-color: aliceblue;">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Module</h6>
                                    </th>
                                    <th class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">Phân quyền</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$module->title}}</h6>
                                    </td>
                                    <td>
                                        <div class="row">
                                            @if (!@empty($roles))
                                                @foreach ($roles as $roleName => $roleLable)
                                                    <div class="col-2">
                                                        <label for="role_{{ $module->name }}_{{ $roleName }}">
                                                            <input type="checkbox" name="role[{{ $module->name }}][]" id="role_{{ $module->name }}_{{ $roleName }}" value="{{ $roleName }}" 
                                                            {{isRole($roleArr, $module->name, $roleName)  ? 'checked':false}}>
                                                            {{ $roleLable }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            
    
                                            @if ($module->name == 'groups')
                                                <div class="col-2">
                                                    <label for="role_{{ $module->name }}_permission">
                                                        <input type="checkbox" name="role[{{ $module->name }}][]" id="role_{{ $module->name }}_permission" value="permission" 
                                                        {{isRole($roleArr, $module->name, 'permission')  ? 'checked':false}}>
                                                        Phân quyền
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary mt-5">Phân quyền</button>
                        <a href="{{ route('group.index') }}" class="btn btn-danger mx-2 mt-5">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection