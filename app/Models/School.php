<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'registration_number',
        'logo_path',
        'address',
        'phone',
        'email',
        'status',
    ];

    public function representative(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


