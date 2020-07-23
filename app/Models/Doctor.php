<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name','title','medical_id'
    ];
    
    public $timestamps = true;
    public $table = "doctors";

    protected $hidden = [
        'created_at','updated_at','hospital_id','pivot'
    ];

    // ******** relations ***********
    public function hopital(){
        return $this->belongsTo('App\Models\Hopital','hospital_id','id');
    }
    public function services(){
        return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }
    


}
