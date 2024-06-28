<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductCodeController;
use App\Http\Controllers\Admin\TotalController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AuthUserController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//--------------------------Admin-------------------------------------

Route::prefix('admin')->group(function () {

    //Auth
    Route::get('login', [AuthController::class, 'login'])->name('admin.login'); //->middleware(['guest:admin'])
    Route::post('login', [AuthController::class, 'loginPost'])->middleware(['guest:admin'])->name('admin.loginPost');

    Route::middleware(['auth:admin'])->group(function () {
        // dashboard
        Route::get('dashboard', [DashboardController::class, 'index'] )->name('admin.dashboard');
        // total
        Route::get('total', [TotalController::class, 'index'] )->name('admin.total');


        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('change-password', [AuthController::class, 'password'])->name('admin.password');
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('admin.change-password');


        //Origin
        Route::prefix('origin')->name('origin.')->group(function () { //->middleware('can:origins')
            Route::get('/', [OriginController::class, 'index'])->name('index');
            Route::get('create', [OriginController::class, 'create'])->name('add');
            Route::post('create', [OriginController::class, 'store'])->name('store');
            Route::get('edit/{origin}', [OriginController::class, 'edit'])->name('edit');
            Route::post('edit/{origin}', [OriginController::class, 'update'])->name('update');
            Route::post('delete', [OriginController::class, 'destroy'])->name('destroy');

            Route::get('active/{id}', [OriginController::class, 'active'])->name('active');
            Route::get('hidden/{id}', [OriginController::class, 'hidden'])->name('hidden');
        });

        //Category product
        Route::prefix('category-product')->name('categoryProduct.')->group(function () {  //->middleware('can:categoryProducts')
            Route::get('/', [CategoryProductController::class, 'index'])->name('index');
            Route::get('create', [CategoryProductController::class, 'create'])->name('create');
            Route::post('create', [CategoryProductController::class, 'store'])->name('store');
            Route::get('edit/{categoryProduct}', [CategoryProductController::class, 'edit'])->name('edit');
            Route::put('edit/{categoryProduct}', [CategoryProductController::class, 'update'])->name('update');
            Route::post('delete', [CategoryProductController::class, 'destroy'])->name('destroy');

            Route::get('active/{id}', [CategoryProductController::class, 'active'])->name('active');
            Route::get('hidden/{id}', [CategoryProductController::class, 'hidden'])->name('hidden');
        });

        // Product code
        Route::prefix('product-code')->name('productCode.')->group(function () {
            Route::get('/', [ProductCodeController::class, 'index'])->name('index');
            Route::get('create', [ProductCodeController::class, 'create'])->name('create');
            Route::post('create', [ProductCodeController::class, 'store'])->name('store');
            Route::get('edit/{productCode}', [ProductCodeController::class, 'edit'])->name('edit');
            Route::post('edit/{productCode}', [ProductCodeController::class, 'update'])->name('update');
            Route::post('delete', [ProductCodeController::class, 'destroy'])->name('destroy');

            Route::get('active/{id}', [ProductCodeController::class, 'active'])->name('active');
            Route::get('hidden/{id}', [ProductCodeController::class, 'hidden'])->name('hidden');
        });

        //Product
        Route::prefix('product')->name('product.')->group(function () { //->middleware('can:products')
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::post('search', [ProductController::class, 'index'])->name('search');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('create', [ProductController::class, 'store'])->name('store');
            Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
            Route::put('edit/{product}', [ProductController::class, 'update'])->name('update');
            Route::get('show/{product}', [ProductController::class, 'show'])->name('show');
            Route::post('delete', [ProductController::class, 'destroy'])->name('destroy');

            Route::post('price-import/{productId}', [ProductController::class, 'priceImport'])->name('priceImport');
            Route::post('price-sale/{productId}', [ProductController::class, 'priceSale'])->name('priceSale');

            Route::get('active/{id}', [ProductController::class, 'active'])->name('active');
            Route::get('hidden/{id}', [ProductController::class, 'hidden'])->name('hidden');
        });

        // Discount
        Route::prefix('discount')->name('discount.')->group(function () {
            Route::get('/', [DiscountController::class, 'index'])->name('index');
            Route::get('create', [DiscountController::class, 'create'])->name('create');
            Route::post('create', [DiscountController::class, 'store'])->name('store');
            Route::get('edit/{discount}', [DiscountController::class, 'edit'])->name('edit');
            Route::post('edit/{discount}', [DiscountController::class, 'update'])->name('update');
            Route::post('delete', [DiscountController::class, 'destroy'])->name('destroy');

            Route::get('active/{post}', [DiscountController::class, 'active'])->name('active');
            Route::get('hidden/{post}', [DiscountController::class, 'hidden'])->name('hidden');
        });

        // Category Post
        Route::prefix('category-post')->name('categoryPost.')->group(function (){ //->middleware('can:categoryPosts')
            Route::get('/', [CategoryPostController::class, 'index'])->name('index');
            Route::get('create', [CategoryPostController::class, 'create'])->name('create');
            Route::post('create', [CategoryPostController::class, 'store'])->name('store');
            Route::get('edit/{categoryPost}', [CategoryPostController::class, 'edit'])->name('edit');
            Route::post('edit/{categoryPost}', [CategoryPostController::class, 'update'])->name('update');
            Route::post('delete', [CategoryPostController::class, 'destroy'])->name('destroy');

            Route::get('active/{post}', [CategoryPostController::class, 'active'])->name('active');
            Route::get('hidden/{post}', [CategoryPostController::class, 'hidden'])->name('hidden');
        });


        // Post
        Route::prefix('post')->name('post.')->group(function() {  //->middleware('can:posts')
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('show/{post}', [PostController::class, 'show'])->name('show');
            Route::get('create', [PostController::class, 'create'])->name('create');
            Route::post('create', [PostController::class, 'store'])->name('store');
            Route::get('edit/{post}', [PostController::class, 'edit'])->name('edit');
            Route::put('edit/{post}', [PostController::class, 'update'])->name('update');
            Route::post('delete', [PostController::class, 'destroy'])->name('destroy');

            Route::get('active/{post}', [PostController::class, 'active'])->name('active');
            Route::get('hidden/{post}', [PostController::class, 'hidden'])->name('hidden');
        });         

        //Order
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('order', [OrderController::class, 'index'])->name('index');
            Route::get('show/{order}', [OrderController::class, 'show'])->name('show');
            Route::get('confirm/{order}', [OrderController::class, 'confirm'])->name('confirm');
            Route::get('delivered/{order}', [OrderController::class, 'delivered'])->name('delivered');
            Route::get('back/{order}', [OrderController::class, 'back'])->name('back');
        });
        

        //User
        Route::prefix('user')->name('user.')->group(function () {  //->middleware('can:users')
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('create', [UserController::class, 'store'])->name('store');
            Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::post('edit/{user}', [UserController::class, 'update'])->name('update');
            Route::post('delete', [UserController::class, 'destroy'])->name('destroy');

            Route::get('starus/{user}', [UserController::class, 'handleStatus'])->name('status');
        });
        

        //Staff
        Route::prefix('staff')->name('staff.')->group(function () {  //->middleware('can:saffs')
            Route::get('/', [StaffController::class, 'index'])->name('index');
            Route::get('create', [StaffController::class, 'create'])->name('create');
            Route::post('create', [StaffController::class, 'store'])->name('store');
            Route::get('edit/{admin}', [StaffController::class, 'edit'])->name('edit');
            Route::post('edit/{admin}', [StaffController::class, 'update'])->name('update');
            Route::post('destroy', [StaffController::class, 'destroy'])->name('destroy');

            Route::get('profile', [StaffController::class, 'profile'])->name('profile');
        });
        

        //Group
        Route::prefix('group')->name('group.')->group(function () {  //->middleware('can:groups')
            Route::get('/', [GroupController::class, 'index'])->name('index');
            Route::get('create', [GroupController::class, 'create'])->name('create');
            Route::post('create', [GroupController::class, 'store'])->name('store');
            Route::get('edit/{group}', [GroupController::class, 'edit'])->name('edit');
            Route::post('edit/{group}', [GroupController::class, 'update'])->name('update');
            Route::post('destroy', [GroupController::class, 'destroy'])->name('destroy');
            
            Route::get('permission/{group}', [GroupController::class, 'permission'])->name('permission');
            Route::post('permission/{group}', [GroupController::class, 'store_permission'])->name('storePermission');
        });
        
    });
    
});


