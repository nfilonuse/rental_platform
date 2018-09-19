<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class CarDors extends Model
{
    protected $table = 'car_dors'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'smallname',
    ];
}
