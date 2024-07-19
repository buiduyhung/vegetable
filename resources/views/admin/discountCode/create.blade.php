@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Thêm danh mã code</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('discountCode.index') }}">Danh sách mã code</a></li>
            <li class="breadcrumb-item active">Thêm danh mã code</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('discountCode.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Mã</label>
                        <input type="text" name="name" class="form-control" id="name">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên</label>
                        <input type="text" name="title" class="form-control title" id="title">
                        @error('title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Mô tả</label>
                        <textarea class="form-control ckeditor" name="desc" id="desc"></textarea>
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
                    <a href="{{ route('discountCode.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
