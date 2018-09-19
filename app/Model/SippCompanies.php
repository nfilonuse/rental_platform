<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class SippCompanies extends Model
{
    protected $table = 'sipp_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sipp_id', 'company_id'
    ];
}
