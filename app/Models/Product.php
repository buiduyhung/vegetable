<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'quantity',
        'sold',
        'weight',
        'product_code',
        'description',
        'status',
        'origin_id',
        'category_id',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('name', 'quantity', 'price');
    }

    public function priceImports(){
        return $this->hasMany(PriceImport::class);
    }

    public function priceSales(){
        return $this->hasMany(PriceSale::class);
    }

}
