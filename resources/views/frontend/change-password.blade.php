@extends('frontend.layout.master')

@section('content')

<style>
    .project-tab {
        padding: 10%;
        margin-top: -8%;
    }
    .project-tab #tabs{
        background: #007b5e;
        color: #ffffff;
    }
    .project-tab #tabs h6.section-title{
        color: #eee;
    }
    .project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        background-color: transparent;
        border-color: transparent transparent #f3f3f3;
        border-bottom: 3px solid !important;
        font-size: 16px;
        font-weight: bold;
    }
    .project-tab .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        font-size: 16px;
        font-weight: 600;
    }
    .project-tab .nav-link:hover {
        border: none;
    }
    .project-tab thead{
        background: #f3f3f3;
        color: #333;
    }
    .project-tab a{
        text-decoration: none;
        color: #333;
        font-weight: 600;
    }
    .user-avatar-img img {
        border-radius: 50%;
        border: 1px solid #e4e4e4;
        width: 180px;
        height: 180px;
    }
    .user-avatar-btn {
        margin: 30px 20px 0;
    }
    .user-avatar-btn label {
        border: 1px solid #e4e4e4;
        width: 100%;
        padding: 10px 10px;
        border-radius: 5px;
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 3%);
        text-align: center;
        cursor: pointer;
    }
    .form-change-password{
        width: 300px;
        margin: auto;
    }
    .form-change-password input{
        border-radius: 5px;
    }
</style>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Tài khoản</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Trang chủ</a>
                        <span>Tài khoản</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<div id="tabs" class="project-tab">
    <div class="container shadow-sm bg-body rounded">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <nav>
                    <div class="nav nav-tabs nav-fill">
                        <a style="color: #7fad39" href="{{route('account')}}" class="nav-item nav-link {{ request()->segment(1) == 'tai-khoan' ? 'active' : ''}}">Tài khoản</a>
                        <a style="color: #7fad39" href="{{route('account.orderHistory')}}" class="nav-item nav-link {{ request()->segment(1) == 'lich-su-don-hang' ? 'active' : ''}}" >Lịch sử đơn hàng</a>
                        <a style="color: #7fad39" href="{{route('account.change-password')}}" class="nav-item nav-link {{ request()->segment(1) == 'doi-mat-khau' ? 'active' : ''}}">Đổi mật khẩu</a>
                    </div>
                </nav>
                <div class="tab-content" >
                    <div class="tab-pane active show mt-5">
                        <form class="form-change-password" method="POST" action="{{route('account.update-password')}}">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu cũ">
                                @error('old_password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới">
                                @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn text-white mb-5" style="background: #7fad39">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
