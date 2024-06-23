@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Thêm nhóm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('group.index') }}">Danh sách nhóm</a></li>
            <li class="breadcrumb-item active">Thêm nhóm</li>
        </ol>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin</h5>
                <form method="POST" action="{{route('group.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" class="form-control" id="name">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('group.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
@endsection