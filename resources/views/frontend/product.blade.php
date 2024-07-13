@extends('frontend.layout.master')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sản phẩm</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Trang chủ</a>
                        <a href="./index.html">{{$product->category->name}}</a>
                        <span>{{$product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{$product->images->first()->image}}"
                            alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach ($product->images as $item)
                        <img data-imgbigurl="{{$item->image}}" src="{{$item->image}}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <form action="{{route('cart.add', $product)}}">
                    <div class="product__details__text">
                        <h3>{{$product->name}}</h3>

                        <div class="product__details__price"> {{ convertPrice($product->price_sale) }} </div>

                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty shop">
                                    <input type="text" value="1" name="quantity">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn border-0">Thêm vào giỏ hàng</button>
                        <ul>
                            <li><b>Mã sản phẩm</b>{{$product->product_code}}</li>
                            <li>
                                <b>Tình trạng</b>
                                @if ($product->quantity > 0)
                                <span class="text-success">Còn hàng</span>
                                @else
                                <span class="text-danger">Hết hàng</span>
                                @endif
                            </li>
                            <li><b>Đã bán</b> {{$product->sold}} sản phẩm</li>
                            <li><b>Xuất xứ</b> {{$product->origin->name}}</li>
                            <li><b>Khối lượng</b>{{$product->weight}} / hộp</li>
                            <li><b>Chính sách giao hàng</b>Nhận hàng trong 4 tiếng - 6 tiếng</li>
                            <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Thông tin sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Chính sách vận chuyển</a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                {!!$product->desc!!}
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                @include('frontend.layout.shipping-policy')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<section>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control" name="content" rows="4" placeholder="Nhập bình luận của bạn..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- Related Product Section Begin -->
<section class="related-product mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="section-title">
                        <h2>Sản phẩm tương tự</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row product__discount__slider owl-carousel">
            @foreach($relatedProducts as $product)
            <div class="col-lg-3">
                <div class="product__discount__item product__item">
                    <div class="product__discount__item__pic set-bg" data-setbg="{{$product->images->first()->image}}">
                        <ul class="product__item__pic__hover">
                            <li><a href="{{route('product', [$product,Str::slug($product->name)])}}"><i class="fa fa-eye"></i></a></li>
                            <li><a href="{{route('cart.add', $product)}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__discount__item__text">
                        <h4>{{ convertPrice($product->price_sale) }}</h4>
                        <h4>
                            <a href="{{route('product',[$product, Str::slug($product->name)])}}">{{$product->name}}</a>
                        </h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Product Section End -->
@endsection
