@extends('frontend.layout.master')

@section('content')

<style>

#login .container #login-row #login-column #login-box {
  max-width: 600px;
  border: 1px solid #d7d7d7;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -45px;
}
</style>

<div id="login" class="m-5">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12 shadow-none p-3 mb-5 bg-light rounded">
                    <form id="login-form" class="form" action="{{route('registerPost')}}" method="post">
                        @csrf
                        <h2 class="text-center text-dark">Đăng ký</h2>
                        <div class="form-group">
                            <label for="name" class="text-dark">Họ tên:</label><br>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-dark">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-dark">Mật khẩu:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="text-dark">Xác nhận mật khẩu:</label><br>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            @error('password_confirmation')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit"class="btn btn-md text-white" style="background: #7fad39;">
                                Đăng ký
                            </button>
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="{{route('login')}}" style="color: #7fad39;">Đăng nhập tại khoản</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection