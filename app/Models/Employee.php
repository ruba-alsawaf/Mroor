<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Employee extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['role','first_name','last_name','email','password','national_id','birth_date','gender','nationality','profile_image',
                            'phone_number','street_address','city','state','country'];


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
