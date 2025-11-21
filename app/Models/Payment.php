<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'representative_id',
        'school_id',
        'form_id',
        'amount',
        'commission_rate',
        'commission_amount',
        'net_amount',
        'system_amount',
        'school_amount',
        'system_withdrawn',
        'school_withdrawn',
        'reference',
        'status',
        'payer_phone',
    ];

    protected $casts = [
        'commission_rate' => 'integer',
        'amount' => 'integer',
        'commission_amount' => 'integer',
        'net_amount' => 'integer',
        'system_amount' => 'integer',
        'school_amount' => 'integer',
        'system_withdrawn' => 'boolean',
        'school_withdrawn' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function representative(): BelongsTo
    {
        return $this->belongsTo(User::class, 'representative_id');
    }
}



