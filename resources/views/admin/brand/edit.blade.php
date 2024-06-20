@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Cập nhật xuất xứ sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Danh sách xuất xứ sản phẩm</a></li>
            <li class="breadcrumb-item active">Cập nhật xuất xứ sản phẩm</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form action="{{route('brand.update', $brand)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" name="name" value="{{$brand->name}}" id="name" >
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('brand.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection