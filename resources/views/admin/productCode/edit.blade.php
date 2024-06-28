@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Cập nhật thông tin mã sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('productCode.index') }}">Danh sách mã sản phẩm</a></li>
            <li class="breadcrumb-item active">Cập nhật thông tin mã sản phẩm</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('productCode.update', $productCode)}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Mã sản phẩm</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $productCode->name }}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $productCode->title }}">
                        @error('title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Mô tả</label>
                        <textarea style="resize: none;" rows="5" type="text" name="desc" class="form-control ckeditor" id="desc">{{ $productCode->desc }}</textarea>
                        @error('desc')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" class="form-control m-bot15">
                            <option value="">-----chọn trạng thái-----</option>
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('productCode.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection