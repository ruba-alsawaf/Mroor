<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class License extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'national_id',
        'email',
        'points',
        'expiration_date'
    ];
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
