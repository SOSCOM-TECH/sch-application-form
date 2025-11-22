<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'registration_number',
        'logo_path',
        'cover_image_path',
        'theme_color',
        'address',
        'phone',
        'email',
        'commission_rate',
        'package_id',
        'status',
    ];

    protected $casts = [
        'commission_rate' => 'integer',
    ];

    public function representative(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function paymentAccounts(): HasMany
    {
        return $this->hasMany(PaymentAccount::class);
    }

    public function getEffectiveCommissionRateAttribute(): int
    {
        // Use package percentage if available, otherwise fall back to commission_rate
        return $this->package ? $this->package->system_percentage : ($this->commission_rate ?? 15);
    }
}


