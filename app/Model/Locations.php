<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_code', 'country', 'name', 'city', 'state', 'address', 'zip_code', 'phone', 'location_order'
    ];

	public function companies($wherePivot = null) {
        return $this->belongsToMany('HertzApi\Model\Companies', 'location_companies', 'location_id', 'company_id');
    }
}


?>