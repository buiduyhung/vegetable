
@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        @if (!empty(session('cart')))
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá tiền (VNĐ)</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền (VNĐ)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('cart') as $item)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{$item['image']}}" alt="" width="100">
                                                <a href="">
                                                    <h5>{{$item['name']}}</h5>
                                                </a>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{number_format($item['price'])}}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="hidden" id="product_id" value="{{$item['product_id']}}">
                                                        <input type="text" value="{{$item['quantity']}}" name="quantity">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{number_format($item['price'] * $item['quantity'])}}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <span onclick="confirmDelete({{$item['product_id']}})" class="icon_close"></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="shoping__cart__btns">
                            <a href="{{route('shop')}}" class="primary-btn">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Giỏ hàng</h5>
                            <ul>
                                <li>Tổng tiền <span>{{convertPrice(session('total_price'))}}</span></li>
                            </ul>
                            <a href="{{route('checkout')}}" class="primary-btn">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h5 class="text-center">Không có sản phẩm nào trong giỏ!</h5>
            <div class="row justify-content-center mt-4">
                <div class="shoping__cart__btns">
                    <a href="{{route('shop')}}" class="primary-btn">Tiếp tục mua hàng</a>
                </div>
            </div>
        @endif
        
    </section>
    <!-- Shoping Cart Section End -->

    <script>
        function confirmDelete(id){
            Swal.fire({
                title: 'Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/cart/delete/' + id;
                }
            })
        }

    </script>

@endsection
   