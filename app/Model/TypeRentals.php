<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class TypeRentals extends Model
{
    protected $table = 'type_rentals';

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