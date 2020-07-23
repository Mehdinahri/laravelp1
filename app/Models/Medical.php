<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $fillable = [
        'pdf','patient_id'
    ];
    public $table = "medicals";

    public $timestamps = false;
}
