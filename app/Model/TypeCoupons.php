<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class TypeCoupons extends Model
{
    protected $table = 'type_coupons';

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