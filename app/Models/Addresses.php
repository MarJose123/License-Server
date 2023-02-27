<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addresses extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'street',
        'city',
        'state',
        'post_code',
        'post_code',
        'is_shipping',

    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
