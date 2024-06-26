@extends('admin.layout.master')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">Danh sách khách hàng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách khách hàng</li>
    </ol>   

    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <form class="product-search d-flex">
                        <input type="text" class="border border-1 border-primary rounded px-2" value="{{request('email')}}"
                        placeholder="Nhập email" name="email" style="margin-right: 10px">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>

                    <a href="{{route('user.create')}}" class="btn btn-primary m-1">Thêm</a>
                   
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Họ tên</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Số điện thoại</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Địa chỉ</h6>
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
                            @foreach($users as $user)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">#{{$user->id}}</h6>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center ">
                                            <img class="rounded-circle" style="width: 40px;" src="{{ $user->avatar ?? asset('assets/frontend/img/no-avatar.png')}}" alt="">
                                            <div class="m-2">
                                                <p class="fw-semibold mb-0">{{$user->name}}</p>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$user->email}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$user->phone}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$user->address}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            @if($user->status === 1)
                                                <p class="fw-semibold mb-0 text-success">Hoạt động</p>
                                            @else
                                                <p class="fw-semibold mb-0 text-danger">Bị khóa</p>
                                            @endif
                                        </td>
                                        
                                        <td class="border-bottom-0 text-end">
                                            @if ($user->status === 1)
                                                <a href="{{route('user.status', $user)}}" onclick="return confirm('Bạn có chắc muốn khóa tài khoản này không?')"
                                                class="btn btn-outline-warning m-1">Khóa</a>
                                            @else
                                                <a href="{{route('user.status', $user)}}" onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này không?')"
                                                class="btn btn-outline-success m-1">Mở khóa</a>
                                            @endif
    
                                            <a href="{{route('user.edit', $user)}}" class="btn btn-outline-secondary m-1">Sửa</a>
                                            
                                            <button type="button" name="delete-user" data-id_user="{{ $user->id }}" class="btn btn-outline-danger m-1 delete-user">
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
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection