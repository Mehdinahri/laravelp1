<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{

    protected $fillable = [
        'name','Adresse','created_at','updated_at'
    ];
    
    public $timestamps = true;
    public $table = "hopitals";

    protected $hidden = [
        'created_at','updated_at'
    ];

    // ******** relations ***********

    public function doctors(){
        return $this-> hasMany('App\Models\Doctor', 'hospital_id', 'id');
    }

    // ******** end relations ***********
}
