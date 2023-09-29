<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Vehicles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
class Driver extends Authenticatable
{
    use HasFactory;
    protected $table = "drivers";
    // protected $primarykey="id" ;
    protected $fillable = [
            'firstname',
            'lastname',
            'email',
            'phone',
            'password',

    ];
    public $timestamps = false;

    protected function updateDriverById($id, $data,$password)
    {
            Driver::query()
            ->where('id', $id)
            ->update(array_merge($data, [ 'password' => Hash::make($password)]));
    }

    public function relation()
    {
        return $this->hasOne(Relation::class, 'driver_id', 'id');
    }

    public function getFirstNameAttribute($value)
    {
        return strtoupper($value);
    }
    public function getLastNameAttribute($value)
    {
        return strtoupper($value);
    }
}
