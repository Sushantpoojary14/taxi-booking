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
        'phone',
        'amount',
        'relation_id',
        'payment_mode',
        'bookint_time'

    ];
}
