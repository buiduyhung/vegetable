<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;

    protected $table = 'origins';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
