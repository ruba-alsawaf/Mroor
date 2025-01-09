<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['situation', 'registration_plate', 'color', 'tinted', 'type', 'city_id', 'employee_id', 'user_license_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function userLicense()
    {
        return $this->belongsTo(License::class, 'user_license_id');
    }
}
