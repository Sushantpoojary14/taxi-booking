<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";
    public $timestamps = false;
    protected $fillable = [
        'fullname',
        'location',
        'coordinate',
        'distance',
        'time_taken',
        'phone',
        'amount',
        'days',
        'total_amount',
        'url',
        'relation_id',
        'customer_token',
        'invoice_id',
        'payment_mode',
        'payment_id',
        'booking_time',
        'booking_date'

    ];
    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }


}
