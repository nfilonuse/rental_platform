<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'smallname', 'country_id',
    ];

	public function country() {
    	return $this->belongsTo('HertzApi\Model\Countries', 'country_id');
    }
}


?>