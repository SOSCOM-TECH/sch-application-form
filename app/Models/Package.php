<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'system_percentage',
        'school_percentage',
        'is_active',
        'sort_order',
        'features',
    ];

    protected $casts = [
        'system_percentage' => 'integer',
        'school_percentage' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'features' => 'array',
    ];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }

    public function getTotalPercentageAttribute(): int
    {
        return $this->system_percentage + $this->school_percentage;
    }
}
