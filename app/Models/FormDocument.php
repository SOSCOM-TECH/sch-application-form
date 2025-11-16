<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'name',
        'description',
        'allowed_types',
        'required',
        'order',
    ];

    protected $casts = [
        'required' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}


