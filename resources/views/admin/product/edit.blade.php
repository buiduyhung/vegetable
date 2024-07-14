@extends('admin.layout.master')

@section('content')
    <style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 400px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
    </style>

    <div class="container-fluid">
        <h1 class="mt-4">Cập nhật thông tin sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Danh sách sản phẩm</a></li>
            <li class="breadcrumb-item active">Cập nhật thông tin sản phẩm</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $product->name)}}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="code_id" class="form-label">Mã sản phẩm
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="code_id" id="origin">
                            <option value="" disabled selected>--- chọn mã sản phẩm ---</option>
                            @foreach ($codes as $code)
                                <option value="{{$code->id}}" {{$code->id == $product->code_id ? 'selected' : '' }}>{{$code->name}}</option>
                            @endforeach
                        </select>
                        @error('code_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="origin" class="form-label">Xuất xứ
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="origin_id" id="origin">
                            <option value="" disabled selected>--- chọn xuất xứ ---</option>
                            @foreach ($origins as $origin)
                                <option value="{{$origin->id}}" {{$origin->id == $product->origin_id ? 'selected' : '' }}>{{$origin->name}}</option>
                            @endforeach
                        </select>
                        @error('origin_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Loại sản phẩm
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="category_id" id="category">
                            <option value="" disabled selected>--- chọn loại sản phẩm ---</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="{{$product->quantity}}">
                        @error('quantity')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Khối lượng
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="weight" id="weight">
                            <option value="" disabled selected>--- Chọn khối lượng ---</option>
                            <option value="0.5 kg" {{ $product->weight == '0.5 kg' ? 'selected' : ''}}>0.5 kg</option>
                            <option value="1.0 kg" {{ $product->weight == '1.0 kg' ? 'selected' : ''}}>1.0 kg</option>
                            <option value="1.5 kg" {{ $product->weight == '1.5 kg' ? 'selected' : ''}}>1.5 kg</option>
                            <option value="2.0 kg" {{ $product->weight == '2.0 kg' ? 'selected' : ''}}>2.0 kg</option>
                            <option value="2.5 kg" {{ $product->weight == '2.5 kg' ? 'selected' : ''}}>2.5 kg</option>
                            <option value="3.0 kg" {{ $product->weight == '3.0 kg' ? 'selected' : ''}}>3.0 kg</option>
                        </select>
                        @error('weight')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Mô tả
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control ckeditor" name="desc" id="editor">{{$product->desc}}</textarea>
                        @error('desc')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label me-2">Hình ảnh
                            <span class="text-danger">*</span>
                            <small class="text-warning ps-2 ">(Sử dụng Ctrl để thêm nhiều ảnh)</small>
                        </label>
                        <input type="file" name="images[]" class="form-control" id="imageInput" accept="image/jpg, image/jpeg, image/png, image/webp" multiple />
                        @error('images')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div id="imagePreview">
                            @foreach ($product->images as $image)
                                <img class="m-3 rounded-1" style="width: 150px" src="{{$image->image}}" alt="">
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('product.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection
