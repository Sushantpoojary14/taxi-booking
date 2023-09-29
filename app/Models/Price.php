<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = "price";
    public $timestamps = false;

    protected $fillable = [
        'cgst',
        'sgst',
        'igst',
        'night_charges',
        'booking_charges',
        'gst_number'
];
}
