<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Vehicles;
class Driver extends Model
{
    use HasFactory;
    protected $table = "drivers";
    protected $primarykey="id" ;
    protected $fillable = [
            'firstname',
            'lastname',
            'email',
            'phone',
            'password',
            'status'
    ];
    public $timestamps = false;
    // protected $foreignkey="id" ;
    // public function vehicles(){
    //     return $this->hasMany(Vehicles::class,'id','vehicle_id');
    // }

}
