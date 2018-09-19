<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;
use HertzApi\Model\Locations as Locations;

class Rates extends Model
{
    protected $table = 'rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'rate_order', 'disable', 'description',
    ];

	public function accounts($wherePivot = null) {
        return $this->belongsToMany('HertzApi\Model\Accounts', 'rate_accounts', 'rate_id', 'account_id');
    }

	public function packages($wherePivot = null) {
        return $this->belongsToMany('HertzApi\Model\Packages', 'rate_packages', 'rate_id', 'package_id');//->withPivot('play_count')->orderBy('package_order', 'asc');;
    }

	public function areas($wherePivot = null) {
        return $this->belongsToMany('HertzApi\Model\Areas', 'rate_areas', 'rate_id', 'area_id');
    }
	public function sipps($wherePivot = null) {
        return $this->belongsToMany('HertzApi\Model\Sipps', 'rate_sipps', 'rate_id', 'sipp_id');
    }

	public function packages_str() 
	{
		$str='';
		if ($this->packages)
		{
			foreach ($this->packages as $package)
			{
				$str.=($str==''?'':', ').$package->smallname;
			}	
		}
		
        return $str;
    }

	public function areas_str() 
	{
		$str='';
		if ($this->areas)
		{
			foreach ($this->areas as $area)
			{
				$str.=($str==''?'':', ').$area->smallname;
			}	
		}
		
        return $str;
    }

	public function sipps_str() 
	{
		$str='';
		if ($this->sipps)
		{
			foreach ($this->sipps as $sipp)
			{
				$str.=($str==''?'':', ').$sipp->car_model;
			}	
		}
		
        return $str;
    }

	public function accounts_str() 
	{
		$str='';
		if ($this->accounts)
		{
			foreach ($this->accounts as $account)
			{
				$str.=($str==''?'':', ').$account->company->name;
			}	
		}
		
        return $str;
    }

	public static function findratesbyparam($data,$companies) 
	{
		$rates=Rates::where('disable',0)->with(array('packages' => function($query) {
                            $query->orderBy('package_order', 'asc');
                        }))->get();
		$location_pickup=Locations::where('area_code',$data['location-pickup-value'])->first();
		$location_dropoff=Locations::where('area_code',$data['location-dropoff-value'])->first();
		$ads=Packages::where('is_additional_details',1)->pluck('id')->toarray();
		$packdiff=array_diff($data['packages'],$ads);
		//print_r($data['packages']);
		//print_r($packdeff);
		//exit;
		$result=array();
		foreach ($rates as $rate)
		{
			//search by company
			if (!$rate->accounts->whereIn('company_id', $companies)->first()) continue;

			//search by package
			$fnd=true;
			$dop=0;
			foreach ($packdiff as $item)
			{
				if (!$rate->packages->where('id', $item)->first()) 
				{
					$fnd=false;
					break;
				}

			}

			if (!$fnd) continue;

			$ee=$rate->packages->wherein('id', $ads)->toarray();
			$dop=count($ee);

			if ($dop==0)
			{
				if (count($packdiff)!=count($rate->packages))
				{
					continue;
				}
			}
			else
			{
				if ((count($packdiff)+$dop)!=count($rate->packages))
				{
					continue;
				}
			}
			//print $rate->name.' '.$dop."\n";
			//search for additional deteils
			//search by area
			$search_country=$location_pickup->country;
			$search_state=false;
			if ($location_pickup->state=='FL'||$location_pickup->state=='PR')
			{
				$search_state=$location_pickup->state;
			}
			$fndc=false;
			$fnds=false;
			$rate->sipps->all();
			foreach ($rate->areas->all() as $area)
			{
				if (strpos($area['countries'],$search_country)!==false) $fndc=true;
	
				if ($search_state)
				{
					if (strpos($area['states'],$search_state)!==false) $fnds=true;
				}	
			}
			if ($fnds||$fndc)
				$result[]=$rate->toarray();
		}
		//exit;
        return $result;
    }
}


?>