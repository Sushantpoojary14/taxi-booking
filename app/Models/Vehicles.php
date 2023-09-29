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
            'vehicle_number',
            'vehicle_color',
           'vehicle_permit',
            'category_id'
    ];
    public $timestamps = false;
    public function driver(){
        return $this->hasMany(Driver::class,'vehicle_id');
    }

    protected function updateVehicleById($id, $data, $categoryId)
        {
           
           $update =  Vehicles::query()
                ->where('id', $id)
                ->update(array_merge($data, ['category_id' => $categoryId]));
               
                
        }

        public function setVehicleNumberAttribute($value)
        {
             $this->attributes['vehicle_number'] = strtoupper($value);
        }
        public function getVehicleNumberAttribute($value)
            {
                return strtoupper($value);
            }
}