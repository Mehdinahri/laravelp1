<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'nom','created_at','updated_at'
    ];
    
    public $timestamps = true;
    public $table = "services";

    protected $hidden = [
        'created_at','updated_at','pivot'
    ];

    // ******** relations ***********
    public function doctors(){
        return $this->belongsToMany('App\Models\Doctor','doctor_service','service_id','doctor_id','id','id');
    }
}
