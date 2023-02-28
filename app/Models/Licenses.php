<?php

namespace App\Models;

use App\Traits\ActionedBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licenses extends Model
{
    use ActionedBy, SoftDeletes;

    protected $fillable = [
        'product_id',
        'customer_id',
        'user_limit',
        'domain',
        'license_key',
        'status',
        'expiration_date',
        'is_trial',
        'is_lifetime',
        'device_uuid'
    ];

    protected $casts = [
        'is_trial' => 'boolean',
        'is_lifetime' => 'boolean',
        'expiration_date' => 'datetime',
    ];

    public function getExpiresInAttribute(): int
    {
        if ($this->expiration_date < now()) {
            return 0;
        }

        return Carbon::now()->diffInDays($this->expiration_date);
    }
    public function getIsExpiredStatusAttribute(): bool
    {
        if ($this->expiration_date < now()) {
            return true;
        }
        return  false;
    }

    public function getIsTrialAttribute(): bool
    {
        return $this->is_trial ?? false;
    }

}
