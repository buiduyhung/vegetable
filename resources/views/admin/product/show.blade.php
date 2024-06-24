@extends('admin.layout.master')

@section('content')
    
    <div class="container-fluid">
        <h1 class="mt-4">Chi tiết thông tin sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Danh sách sản phẩm</a></li>
            <li class="breadcrumb-item active">Chi tiết thông tin sản phẩm</li>
        </ol>

        <div class="row">
            <div class="card w-200">
                <div class="card-body p-4">
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Mã sản phẩm</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Loại sản phẩm</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Xuất xứ</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Khối lượng (Kg/Túi)</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Số lượng (Túi)</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->product_code }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->category->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->origin->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->weight }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->quantity }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="mb-3 mt-5">
                        <label class="form-label me-2">Hình ảnh sản phẩm</label>
                        <div class="d-flex">
                            @foreach ($product->images as $image)
                                <img width="150px" class="m-2" src="{{$image->image}}" >
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3 mt-5">
                        <label for="description" class="form-label">Mô tả</label>
                        {!!$product->description!!}
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            @if(session('msg'))
                <div class="alert alert-success text-center" id="notification">
                    {{session('msg')}}
                </div>
            @endif

            {{-- Bảng giá nhập --}}
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-1">Giá nhập</h5>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Ngày nhập</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Giá nhập (VNĐ)</h6>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($priceImports as $price)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{date_format($price->created_at, 'd/m/Y')}}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ number_format($price->price_import) }}</h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <hr>

                        <form action="{{ route('product.priceImport', $product->id) }}" method="POST">
                            @csrf
                            <div class="mb-3 mt-5">
                                <label for="price_import_new" class="form-label">Giá nhập ngày: {{ $dateToday }}
                                    <span class="text-danger">*</span> 
                                </label>
                                <input type="text" class="form-control" name="price_import_new" id="price_import_new">
                                @error('price_import_new')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
    
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('product.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                        </form>
                        
                    </div>
                </div>
            </div>

            {{-- Bảng giá bán --}}
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-1">Giá bán</h5>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Ngày bán</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Giá bán (VNĐ)</h6>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($priceSales as $price)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{date_format($price->created_at, 'd/m/Y')}}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ number_format($price->price_sale) }}</h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <form action="{{ route('product.priceSale', $product->id) }}" method="POST">
                            @csrf
                            <div class="mb-3 mt-5">
                                <label for="price_sale_new" class="form-label">Giá bán ngày: {{ $dateToday }}
                                    <span class="text-danger">*</span> 
                                </label>
                                <input type="text" class="form-control" name="price_sale_new" id="price_sale_new">
                                @error('price_sale_new')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
    
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('product.index') }}" class="btn btn-danger mx-2">Quay lại</a>
                        </form>
                        
                    </div>
                </div>
            </div>
            
        </div>

    </div>

@endsection