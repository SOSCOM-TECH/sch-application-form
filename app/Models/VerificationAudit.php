<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_registration_request_id',
        'admin_user_id',
        'action',
        'note',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(SchoolRegistrationRequest::class, 'school_registration_request_id');
    }
}


