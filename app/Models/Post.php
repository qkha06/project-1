<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'summary',
        'image',
        'slug',
        'category_id',
        'tags',
        'status'
    ];

    protected $attributes = [
        'status' => 1,
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function views()
    {
        return $this->hasMany(PostView::class, 'post_id');
    }
}
