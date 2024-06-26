@extends('admin.layout.master')

@section('content')


<div class="container-fluid">

    <h1 class="mt-4">Danh sách mã giảm giá</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách mã giảm giá</li>
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
                    <a href="{{ route('discount.create') }}" class="btn btn-primary m-1">Thêm</a>
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
                                    <h6 class="fw-semibold mb-0 text-center">Tên mã giảm giá</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Mã giảm giá</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Giá trị giảm giá</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Số lượng</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Tính năng</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 text-center">{{$discount->id}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0 text-center">{{$discount->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0 text-center">{{$discount->code}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0 text-center">{{$discount->value}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            <h6 class="fw-semibold mb-0 text-center">{{$discount->quantity}}</h6>
                                        </td>
                                        <td class="border-bottom-0 ">
                                            @if ($discount->condition == 1)
                                                <h6 class="fw-semibold mb-0 text-center">Giảm {{ $discount->value }} %</h6>
                                            @else
                                                <h6 class="fw-semibold mb-0 text-center">Giảm {{ number_format($discount->value) }} VNĐ</h6>
                                            @endif
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <span class="text-ellipsis">
                                                @if ($discount->status == 1)
                                                    <a href="{{ route('discount.active', $discount->id) }}" class="btn btn-success">Hiển thị</a>
                                                @else
                                                    <a href="{{ route('discount.hidden', $discount->id) }}" class="btn btn-warning">Ẩn</a>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="border-bottom-0 text-center d-flex justify-content-center">
                                            <a href="{{route('discount.edit', $discount)}}" class="btn btn-outline-secondary m-1">Sửa</a>
    
                                            <button type="button" name="delete-discount" data-id_discount="{{ $discount->id }}" class="btn btn-outline-danger m-1 delete-discount">
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