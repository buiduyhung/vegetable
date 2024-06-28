<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Vegetable">
    <meta name="keywords" content="Vegetable, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nông Sản Việt</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" ></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{route('cart')}}"><i class="fa fa-shopping-basket"></i> <span>{{ session('cart') !== null ? count(session('cart')) : 0 }}</span></a></li>
            </ul>
            <div class="header__cart__price">Tổng tiền: <span>{{session('total_price') ?? 0}}đ</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                @if (!Auth::guard('web')->check())
                    <a href="{{route('login')}}"><i class="fa fa-user"></i> Đăng nhập</a>
                @else
                    <a href="{{route('account')}}"><i class="fa fa-user"></i>{{Auth::guard('web')->user()->name}}</a>
                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('home')}}">Trang chủ</a></li>
                <li><a href="{{route('shop')}}">Cửa hàng</a></li>
                <li><a href="#">Thương hiệu</a>
                    <ul class="header__menu__dropdown">
                         @foreach ($brands as $brand)
                            <li><a href="{{route('brand', $brand)}}">{{$brand->name}}</a></li>
                         @endforeach   
                    </ul>
                </li>
                <li><a href="{{ route('blog') }}">Bài viết</a></li>
                <li><a href="{{route('contact')}}">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> nongsanviet@gmail.com</li>
                <li>Hỗ trợ vận chuyển đồ toàn quốc</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> nongsanviet@gmail.com</li>
                                <li>Vận chuyển nông sản toàn quốc</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @if (Auth::guard('web')->check())
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="{{route('account')}}"><i class="fa fa-user mr-2"></i>{{Auth::guard('web')->user()->name}}</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{route('logout')}}">Đăng xuất</a>
                                </div>
                            </div>
                        @else
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="{{route('login')}}">Đăng nhập</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{route('register')}}">Đăng ký</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="/"><img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" width="160px"></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><a href="{{route('shop')}}">Cửa hàng</a></li>
                            <li><a href="{{route('brand', '')}}">Xuất xứ</a>
                                <ul class="header__menu__dropdown">
                                    @foreach ($brands as $brand)
                                       <li><a href="{{route('brand', $brand)}}">{{$brand->name}}</a></li>
                                    @endforeach   
                               </ul>
                            </li>
                            <li><a href="{{route('blog')}}">Bài viết</a></li>
                            <li><a href="{{route('contact')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-basket"></i> <span>{{ session('cart') !== null ? count(session('cart')) : 0 }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng tiền: <span>{{convertPrice(session('total_price'))}}</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh mục sản phẩm</span>
                        </div>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{route('category', $category)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{route('shop')}}">
                                <input type="text" id="search" name="search" placeholder="Tìm kiếm sản phẩm" value="{{ request('search') }}">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                            
                            <ul class="list-group" id="result" style="position: absolute; z-index: 1000; background: white; width: 100%;"></ul>
                        </div>
                        
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>0988 888 888</h5>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')

     <!-- Footer Section Begin -->
     <footer class="footer spad">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="/"><img src="/assets/frontend/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: Mê Linh - Mê Linh - Hà Nội</li>
                            <li>Số điện thoại: 0988 888 888</li>
                            <li>Email: nongsanviet@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Hỗ trợ khách hàng</h6>
                        <ul>
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Chính sách sản phẩm</a></li>
                            <li><a href="#">Chính sách vận chuyển</a></li>
                            <li><a href="#">Chính sách đổi trả & bảo hành</a></li>
                            <li><a href="#">Chính sách bảo mật thông tin</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Nhận ưu đãi</h6>
                        <p>Nhận thông tin cập nhật qua e-mail về các ưu đãi đặc biệt.</p>
                        <form action="#">
                            <input type="text" placeholder="Nhập địa chỉ email">
                            <button type="submit" class="site-btn">Đăng ký</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="https://facebook.com"><i class="fa fa-facebook"></i></a>
                            <a href="https://pinterest.com"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </footer>
    <!-- Footer Section End -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Js Plugins -->
    <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                $('#result').html('');
                var search = $('#search').val();
                if (search != '') {
                    $('#result').css('display', 'inherit');
                    var expression = new RegExp(search, 'i');
                    $.getJSON('/json/products.json', function(data) {
                        $.each(data, function(key, value) {
                            if (value.name.search(expression) != -1) {
                                $('#result').append('<li class="list-group-item" style="cursor: pointer">' + value.name + '</li>');
                            }
                        });
                    });
                } else {
                    $('#result').css('display', 'none');
                }
            });

            $('#result').on('click', 'li', function() {
                var click_text = $(this).text();
                $('#search').val($.trim(click_text));
                $('#result').html('');
                $('#result').css('display', 'none');
            });
        });
    </script>

</body>

</html>