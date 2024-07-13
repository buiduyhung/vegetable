@extends('frontend.layout.master')

@section('content')

    <!-- Banner Section Begin -->
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="/assets/frontend/img/hero/banner-main.jpg">
                        <div class="hero__text">
                            <span>NÔNG SẢN VIỆT</span>
                            <h2>Giảm giá tới<br />25% cho đơn hàng</h2>
                            <p>Đặt hàng và giao hàng miễn phí ngay hôm nay</p>
                            <a href="{{route('shop')}}" class="primary-btn">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-start" style="text-align: justify;">
                        <h2>Sản phẩm bán chạy</h2>
                    </div>
                </div>
            </div>
            <div class="row product__discount__slider owl-carousel">
                @foreach ($topSellingProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{$product->images->shift()->image}}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{route('product', [$product,Str::slug($product->name)])}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('cart.add', $product)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <span class="text-warning">Đã bán {{$product->sold}}</span>
                                <h4>{{ number_format($product->price_sale) }} VNĐ</h4>
                                <h4><a href="{{route('product', [$product,Str::slug($product->name)])}}">{{$product->name}}</a></h4>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="/assets/frontend/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="/assets/frontend/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title" style="text-align: justify;">
                        <h2>Sản phẩm mới nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($latestProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{$product->images->shift()->image}}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{route('product', [$product,Str::slug($product->name)])}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{route('cart.add', $product)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h4>{{ number_format($product->price_sale) }} VNĐ</h4>
                                <h4><a href="{{route('product', [$product,Str::slug($product->name)])}}">{{$product->name}}</a></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title" style="text-align: justify;">
                        <h2>Bài viết Mới</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <a href="{{ route('blogDetail', $post->slug) }}">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="" width="50px">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> {{ $post->updated_at }}</li>
                                    </ul>
                                    <h5><a href="#">{{ $post->name }}</a></h5>
                                    <p>{!! $post->desc !!}</p>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->


@endsection
