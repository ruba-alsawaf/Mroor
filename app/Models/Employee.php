<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Employee extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['email','password'];


    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }
}
