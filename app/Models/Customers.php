<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Lecturize\Addresses\Traits\HasAddresses;

class Customers extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'company',
        'position',
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Companies::class, 'id', 'company');
    }
}
