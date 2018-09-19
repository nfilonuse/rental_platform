<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Companytypes extends Model
{
    protected $table = 'companytyps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}


?>