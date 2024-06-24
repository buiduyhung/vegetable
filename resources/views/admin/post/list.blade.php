@extends('admin.layout.master')

@section('content')


<div class="container-fluid">

    <h1 class="mt-4">Danh sách bài viết</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách bài viết</li>
    </ol>

    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <form class="product-search d-flex">
                        <input type="text" class="border border-1 border-primary rounded px-2" value="{{request('name')}}"
                        placeholder="Tên" name="name" style="margin-right: 10px">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>
                    <a href="#" class="btn btn-primary m-1">Thêm mã giảm giá</a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tên bài viết</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Danh mục</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Nội dung</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($groups as $group)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$group->id}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0">{{$group->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0 text-center justify-content-center">
                                            <a href="{{ route('group.permission', $group) }}" class="btn btn-outline-success m-1">Phân quyền</a>
                                        </td>
                                        <td class="border-bottom-0 text-center d-flex justify-content-center">
                                            <a href="{{route('group.edit', $group)}}" class="btn btn-outline-secondary m-1">Sửa</a>
    
                                            <button type="button" name="delete-group" data-id_group="{{ $group->id }}" class="btn btn-outline-danger m-1 delete-group">
                                                Xóa
                                            </button>   
                                        </td>
                                    </tr>
                                </form>
                                
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection