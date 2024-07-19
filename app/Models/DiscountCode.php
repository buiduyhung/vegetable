<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'code_discounts';

    protected $fillable = [
        'name',
        'title',
        'desc',
        'status'
    ];

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
