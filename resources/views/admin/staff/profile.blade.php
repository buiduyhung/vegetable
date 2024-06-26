@extends('admin.layout.master')

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">Thông tin cá nhân</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ Auth::user()->name }}</li>
    </ol>   
    
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold mb-2">Thông tin</h5>
                </div>
                <hr>
                <div class="tab-content" >
                    <div class="tab-pane active mt-5" >
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-7">
                                    <div class="info-account mb-3">
                                        <div class="row">
                                            <div class="col-3 text-right">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-9 text-start text-dark">
                                                {{Auth::guard('admin')->user()->email}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-account mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-right">
                                                <label for="name">Họ tên</label>
                                            </div>
                                            <div class="col-9 text-start">
                                                <input class="form-control" type="text" name="name" id="name" value="{{Auth::guard('admin')->user()->name}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="info-account mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-right">
                                                <label for="name">Chức vụ</label>
                                            </div>
                                            <div class="col-9 text-start">
                                                {{Auth::guard('admin')->user()->group->name}}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="info-account mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-right">
                                                <label for="phone">Số điện thoại</label>
                                            </div>
                                            <div class="col-9 text-start">
                                                <input class="form-control" type="text" name="phone" id="phone" value="{{Auth::guard('admin')->user()->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-account mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-right">
                                                <label for="address">Địa chỉ</label>
                                            </div>
                                            <div class="col-9 text-start">
                                                <input class="form-control" type="text" name="address" id="address" value="{{Auth::guard('admin')->user()->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mb-5">
                                        <button type="submit" class="btn btn-primary text-white">
                                            Cập nhật
                                        </button>
                                    </div>
                                </div>
                                <div class="col-5 d-flex align-items-center justify-content-center">
                                    <div class="user-avatar">
                                        <div class="user-avatar-img">
                                            <img src="{{ Auth::guard('admin')->user()->avatar ?? '/assets/frontend/img/no-avatar.png' }}" id="user-avatar" alt="user-avatar">
                                        </div>
                                        <div class="user-avatar-btn text-primary">
                                            <label for="avatar" style="color: #7fad39 ">Upload ảnh
                                                <input accept="image/png, image/jpg, image/jpeg" hidden onchange="previewImg(this,'user-avatar')" type="file" name="avatar" id="avatar">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
    
@endsection