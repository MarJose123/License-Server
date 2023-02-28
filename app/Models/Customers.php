<?php

namespace App\Models;

use App\Traits\ActionedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customers extends Model
{
    use Notifiable, SoftDeletes, ActionedBy;

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

    public function getFullNameAttribute()
    {
        return $this->last_name.', '.$this->first_name;
    }

    public function company(): HasOne
    {
        return $this->hasOne(Companies::class, 'id', 'company');
    }
}
