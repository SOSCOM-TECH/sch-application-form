<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'type',
        'provider',
        'account_number',
        'account_name',
        'phone_number',
        'mobile_name',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

    public function getDisplayNameAttribute(): string
    {
        $providerName = ucfirst(str_replace('_', ' ', $this->provider ?? ''));
        
        if ($this->type === 'bank') {
            return "{$providerName} - {$this->account_name}" . ($this->account_number ? " ({$this->account_number})" : '');
        } else {
            return "{$providerName} - {$this->mobile_name}" . ($this->phone_number ? " ({$this->phone_number})" : '');
        }
    }
}
