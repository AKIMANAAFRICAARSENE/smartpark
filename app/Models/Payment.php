<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'service_record_id',
        'amount_paid',
        'payment_date',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount_paid' => 'decimal:2'
    ];

    public function serviceRecord()
    {
        return $this->belongsTo(ServiceRecord::class);
    }
} 