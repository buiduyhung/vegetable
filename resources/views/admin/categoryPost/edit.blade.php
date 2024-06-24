@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Cập nhật thông tin danh mục bài viết</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('categoryPost.index') }}">Danh sách danh mục bài viết</a></li>
            <li class="breadcrumb-item active">Cập nhật thông tin danh mục bài viết</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('categoryPost.update', $categoryPost)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục bài viết</label>
                        <input type="text" name="name" class="form-control title" id="name" value="{{ $categoryPost->name }}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">slug</label>
                        <input type="text" name="slug" class="form-control slug" id="slug" value="{{ $categoryPost->slug }}">
                        @error('slug')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Mô tả</label>
                        <textarea class="form-control ckeditor" name="desc" id="desc">{!! $categoryPost->desc !!}</textarea>
                        @error('desc')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('categoryPost.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection