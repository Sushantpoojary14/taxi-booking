<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";

    protected $fillable = [
        'fullname',
        'location',
        'coordinate',
        'distance',
        'time_taken',
        'phone',
        'amount',
        'relation_id',
        'payment_mode',
        'booking_time',
        'booking_date'

    ];
}
