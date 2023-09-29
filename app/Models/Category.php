<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "vehicle_category";
    // protected $primarykry="id" ;
    public $timestamps = false;
    protected $fillable = [
            'type',
            'fair',

    ];
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }

    protected function category(){
       return category::query()->get();
    }


}
