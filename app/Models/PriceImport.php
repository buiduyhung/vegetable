<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceImport extends Model
{
    use HasFactory;

    protected $table = "price_imports";

    protected $fillable = [
        'product_id',
        'price_import'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
