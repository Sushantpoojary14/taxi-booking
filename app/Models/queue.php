<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
class queue extends Model
{
    use HasFactory;
    protected $table = "queue";

    protected  $fillable = [

            'relation_id',
            'arrive_time',
            'status'

    ];
    public $timestamps = false;
protected $foreignkey="driver_id" ;
    public function driver(){
        return $this->hasMany(Driver::class,'id','driver_id');
    }
    public function relation()
    {
        return $this->belongsTo(Relation::class,'relation_id','id');
    }

    protected function status($id)
    {
        queue::query()
            ->where('relation_id',$id)
            ->update([
                'status' => 0
            ]);
    }

}
