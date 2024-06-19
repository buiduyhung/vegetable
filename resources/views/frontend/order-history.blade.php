@extends('frontend.layout.master')

@section('content')

<section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Lịch sử đơn hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Trang chủ</a>
                        <span>Lịch sử đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="tabs" class="project-tab">
    <div class="container shadow-sm bg-body rounded">
        <div class="row justify-content-center">
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
                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Thời gian</th>
                                    <th class="text-center">Phương thức thanh toán</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Tổng tiền</th>
                                    <th class="text-right">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ date_format($order->created_at,"d-m-Y / H:i:s") }}</td>
                                        <td class="text-center">{{ $order->payment == 1 ? 'VNPay' : 'Tiền mặt'}}</td>
                                        @if($order->status == 0)
                                        <td class="text-center"><span class="status cancel">Hủy đơn</span></td>
                                        @elseif($order->status == 1)
                                        <td class="text-center"><span class="status return">Trả hàng</span></td>
                                        @elseif($order->status == 2)
                                        <td class="text-center"><span class="status pending">Chờ xác nhận</span></td>
                                        @elseif($order->status == 3)
                                        <td class="text-center"><span class="status inprogress">Đang giao</span></td>
                                        @else
                                        <td class="text-center"><span class="status delivered">Đã giao</span></td>
                                        @endif
                                        <td class="text-center">{{ number_format($order->total_price) }}đ</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-end">
                                                @if($order->status == 2)
                                                <form action="{{route('order.cancel', $order)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary cancel mr-3">Hủy đơn</button>
                                                </form>
                                                @elseif($order->status == 3)
                                                <form action="{{route('order.return', $order)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger return mr-3">Trả hàng</button>
                                                </form>
                                                <form action="{{route('order.receive', $order)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info receive mr-3">Nhận hàng</button>
                                                </form>
                                                
                                                @endif
                                                <a href="{{route('order.detail', $order)}}" class="btn btn-primary text-white">Xem chi tiết</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="text-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    
</div>

@endsection