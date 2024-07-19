@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Đặt hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <span>Đặt hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"></div>
            </div>
            <div class="checkout__form">
                <h4>Thông tin giao hàng</h4>
                <form action="{{route('checkoutPost')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input type="text" name="name" value="{{Auth::guard('web')->user()->name}}">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ email<span>*</span></p>
                                <input type="text" name="email"  value="{{Auth::guard('web')->user()->email}}">
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" name="phone"  value="{{Auth::guard('web')->user()->phone}}">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ nhận hàng<span>*</span></p>
                                <input type="text" name="address"  value="{{Auth::guard('web')->user()->address}}">
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú</p>
                                <input type="text" name="note">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Chi tiết đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                                <ul>
                                    @foreach (session('cart') as $item)
                                        <li>{{$item['name']}} x {{$item['quantity']}}<span>{{convertPrice($item['price'] * $item['quantity'] )}}</span></li>
                                    @endforeach
                                </ul>
                                {{-- <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div> --}}
                                <div class="checkout__order__total">Tổng tiền <span>{{convertPrice(session('total_price'))}}</span></div>

                                <div class="checkout__input__checkbox">
                                    <label for="vnpay">
                                        <img src="{{asset('assets/frontend/img/vnpay.png')}}" alt="" width="100px" style="border-radius: 3px">
                                        <input type="radio" name="payment" id="vnpay" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox mt-3">
                                    <label for="cod">
                                        Thanh toán khi nhận hàng
                                        <input type="radio" name="payment" id="cod" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection
