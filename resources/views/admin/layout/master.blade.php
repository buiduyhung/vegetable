<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.min.css') }}" />
    {{-- <link rel="stylesheet" href="/assets/admin/libs/summernote/summernote-lite.min.css"> --}}
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar" style="background-color: floralwhite; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);"> 
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img mt-3">
                        <img src="/assets/admin/images/logos/logo.png" width="240px" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar mt-4" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-dashboard"></i>
                                </span>
                                <span class="hide-menu">Tổng quan</span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Quản lý sản phẩm</span>
                        </li>
                        
                       <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('categoryProduct.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-category"></i>
                                </span>
                                <span class="hide-menu">Danh mục sản phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('origin.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-list"></i>
                                </span>
                                <span class="hide-menu">Xuất xứ sản phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('productCode.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-book-2"></i>
                                </span>
                                <span class="hide-menu">Mã sản phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('product.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-apple"></i>
                                </span>
                                <span class="hide-menu">Sản phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="" aria-expanded="false">
                                <span>
                                    <i class="ti ti-apple"></i>
                                </span>
                                <span class="hide-menu">Cập nhật giá sản phẩm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('discount.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-pin"></i>
                                </span>
                                <span class="hide-menu">Mã giảm giá</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('order.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-invoice"></i>
                                </span>
                                <span class="hide-menu">Đơn hàng</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Quản lý bài viết</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('categoryPost.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-menu"></i>
                                </span>
                                <span class="hide-menu">Danh mục bài viết</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('post.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-book"></i>
                                </span>
                                <span class="hide-menu">Bài viết</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Quản lý Nhóm người dùng</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('group.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-bolt"></i>
                                </span>
                                <span class="hide-menu">Phân quyền</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('staff.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Nhân viên</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('user.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Thành viên</span>
                            </a>
                        </li>


                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Quản lý thông tin tài khoản</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('staff.profile') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Thông tin cá nhân</span>
                            </a>
                        </li>    
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.password')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-lock"></i>
                                </span>
                                <span class="hide-menu">Đổi mật khẩu</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.logout')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-logout"></i>
                                </span>
                                <span class="hide-menu">Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header" style="background-color: floralwhite; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="{{ route('home') }}">
                                <i class="ti ti-home"> Trang chủ</i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="/assets/admin/images/profile/avatar.jpg" alt="" width="35" height="35"
                                        class="rounded-circle">
                                    <span class="mx-2">
                                        {{ Auth::user()->name }}
                                    </span>    
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{route('admin.logout')}}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng xuất</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            @yield('content')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="/assets/admin/libs/summernote/summernote-lite.min.js"></script> --}}
    <script src="{{ asset('assets/admin/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/admin/js/my_script.js') }}"></script>
    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
    @stack('js')

    <script>
        $(document).ready(function() {

            // delete group
            $('.delete-group').click(function(e){
                e.preventDefault();
    
                var id = $(this).data('id_group');
                var _token = $('input[name="_token"]').val();
    
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('group.destroy') }}",
                            method: "POST",
                            data: {
                                group_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });



            // delete origin
            $('.delete-origin').click(function(e){
                e.preventDefault();
    
                var id = $(this).data('id_origin');
                var _token = $('input[name="_token"]').val();
    
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('origin.destroy') }}",
                            method: "POST",
                            data: {
                                origin_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete category product
            $('.delete-category-product').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_category');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('categoryProduct.destroy') }}",
                            method: "POST",
                            data: {
                                categoryProduct_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete product
            $('.delete-product').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_product');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('product.destroy') }}",
                            method: "POST",
                            data: {
                                product_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete discount
            $('.delete-discount').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_discount');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('discount.destroy') }}",
                            method: "POST",
                            data: {
                                discount_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete post
            $('.delete-post').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_post');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('post.destroy') }}",
                            method: "POST",
                            data: {
                                post_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete category post
            $('.delete-categoryPost').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_categoryPost');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('post.destroy') }}",
                            method: "POST",
                            data: {
                                categoryPost_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });



            // delete staff
            $('.delete-staff').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_staff');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('staff.destroy') }}",
                            method: "POST",
                            data: {
                                staff_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete user
            $('.delete-user').click(function(e){
                e.preventDefault();

                var id = $(this).data('id_user');
                var _token = $('input[name="_token"]').val();

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('user.destroy') }}",
                            method: "POST",
                            data: {
                                user_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            // delete product code
            $('.delete-productCode').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id_productcode');
                var _token = $('input[name="_token"]').val();
                
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Bạn sẽ không thể khôi phục lại điều này!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Có, xóa nó đi!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('productCode.destroy') }}",
                            method: "POST",
                            data: {
                                productCode_id: id,
                                _token: _token
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Đã xóa!",
                                    text: "Dữ liệu đã được xóa thành công.",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Đã xảy ra lỗi. Vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });



        })
    </script>

    

</body>

</html>