<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    protected $table='videos';

    protected $fillable = [
        'name','vues'
    ];
    
    public $timestamps = false;
}
