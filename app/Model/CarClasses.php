<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class CarClasses extends Model
{
    protected $table = 'car_classes'; 

    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
        'name', 'smallname',
    ];

}


?>