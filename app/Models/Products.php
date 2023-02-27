<?php

namespace App\Models;

use App\Traits\ActionedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes, ActionedBy;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
    ];
}
