<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class StatusCoupons extends Model
{
    protected $table = 'status_coupons';

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