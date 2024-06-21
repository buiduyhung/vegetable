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
                        <table class="table text-nowrap mb-0 align-middle">
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
                                        <h6 class="fw-semibold mb-0">Giá nhập</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Khối lượng (Kg/Túi)</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Số lượng</h6>
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
                                        <h6 class="fw-semibold mb-0">{{ $product->brand->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $product->brand->name }}</h6>
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
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold mb-4">Giá sản phẩm: {{ $product->name }}</h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày nhập</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Giá nhập (VNĐ)</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày bán</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Giá bán (VNĐ)</h6>
                                    </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($prices as $price)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{date_format($price->created_at, 'd/m/Y')}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ number_format($price->price_import) }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{date_format($price->updated_at, 'd/m/Y')}}</h6>
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

                    <div class=" mt-5">
                        <h5 class="card-title fw-semibold mb-4">Cập nhật giá: {{$dateToday}}</h5>
                        <div class="mb-2">
                            <form action="{{ route('product.updatePriceSale', $product->id) }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="price_import_new" class="form-label">Giá nhập 
                                        <span class="text-danger">*</span> 
                                    </label>
                                    <input type="text" class="form-control" name="price_import_new" id="price_import_new">
                                    @error('price_import_new')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price_sale_new" class="form-label">Giá bán 
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

        {{-- <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thông tin về sản phẩm</h5>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input class="form-control" value="{{$product->name}}" disabled>
                </div>

                <div class="mb-3">
                    <label for="product_code" class="form-label">Mã sản phẩm </label>
                    <input class="form-control" value="{{$product->product_code}}" disabled>
                </div>
                
                <div class="mb-3">
                    <label for="brand" class="form-label">Thương hiệu</label>
                    <input class="form-control" value="{{$product->brand->name}}" disabled>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Loại sản phẩm</label>
                    <input class="form-control" value="{{$product->category->name}}" disabled>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input class="form-control" value="{{$product->quantity}}" disabled>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Khối lượng</label>
                    <input class="form-control" value="{{$product->weight}}" disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    {!!$product->description!!}
                </div>

                <div class="mb-3">
                    <label class="form-label me-2">Hình ảnh</label>
                    <div class="d-flex">
                        @foreach ($product->images as $image)
                            <img width="150px" class="m-2" src="{{$image->image}}" >
                        @endforeach
                    </div>
                </div>
                
            </div>
            
        </div> --}}
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
        
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: '',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        });
    </script>

@endsection