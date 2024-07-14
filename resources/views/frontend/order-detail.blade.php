@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Chi tiết đơn hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <span>Chi tiết đơn hàng</span>
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
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="checkout__input">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="name" value="{{$order->name}}" disabled readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ email<span>*</span></p>
                            <input type="text" name="email"  value="{{$order->email}}" disabled readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="phone"  value="{{$order->phone}}" disabled readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ nhận hàng<span>*</span></p>
                            <input type="text" name="address"  value="{{$order->address}}" disabled readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú</p>
                            <input type="text" name="note" value="{{$order->note}}" disabled readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Phản hồi về đơn hàng</p>
                            <input type="text" name="feedback" value="{{$order->feedback}}" disabled readonly>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="checkout__order">
                            <h4>Chi tiết đơn hàng</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                            <ul>
                                @foreach ($order->products as $product)
                                    <li>{{$product->pivot->name}} x {{$product->pivot->quantity}}<span>{{convertPrice($product->pivot->price * $product->pivot->quantity )}}</span></li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__total">Tổng tiền <span>{{convertPrice($order->total_price)}}</span></div>
                            <div class="checkout__input__checkbox">
                                @if ($order->payment === 1)
                                    Thanh toán VNPay
                                @else
                                    Thanh toán tiền mặt
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 mt-6">
                        <h4>Phàn hồi về đơn hàng</h4>
                        <form method="POST" action="{{ route('account.feedback', $order) }}">
                            @csrf
                            @method("PUT")
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nhập thông tin</label>
                                <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="10"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection
