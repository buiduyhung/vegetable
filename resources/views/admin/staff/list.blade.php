@extends('admin.layout.master')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">Danh sách nhân viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách nhân viên</li>
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

                    <a href="{{route('staff.create')}}" class="btn btn-primary m-1">Thêm</a>

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
                                    <h6 class="fw-semibold mb-0">Họ tên</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Chức vụ</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Ngày tạo</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staffs as $staff)
                                <form>
                                    @csrf
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$staff->id}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-semibold mb-0">{{$staff->name}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$staff->email}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{$staff->group->name}}</p>
                                        </td>
                                        <td class="border-bottom-0 text-center">
                                            <p class="fw-semibold mb-0">{{date_format($staff->created_at, 'd/m/Y')}}</p>
                                        </td>
                                        
                                        <td class="border-bottom-0 text-center">
                                            <a href="{{route('staff.edit', $staff)}}" class="btn btn-outline-secondary m-1">Sửa</a>
    
                                            <button type="button" name="delete-staff" data-id_staff="{{ $staff->id }}" class="btn btn-outline-danger m-1 delete-staff">
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
                    {{$staffs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection