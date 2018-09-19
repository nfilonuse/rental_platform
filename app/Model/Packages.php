<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'smallname', 'description', 'package_order','defaultcheck','is_additional_details',
    ];
}


?>