<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    use HasFactory;
    protected $table = "_leitura_bejo";

    protected $fillable = [
        'DataLeitura', 'HoraLeitura','_mac_bejo_id', '_sensor_bejo_id'
    ];

    public function _mac_bejo(){
        return $this->belongsTo(Mac::class,'_mac_bejo_id','id');
    }
    public function _sensor_bejo(){
        return $this->belongsTo(Sensor::class,'_sensor_bejo_id','id');
    }

}
