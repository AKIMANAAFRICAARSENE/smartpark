<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_code',
        'service_name',
        'price'
    ];

    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }
} 