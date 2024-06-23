<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\CategoryProduct;
use App\Models\Origin;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categories = CategoryProduct::all();
        $brands = Origin::all();

        $sevenDaysAgo = now()->subDays(7);
        $topProduct_ids = Product::select('products.id as product_id', DB::raw('SUM(order_detail.quantity) as totalSold'))
                    ->join('order_detail', 'products.id', '=', 'order_detail.product_id')
                    ->join('orders', 'order_detail.order_id', '=', 'orders.id')
                    ->where('orders.created_at', '>=', $sevenDaysAgo)
                    ->groupBy('product_id')
                    ->orderByDesc('totalSold')
                    ->limit(3)
                    ->get();
        $topProducts = [];
        foreach ($topProduct_ids as $item) {
            $product = Product::find($item['product_id']);

            if ($product) {
                $product->totalSold = $item['totalSold'];
                $topProducts[] = $product;
            }
        }            
        View::share(compact('categories', 'brands', 'topProducts'));

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
