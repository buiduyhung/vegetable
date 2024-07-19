@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Cập nhật thông tin bài viết</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Danh sách bài viết</a></li>
            <li class="breadcrumb-item active">Cập nhật thông tin bài viết</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('post.update', $post)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên bài viết</label>
                        <input type="text" name="name" class="form-control title" id="name" value="{{ $post->name }}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control slug" id="slug" value="{{ $post->slug }}">
                        @error('slug')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoryPost_id" class="form-label">Danh Mục</label>
                        <select class="form-select" name="categoryPost_id" id="categoryPost_id">
                            <option value="" disabled selected>--- Chọn danh mục bài viết ---</option>
                            @foreach ($categoryPosts as $category)
                                <option value="{{$category->id}}" {{ $post->categoryPost_id == $category->id ? 'selected':false }} >{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('categoryPost_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Mô tả</label>
                        <textarea style="resize: none;" rows="5" type="text" name="desc" class="form-control" id="desc">{{ $post->desc }}</textarea>
                        @error('desc')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea style="resize: none;" rows="5" type="text" name="content" class="form-control ckeditor" id="content">{{ $post->content }}</textarea>
                        @error('content')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh</label>
                        @if ($post->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" id="image" accept="image/*">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('post.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
