<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory;    
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'views',
        'date',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    
}
