<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'type',
        'model',
        'manufacturing_year',
        'driver_phone',
        'mechanic_name'
    ];

    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }
} 