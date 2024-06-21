@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Xuất xứ sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách xuất xứ sản phẩm</li>
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
                    <a href="{{route('brand.create')}}" class="btn btn-primary m-1">Thêm xuất xứ sản phẩm</a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$brand->id}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-semibold">{{$brand->name}}</p>
                                    </td>
                                    <td class="border-bottom-0 text-center d-flex justify-content-center">
                                        <a href="{{route('brand.edit', $brand)}}" class="btn btn-outline-secondary m-1">Sửa</a>
                                        <form action="{{route('brand.destroy', $brand)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Do you really want to delete this items?')"
                                            type="submit" class="btn btn-outline-danger m-1">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection