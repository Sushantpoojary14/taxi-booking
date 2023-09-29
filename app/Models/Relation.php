<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Vehicles;
use App\Models\Category;
use App\Models\Customer;
use App\Models\queue;

class Relation extends Model
{
    use HasFactory;

    protected $table = "relation";
    protected $primarykey = "id";

    protected $fillable = [

        'driver_id',
        'category_id',
        'vehicle_id'
    ];
    public $timestamps = false;
    public function vehicles()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id', 'id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function customer()
    {
        return $this->hasMany(Customer::class, 'relation_id', 'id');
    }
    public function queue()
    {
        return $this->hasOne(queue::class, 'relation_id', 'id');
    }

    protected function getRelationById($id)
    {
        return Relation::query()
            ->where('id', $id)
            ->firstOrFail();
    }

    protected function getDriverById($id)
    {
        return Relation::query()
            ->where('driver_id', $id)
            ->firstOrFail();
    }
}
