<?php

namespace App\Models;

use App\Traits\ActionedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use SoftDeletes, ActionedBy;

    protected $fillable = [
        'name',
        'website',
        'industry',
        'employee_size',
        'company_primary_contact',
    ];
}
