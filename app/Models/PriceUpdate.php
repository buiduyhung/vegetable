<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceUpdate extends Model
{
    use HasFactory;

    protected $table = 'price_update';

    protected $fillable = [
        'product_id',
        'price_import',
        'price_sale'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
