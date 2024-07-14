@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
    </ol>

    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <form class="product-search d-flex">
                        <input type="text" class="border border-1 border-primary rounded px-2" value="{{request('product_code')}}"
                        placeholder="Tên sản phẩm" name="product_name" style="margin-right: 10px">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>
                    <a href="{{route('product.create')}}" class="btn btn-primary m-1">Thêm</a>
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
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Loại sản phẩm</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Số lượng tồn</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Số lượng đã bán</h6>
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
                            @foreach($products as $key=>$product)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$key+1}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $product->productCode->name }}</h6>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center">
                                            <img class="rounded-1" style="width: 80px; border: 1px solid #f7f7f7" src="{{ $product->images->shift()->image }}" alt="">
                                            <div class="m-2">
                                                <h6 class="fw-semibold mb-1">{{$product->name}}</h6>
                                                <span class="fw-normal">{{$product->origin->name}}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$product->category->name}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$product->quantity}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$product->sold}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <span class="text-ellipsis">
                                                @if ($product->status == 1)
                                                    <a href="{{ route('product.active', $product->id) }}" class="btn btn-success">Hiển thị</a>
                                                @else
                                                    <a href="{{ route('product.hidden', $product->id) }}" class="btn btn-warning">Ẩn</a>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="border-bottom-0 text-end">
                                            <a href="{{route('product.show', $product)}}" class="btn btn-outline-info m-1">Chi tiết</a>
                                            <a href="{{route('product.edit', $product->id)}}" class="btn btn-outline-warning m-1">Sửa</a>

                                            <button type="button" name="delete-product" data-id_product="{{ $product->id }}" class="btn btn-outline-danger m-1 delete-product">
                                                Xóa
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
