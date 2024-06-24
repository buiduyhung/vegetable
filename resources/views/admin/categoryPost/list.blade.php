@extends('admin.layout.master')

@section('content')


<div class="container-fluid">

    <h1 class="mt-4">Danh sách danh mục bài viết</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách danh mục bài viết</li>
    </ol>

    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <form class="product-search d-flex">
                        <input type="text" class="border border-1 border-primary rounded px-2" value="{{request('name')}}"
                        placeholder="Tên nhóm" name="name" style="margin-right: 10px">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>
                    <a href="{{ route('categoryPost.create') }}" class="btn btn-primary m-1">Thêm danh mục bài viết</a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Tên</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Mô tả</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoryPosts as $categoryPost)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 text-center">{{$categoryPost->id}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0 text-center">{{$categoryPost->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0 ">{!! $categoryPost->desc !!}</h6>
                                        </td>

                                        <td class="border-bottom-0 text-center d-flex justify-content-center">
                                            <a href="{{route('categoryPost.edit', $categoryPost)}}" class="btn btn-outline-secondary m-1">Sửa</a>
    
                                            <button type="button" name="delete-categoryPost" data-id_categoryPost="{{ $categoryPost->id }}" class="btn btn-outline-danger m-1 delete-categoryPost">
                                                Xóa
                                            </button>   
                                        </td>
                                    </tr>
                                </form>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection