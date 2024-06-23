<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AuthUserController;
use App\Http\Controllers\Frontend\AccountController;
use App\Models\Admin;

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

//Admin
Route::prefix('admin')->group(function () {

    //Auth
    Route::get('login', [AuthController::class, 'login'])->middleware(['guest:admin'])->name('admin.login');
    Route::post('login', [AuthController::class, 'loginPost'])->middleware(['guest:admin'])->name('admin.loginPost');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'] )->name('admin.dashboard');

        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('change-password', [AuthController::class, 'password'])->name('admin.password');
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('admin.change-password');

        //Brand
        Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
        Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('brand/create', [BrandController::class, 'store'])->name('brand.store');
        Route::get('brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('brand/edit/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('brand/delete/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');

        //Category
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('category/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        //Product
        Route::get('product', [ProductController::class, 'index'])->name('product.index');
        Route::post('product', [ProductController::class, 'index'])->name('product.search');
        Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('product/create', [ProductController::class, 'store'])->name('product.store');
        Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::get('product/show/{product}', [ProductController::class, 'show'])->name('product.show');
        Route::get('product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

        Route::post('product/show/price-sale/{productId}', [ProductController::class, 'update_price_sale'])->name('product.updatePriceSale');

        //Order
        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        Route::get('order/show/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::get('order/confirm/{order}', [OrderController::class, 'confirm'])->name('order.confirm');
        Route::get('order/delivered/{order}', [OrderController::class, 'delivered'])->name('order.delivered');
        Route::get('order/back/{order}', [OrderController::class, 'back'])->name('order.back');

        //User
        Route::prefix('users')->name('user.')->group(function () {  //->middleware('can:users')
            Route::get('/', [UserController::class, 'index'])->name('index')->can('viewAny', Admin::class);
            Route::get('create', [UserController::class, 'create'])->name('create')->can('create', Admin::class);
            Route::post('create', [StaffController::class, 'store'])->name('store')->can('create', Admin::class);
            Route::get('edit/{user}', [StaffController::class, 'edit'])->name('edit')->can('update', Admin::class);
            Route::post('edit/{user}', [StaffController::class, 'update'])->name('update')->can('update', Admin::class);
            Route::get('destroy/{user}', [UserController::class, 'destroy'])->name('destroy')->can('delete', Admin::class);

            Route::get('starus/{user}', [UserController::class, 'handleStatus'])->name('status')->can('active', Admin::class);
        });
        

        //Staff
        Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('staff/create', [StaffController::class, 'store'])->name('staff.store');
        Route::get('staff/edit/{staff}', [StaffController::class, 'edit'])->name('staff.edit');
        Route::post('staff/edit/{staff}', [StaffController::class, 'update'])->name('staff.update');
        Route::get('staff/destroy/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');

        //Group
        Route::get('group', [GroupController::class, 'index'])->name('group.index');
        Route::get('group/create', [GroupController::class, 'create'])->name('group.create');
        Route::post('group/create', [GroupController::class, 'store'])->name('group.store');
        Route::get('group/edit/{group}', [GroupController::class, 'edit'])->name('group.edit');
        Route::post('group/edit/{group}', [GroupController::class, 'update'])->name('group.update');
        Route::post('group/destroy', [GroupController::class, 'destroy'])->name('group.destroy');
        
        Route::get('group/permission/{group}', [GroupController::class, 'permission'])->name('group.permission');
        Route::post('group/permission/{group}', [GroupController::class, 'store_permission'])->name('group.storePermission');
    });
    
});



Route::get('/', [ShopController::class, 'index'])->name('home');
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

    Route::get('/doi-mat-khau', [AccountController::class, 'changePassword'])->name('account.change-password');
    Route::post('/doi-mat-khau', [AccountController::class, 'updatePassword'])->name('account.update-password');

});


