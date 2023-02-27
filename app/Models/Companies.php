<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'website',
        'industry',
        'employee_size',
        'company_primary_contact'
    ];
}
