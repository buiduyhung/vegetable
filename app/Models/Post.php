<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'desc',
        'content',
        'categoryPost_id',
        'status'
    ];

    public function categoryPost(){
        return $this->belongsTo(CategoryPost::class, 'categoryPost_id', 'id');
    }
}
