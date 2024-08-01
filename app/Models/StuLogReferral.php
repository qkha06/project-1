<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuLogReferral extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'link_id',
        'ip_address',
        'identifier',
        'referrer_url',
        'visited_at'
    ];
}
