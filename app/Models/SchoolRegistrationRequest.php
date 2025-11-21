<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolRegistrationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_name',
        'school_type',
        'registration_number',
        'logo_path',
        'address',
        'proof_documents',
        'status',
        'rejection_reason',
        'commission_rate', // Added this
    ];

    protected $casts = [
        'proof_documents' => 'array',
        'commission_rate' => 'integer',
    ];

    public function representative(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


