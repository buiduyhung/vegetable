
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
                                                        <input type="number" value="{{$item['quantity']}}" name="quantity">
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
                    <div class="col-lg-4">
                        <div class="shoping__cart__btns">
                            <h3 href="" class="primary-btn">Nhập mã giảm giá:</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="{{route('discount')}}" method="POST">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control" name="discount" placeholder="Nhập mã giảm giá">
                                <input type="submit" class="btn btn-dark mx-2" name="check-discount" value="Tính mã giảm giá">

                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-danger delete-discount">Xóa mã giảm giá</a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="shoping__cart__btns">
                            <a href="{{route('shop')}}" class="primary-btn">Tiếp tục mua hàng</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Giỏ hàng</h5>

                            <ul>
                                @if (Session::get('discount'))
                                    @php
                                        $latestDiscount = Session::get('discount');
                                        $total = session('total_price');
                                        // echo '<pre>';
                                        //     print_r($latestDiscount);
                                        // echo '</pre>';
                                    @endphp

                                    @foreach ($latestDiscount as $key => $discount)
                                        @if ($discount['discount_condition'] == 1)
                                            <p>Mã giảm giá : <span>{{ $discount['discount_code'] }}</span> </p>

                                            <p>
                                                @php
                                                    $totalDiscount = ($total * $discount['discount_value']) / 100;
                                                @endphp
                                            </p>

                                            <p>Giá trị mã giảm giá : <span>{{ $discount['discount_value'] }} % (= {{ number_format($totalDiscount,0,',','.') }} VNĐ)</span> </p>

                                            <p>
                                                @php
                                                    $total_after_discount = $total - $totalDiscount;
                                                @endphp
                                            </p>
                                            <hr>
                                            <li>Tổng tiền sau khi áp mã : <span>{{ number_format($total_after_discount,0,',','.') }} VNĐ</span></li>
                                        @endif

                                        @if ($discount['discount_condition'] == 2)
                                            <p>Mã giảm giá : <span>{{ $discount['discount_code'] }}</span>  <br></p>
                                            <p>Giá trị mã giảm giá : <span>{{ number_format($discount['discount_value'],0,',','.') }} VNĐ</span> </p>
                                            <p>
                                                @php
                                                    $total_after_discount = $total - $discount['discount_value'];
                                                @endphp
                                            </p>
                                            <hr>
                                            <li>Tổng tiền sau khi áp mã: <span>{{ number_format($total_after_discount,0,',','.') }} VNĐ</span> </li>
                                        @endif
                                    @endforeach

                                @else
                                    <li>Tổng tiền <span>{{convertPrice(session('total_price'))}}</span></li>
                                @endif

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
