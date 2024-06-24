@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Cập nhật thông tin mã giảm giá</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('discount.index') }}">Danh sách mã giảm giá</a></li>
            <li class="breadcrumb-item active">Cập nhật thông tin mã giảm giá</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('discount.update', $discount)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên mã giảm giá</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $discount->name }}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Mã giảm giá</label>
                        <input type="text" name="code" class="form-control" id="code" value="{{ $discount->code }}">
                        @error('code')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="text" name="quantity" class="form-control" id="quantity" value="{{ $discount->quantity }}">
                        @error('quantity')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Tính năng mã giảm giá</label>
                        <select name="condition" class="form-control m-bot15">
                            <option value="0">---Chọn---</option>
                            <option value="1" {{ $discount->condition == "1" ? 'selected':false }}>Giảm theo %</option>
                            <option value="2" {{ $discount->condition == "2" ? 'selected':false }}>Giảm theo tiền</option>
                        </select>
                        @error('condition')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="value" class="form-label">Nhập số % hoặc tiền giảm</label>
                        <input type="text" name="value" class="form-control" id="value" value="{{ $discount->value }}">
                        @error('value')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    


                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('discount.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection