<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    use HasFactory;

    protected $table = 'code_products';

    protected $fillable = [
        'name',
        'title',
        'desc',
        'status'
    ];

    public function Products() {
        return $this->hasMany(ProductCode::class);
    }
}
