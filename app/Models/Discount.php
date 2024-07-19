<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'condition',
        'value',
        'status',
        'code_id'
    ];

    public function discountCode(){
        return $this->belongsTo(DiscountCode::class);
    }

}
