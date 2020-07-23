<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

    protected $fillable = [
        'code','phone','user_id'
    ];
    
    public $timestamps = false;

    protected $hidden = [
        'user_id',
    ];

    // ******** relations ***********

    public function user(){
        return $this ->belongsTo('App\User');
    }

    // ******** end relations ***********


}
