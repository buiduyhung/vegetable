<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_posts';

    protected $fillable = [
        'name',
        'slug',
        'desc',
        'status'
    ];

    public function products(){
        return $this->hasMany(Post::class);
    }
}
