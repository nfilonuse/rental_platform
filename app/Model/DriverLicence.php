<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class DriverLicence extends Model
{
    protected $table = 'driverlicence';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'smallname', 'dl_order',
    ];

}


?>