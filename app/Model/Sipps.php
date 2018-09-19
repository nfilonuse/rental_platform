<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Sipps extends Model
{
    protected $table = 'sipps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_model', 'car_dor_id', 'car_class_id', 'company_id'
    ];

    public function carclass() {
    	return $this->belongsTo('HertzApi\Model\CarClasses', 'car_class_id');
    }

    public function dor() {
    	return $this->belongsTo('HertzApi\Model\CarDors', 'car_dor_id');
    }

	public function companies($wherePivot = null) {
        return $this->belongsToMany('HertzApi\Model\Companies', 'sipp_companies', 'sipp_id', 'company_id');
    }
	public function companies_str() 
	{
		$str='';
		if ($this->companies)
		{
			foreach ($this->companies as $company)
			{
				$str.=($str==''?'':', ').$company->name;
			}	
		}
		
        return $str;
    }

}
