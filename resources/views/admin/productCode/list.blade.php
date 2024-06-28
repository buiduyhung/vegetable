@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Mã sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách mã sản phẩm</li>
    </ol>

    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <form class="product-search d-flex">
                        <input type="text" class="border border-1 border-primary rounded px-2" value=""
                        placeholder="Mã sản phẩm" name="product_code" style="margin-right: 10px">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>
                    <a href="{{route('productCode.create')}}" class="btn btn-primary m-1">Thêm</a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4" style="background-color: aliceblue;">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Mã sản phẩm</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tên</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Mô tả</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                </th>
                                <th class="border-bottom-0 text-end">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productCodes as $productCode)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$productCode->id}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$productCode->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-semibold">{{$productCode->title}}</p>
                                        </td>
                                        <td class="border-bottom-0" style="max-width: 330px; white-space: normal; text-align: justify;">
                                            <p class="mb-0 fw-semibold">{!! $productCode->description !!}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <span class="text-ellipsis">
                                                @if ($productCode->status == 1)
                                                    <a href="{{ route('productCode.active', $productCode->id) }}" class="btn btn-success">Hiển thị</a>
                                                @else
                                                    <a href="{{ route('productCode.hidden', $productCode->id) }}" class="btn btn-warning">Ẩn</a>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="border-bottom-0 text-end">
                                            <a href="{{route('productCode.edit', $productCode)}}" class="btn btn-outline-warning m-1">Sửa</a>
    
                                            <button type="button" name="delete-productCode" data-id_productCode="{{ $productCode->id }}" class="btn btn-outline-danger m-1 delete-productCode">
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