<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Driver;

class Vehicles extends Model
{
    use HasFactory;
    protected $table = "vehicles";
    protected $primarykry="id" ;
    protected $fillable = [
            'vehicle_name',
            'car_number',
            'color',
            'category_id'
    ];
    public $timestamps = false;
    public function driver(){
        return $this->hasMany(Driver::class,'vehicle_id');
    }
}
