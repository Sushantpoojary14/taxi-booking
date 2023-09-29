<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
    protected $table='permit';

    protected $fillable =[
        'permit_place'
    ];
    public $timestamps = false;
}
