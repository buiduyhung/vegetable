<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';

    protected $fillable = [
        'product_id',
        'price_import',
        'price_sale',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