// ----------------------------------------- Home --------------------------------------------------------


Route::get('/', [ShopController::class, 'index'])->name('home');

Route::get('/bai-viet', [HomeController::class, 'blog'])->name('blog');
Route::get('/bai-viet-chi-tiet/{id}', [HomeController::class, 'blogDetail'])->name('blogDetail');

Route::get('/cua-hang', [ShopController::class, 'shop'])->name('shop');
Route::get('/danh-muc/{category_id}', [ShopController::class, 'getProductByCategory'])->name('category');
Route::get('/thuong-hieu/{brand_id?}', [ShopController::class, 'getProductByBrand'])->name('brand');
Route::get('/san-pham/{product}-{product_slug}', [ShopController::class, 'product'])->name('product');
Route::get('/lien-he', [ShopController::class, 'contact'])->name('contact');

Route::get('/gio-hang', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/increase/{product_id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{product_id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/delete/{product_id}', [CartController::class, 'delete'])->name('cart.delete');


Route::middleware(['guest:web'])->group(function () {
    Route::get('/dang-nhap', [AuthUserController::class, 'login'])->name('login');
    Route::post('/dang-nhap', [AuthUserController::class, 'loginPost'])->name('loginPost');
    Route::get('/dang-ky', [AuthUserController::class, 'register'])->name('register');
    Route::post('/dang-ky', [AuthUserController::class, 'registerPost'])->name('registerPost');

    Route::get('/forgot-password', [AuthUserController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthUserController::class, 'forgotPasswordPost'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthUserController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthUserController::class, 'resetPasswordPost'])->name('password.update');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dang-xuat', [AuthUserController::class, 'logout'])->name('logout');
    
    Route::get('/dat-hang', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkoutPost');
    Route::get('/checkout/vnPayCheck', [CheckoutController::class, 'vnPayCheck'])->name('checkout.vnpay');
    Route::get('/dat-hang/thanh-cong', [CheckoutController::class, 'notification'])->name('checkout.success');

    Route::get('/tai-khoan', [AccountController::class, 'account'])->name('account');
    Route::post('/tai-khoan', [AccountController::class, 'updateAccount'])->name('account.update');

    Route::get('/lich-su-don-hang', [AccountController::class, 'orderHistory'])->name('account.orderHistory');
    Route::get('/chi-tiet-don-hang/{order}', [AccountController::class, 'orderDetail'])->name('order.detail');
    Route::post('/order-history/cancel/{order}', [AccountController::class, 'cancel'])->name('order.cancel');
    Route::post('/order-history/receive/{order}', [AccountController::class, 'receive'])->name('order.receive');
    Route::post('/order-history/return/{order}', [AccountController::class, 'return'])->name('order.return');

    Route::post('/phan-hoi-khach-hang/{order}', [AccountController::class, 'feedback'])->name('account.feedback');

    Route::get('/doi-mat-khau', [AccountController::class, 'changePassword'])->name('account.change-password');
    Route::post('/doi-mat-khau', [AccountController::class, 'updatePassword'])->name('account.update-password');

});


