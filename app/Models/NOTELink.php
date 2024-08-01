<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class NOTELink extends Model
{
    use HasFactory, QueryScopes;
    protected $table = 'note_links';
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'alias',
        'title',
        'content',
        'password',
        'status',
        'level_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function clicks()
    {
        return $this->hasMany(NoteLinkClick::class, 'link_id');
    }

}
