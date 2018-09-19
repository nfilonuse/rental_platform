<?php

namespace HertzApi\Http\Controllers\API;

use Illuminate\Http\Request;

//use HertzApi\Http\Controllers\API\APIController as APIController;
use HertzApi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use DB;
use HertzApi\Model\Locations;
use HertzApi\Model\Rates as Rates;
use HertzApi\Model\States as States;
use HertzApi\Model\Orders as Orders;
use HertzApi\Model\Companies as Companies;
use HertzApi\Model\CarService as CarService;
use HertzApi\Model\Sipps as Sipps;



class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function locations()
    {
		$data=array();
		$strings=Input::get('location');
		$locations=Locations::query();
		$strings=explode(' ',$strings);
		$idx=0;
		foreach ($strings as $str)
		{
			if (trim($str)!='')
			{
				//if ($idx==0)
					$locations = $locations->where('area_code', 'like', '%' . $str . '%')->orWhere('name', 'like', '%' . $str . '%');
				//else
					//$locations = $locations->orwhere('name', 'like', '%' . $str . '%');
				$idx++;
			}
		}
    	$locations = $locations->orderBy('location_order', 'asc')->orderBy('name')->get();
		$idx=0;
		foreach ($locations as $location)
		{

			$data[]=$location;
			if ($idx>20) break;
			$idx++;
	
		}
		//print_r($data);
		//exit;
        return APIController::json_success($data);

    }
    public function ratecode()
    {
		$packages=Input::get('packages');
		$company_id=Input::get('company_id');
		$rates=Rates::where('disable', 0)->get();
    	$data=array();

		foreach ($rates as $rate)
		{
			$account=$rate->accounts->where('company_id',$company_id)->toarray();
			if (!empty($account))
			{
				$pach=$rate->packages->wherein('id',$packages)->toarray();
				$areas_ss=$rate->areas->toarray();
				$count_area=count($areas_ss);
				if(!empty($pach))
				{
					$data[]=array(
			    		'id'=>$rate->id,
    					'name'=>$rate->name,
    					'description'=>$rate->description,
    				);
				}
			}
		}
		$data=array(
    		'ratecodes'=>$data
		);
        return APIController::json_success($data);

	}
	private function _getcars($cars,$item,$rate,$company,$company_id,$cartype='ECAR')
	{
		$data=Array(
			'account_number' => $rate['accounts'][0]['account_number'],
			'IATA_NUMBER'=>$rate['accounts'][0]['iata_number'],
			'RATE_CODE' => $rate['code'],
			'COMPANY_NAME' => $company->name,
			'company_id' => $company_id,
			'CAR_TYPE' => $cartype,
			'PICKUP_DATETIME' => $item['date-pickup-value'],
			'PICKUP_CITYCODE' => $item['location-pickup-value'],
			'DROPOFF_DATETIME' => $item['date-dropoff-value'],
			'DROPOFF_CITYCODE' => $item['location-dropoff-value'],
			'OPERATOR_NBR' => $rate['accounts'][0]['account_number'],
			'car_company_id' => $company_id,
			'car_company_webservice_url'=> 	$company->webservis,
		);
		$cars_=CarService::findCar($company_id,$data);
		if (!$cars_['error'])
		{
			foreach ($cars_['result'] as $car) 
			{
				$car['company']=$company->toarray();
				$car['packages']=$rate['packages'];
				$car['rate']=$rate;
				$car['dors']='-';
				$car['carclass']='-';
				$sipp=Sipps::where('car_model',$car['car_model'])->with('carclass')->with('dor')->first();						
				if ($sipp)
				{
					$car['dors']=$sipp->dor->name;
					$car['carclass']=$sipp->carclass->name;

				}
				/*
				switch ($car['car_model'])
				{
					case 'CCAR':
					case 'ECAR':
					case 'FCAR':
					case 'ICAR':
					case 'ICAH':
					case 'LCAR':
					case 'PCAR':
					case 'SCAR':
					case 'STAR':
					case 'XXAR':
					case 'B':
					case 'A':
					case 'F':
					case 'D':
					$car['dors']='2/4';
					break;
					case 'CDAR':
					case 'EDAR':
					case 'FDAR':
					case 'GCAR':
					case 'IDAR':
					case 'LDAR':
					case 'PDAR':
					case 'RCAR':
					case 'SDAR':
					case 'K':
					case 'P4':
					case 'C':
					case 'I':
					case 'G':
					case 'R':
					$car['dors']='4/5';
					break;
					case 'FFAR':
					case 'GFDR':
					case 'IFAR':
					case 'LFAR':
					case 'PFAR':
					case 'RFDR':
					case 'SFAR':
					case 'T':
					case 'L6':
					case 'Q4':
					case 'P6':
					case 'T6':
					case 'M4':
					case 'H4':
					case 'L':
					$car['dors']='5';
					break;
					default:
						$car['dors']='-';
					break;

				}


				switch ($car['car_model'])
				{
					case 'CCAR': case 'B': $car['carclass']='Сompact'; break;
					case 'CDAR': $car['carclass']='Compact'; break;
					case 'ECAR': case 'A': $car['carclass']='Economy'; break;
					case 'EDAR': $car['carclass']='Economy'; break;
					case 'FCAR': case 'F': $car['carclass']='Fullsize'; break;
					case 'FDAR': $car['carclass']='Fullsize'; break;
					case 'FFAR': case 'T': $car['carclass']='Fullsize SUV'; break;
					case 'FVAR': $car['carclass']='Fullsize Van'; break;
					case 'GCAR': case 'K': case 'P4': $car['carclass']='Fullsize Elite'; break;
					case 'GFDR': case 'L6': $car['carclass']='Elite SUV'; break;
					case 'ICAR': $car['carclass']='Intermediate'; break;
					case 'ICAH': $car['carclass']='Intermediate Hybrid'; break;
					case 'IDAR': case 'C': $car['carclass']='Intermediate'; break;
					case 'IFAR': case 'Q4': $car['carclass']='Intermediate SUV'; break;
					case 'IVAR': case 'R': $car['carclass']='Intermediate Van'; break;
					case 'LCAR': $car['carclass']='Luxury'; break;
					case 'LDAR': case 'I': $car['carclass']='Luxury'; break;
					case 'LFAR': case 'P6': $car['carclass']='Luxury SUV'; break;
					case 'MVAR': $car['carclass']='Minivan'; break;
					case 'PCAR': $car['carclass']='Premium'; break;
					case 'PDAR': case 'G': $car['carclass']='Premium'; break;
					case 'PFAR': case 'T6': $car['carclass']='Premium SUV'; break;
					case 'RCAR': $car['carclass']='Standard Elite'; break;
					case 'RFDR': case 'M4': case 'H4': $car['carclass']='Standard Elite SUV'; break;
					case 'SCAR': case 'D': $car['carclass']='Standard'; break;
					case 'SDAR': $car['carclass']='Standard'; break;
					case 'SFAR': case 'L': $car['carclass']='Standard SUV'; break;
					case 'STAR': $car['carclass']='Convertible'; break;
					case 'XXAR': $car['carclass']='Special - Compact or larger'; break;
					default:
						$car['carclass']='-';
					break;

				}
				$data['result']['dors']=0;
				if (isset($data['result']['car_make']))
				{
					$data['result']['dors']=4;
					$data['result']['car_make']=trim($data['result']['car_make']);
					$data['result']['car_make']=sudstr($data['result']['car_make'],strpos($data['result']['car_make'],''),strlen($data['result']['car_make']));
				}
*/
				$cars[]=$car;
			
			}
		}
		return $cars;
	}
    public function getcars()
    {
		$location_pickup=Locations::where('area_code',Input::get('locationpickupvalue'))->first();
		$location_dropoff=Locations::where('area_code',Input::get('locationdropoffvalue'))->first();
        $item=array(
        	'location-pickup'=>$location_pickup->name,
        	'location-dropoff'=>$location_dropoff->name,
        	'location-pickup-value'=>Input::get('locationpickupvalue'),
        	'location-dropoff-value'=>Input::get('locationdropoffvalue'),
        	'date-pickup-value'=>Input::get('datepickupvalue'),
        	'date-dropoff-value'=>Input::get('datedropoffvalue'),
        	'driverlicence'=>Input::get('driverlicence'),
        	'packages'=>Input::get('packages'),
        	'_token'=>Input::get('csrfToken'),
        	'date-pickup-value-show'=>date('F d, h:i A',strtotime(Input::get('date-pickup-value'))),
        	'date-dropoff-value-show'=>date('F d, h:i A',strtotime(Input::get('date-dropoff-value'))),
        );
		$companies=Input::get('companies');
		if (empty($companies)||count($companies)<=0)
		{
			$item['car_error']=true;
			$item['car_error_no']=1;
			$item['car_error_text']='Cars not found';
			
			$item['cars']=array();
			$item['car_html']=view('car.searchcontent')->with('data',$item)->render();
		

			return APIController::json_success($item);
		}


		$datasforsearch=Rates::findratesbyparam($item,$companies);
		//print_r($datasforsearch);
		//exit;
		$cars=array();
		if (count($datasforsearch))
		{
			foreach ($datasforsearch as $rate)
			{
				//if ($rate['code']!=='ITUITRCARIB') continue;
				$company_id=$rate['accounts'][0]['company_id'];

				$company=Companies::find($company_id);

				if (is_array($rate['sipps'])&&count($rate['sipps'])>0)
				{
					foreach ($rate['sipps'] as $sipp)
						$cars=$this->_getcars($cars,$item,$rate,$company,$company_id,$sipp['car_model']);
				}
				else
					$cars=$this->_getcars($cars,$item,$rate,$company,$company_id);

/*
				else
				{
					print 'RATE# '.$rate['name'].' COMPANY# '.$company->name.' ERROR# '.$cars_['error_text']."\n";
				}
				break;
*/
			}
		}
		$item['car_error']=false;
		$item['car_error_no']=0;
		$item['car_error_text']='';
		if (!count($cars))
		{
			$item['car_error']=true;
			$item['car_error_no']=1;
			$item['car_error_text']='Cars not found';
			
		}
		usort($cars, function($a, $b) {
			return $a['daily-price'] - $b['daily-price'];
		});		
		//$item['cars']=$cars;
		$item['car_html']=view('car.searchcontent')->with('data',$item)->with('cars',$cars)->render();
		

        return APIController::json_success($item);

    }


    public function getstates()
    {
		$country_id=Input::get('country_id');
    	$data=array();
        $states=States::where('country_id',$country_id)->get()->toarray();
        if (count($states))
        {
			foreach ($states as $state)
			{
				$data[]=array(
	    			'id'=>$state['id'],
					'name'=>$state['name'],
					'smallname'=>$state['smallname'],
				);
			}
        }
		$data=array(
    		'states'=>$data
		);
        return APIController::json_success($data);

    }

    public function getlocations()
    {
		$recordsTotal=Locations::count();
		$columns=Input::get('columns');
		$search=Input::get('search');
        $list = Locations::all();
		if (strlen($search['value'])>2)
		{
				$list=Locations::where('area_code', 'like', '%' . $search['value'] . '%')
								->orWhere('name', 'like', '%' . $search['value'] . '%')
								->orWhere('country', 'like', '%' . $search['value'] . '%')
								->orWhere('state', 'like', '%' . $search['value'] . '%')
								->orWhere('city', 'like', '%' . $search['value'] . '%')
								->orWhere('zip_code', 'like', '%' . $search['value'] . '%')
								->orWhere('phone', 'like', '%' . $search['value'] . '%')
								;
		}
		else
		{
				$list=new Locations;
		}
		if ($orderbys=Input::get('order'))
		{
			foreach ($orderbys as $orderby) 
			{
				$list=$list->orderBy($columns[$orderby['column']]['data'], $orderby['dir']);
			}
		}
		$recordsFiltered=$list->count();

        $list = $list->take(Input::get('length'))->skip(Input::get('start'))->get();

		$items=array();

        if (count($list))
        {
			foreach ($list as $location)
			{
				$items[]=array(
                    	'area_code'=>$location->area_code,
                        'name'=>$location->name,
                    	'country'=>$location->country,
                    	'state'=>$location->state,
                        'city'=>$location->city,
                        'zip_code'=>$location->zip_code,
                        'phone'=>$location->phone,
                        'editcompanies'=>'<a href="'.route('admin.locations.editcompanies', $location->id).'">Companies</a>',
                        'edit'=>'<a href="'.route('admin.locations.edit', $location->id).'">Edit</a>',
                        'delete'=>'<a href="'.route('admin.locations.delete', $location->id).'" onclick="javascript: return confirm(\'Are you sure?\');">Remove</a>',
				);
			}
        }

		$data=array(
    		'draw'=>Input::get('draw'),
    		'recordsTotal'=>$recordsTotal,
    		'recordsFiltered'=>$recordsFiltered,
    		'data'=>$items,
		);
        return APIController::json_success_without_data($data);

    }

    public function getrates()
    {
		$recordsTotal=Rates::count();
		$columns=Input::get('columns');
		$search=Input::get('search');
        $list = Rates::all();
		if (strlen($search['value'])>2)
		{
				$list=Rates::where('code', 'like', '%' . $search['value'] . '%')->orWhere('name', 'like', '%' . $search['value'] . '%');
		}
		else
		{
				$list=new Rates;
		}
		if ($orderbys=Input::get('order'))
		{
			foreach ($orderbys as $orderby) 
			{
				$list=$list->orderBy($columns[$orderby['column']]['data'], $orderby['dir']);
			}
		}
		$recordsFiltered=$list->count();

        $list = $list->take(Input::get('length'))->skip(Input::get('start'))->get();

		$items=array();

        if (count($list))
        {
			foreach ($list as $rate)
			{
				$items[]=array(
                    	'code'=>$rate->code,
                        'name'=>$rate->name,
                    	'rate_order'=>$rate->rate_order,
                    	'disable'=>($rate->disable==0?'No':'Yes'),
                        'editsipps'=>'<a href="'.route('admin.rates.editsipps', $rate->id).'">'.(count($rate->sipps)<=0?'No sipps':$rate->sipps_str()).'</a>',
                        'editareas'=>'<a href="'.route('admin.rates.editareas', $rate->id).'">'.(count($rate->areas)<=0?'No areas':$rate->areas_str()).'</a>',
                        'editaccounts'=>'<a href="'.route('admin.rates.editaccounts', $rate->id).'">'.(count($rate->accounts)<=0?'No account':$rate->accounts_str()).'</a>',
                        'editpackages'=>'<a href="'.route('admin.rates.editpackages', $rate->id).'">'.(count($rate->packages)<=0?'No packages':$rate->packages_str()).'</a>',
                        'edit'=>'<a href="'.route('admin.rates.edit', $rate->id).'">Edit</a>',
                        'delete'=>'<a href="'.route('admin.rates.delete', $rate->id).'" onclick="javascript: return confirm(\'Are you sure?\');">Remove</a>',
				);
			}
        }

		$data=array(
    		'draw'=>Input::get('draw'),
    		'recordsTotal'=>$recordsTotal,
    		'recordsFiltered'=>$recordsFiltered,
    		'data'=>$items,
		);
        return APIController::json_success_without_data($data);

    }

    public function getreports1()
    {
		$recordsTotal=Orders::where('reservation_buy','=',1)->count();
		$columns=Input::get('columns');
		$search=Input::get('search');
		$from=date('Y-m-d 00:00:00',strtotime(Input::get('mindate')));
		$to=date('Y-m-d 23:59:59',strtotime(Input::get('maxdate')));
		if (strlen($search['value'])>2)
		{
				$list=Orders::whereBetween('reservation_date', array($from, $to))->where('reservation_payment_option','=',1)->where('reservation_buy','=',1)->where('reservation_number', 'like', '%' . $search['value'] . '%')
								->orWhere('account_number', 'like', '%' . $search['value'] . '%')
								->orWhere('companies.name', 'like', '%' . $search['value'] . '%')
								->orWhere('reservation_first_name', 'like', '%' . $search['value'] . '%')
								->orWhere('reservation_last_name', 'like', '%' . $search['value'] . '%')
								->orWhere('voucher_number', 'like', '%' . $search['value'] . '%');
		}
		else
		{
				$list=Orders::whereBetween('reservation_date', array($from, $to))->where('reservation_payment_option','=',1)->where('reservation_buy','=',1);
		}
		$list=$list->select( DB::raw( 'orders.*' ) );
		$list=$list->leftJoin('accounts', 'accounts.id', '=', 'orders.account_id');		
		$list=$list->leftJoin('companies', 'companies.id', '=', 'orders.company_id');		
		if ($orderbys=Input::get('order'))
		{
			foreach ($orderbys as $orderby) 
			{
				if($columns[$orderby['column']]['data']=='account_number')
				{
					$list=$list->orderBy('accounts.account_number', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='company_name')
				{
					$list->orderBy('companies.name', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_name')
				{
					$list=$list->orderBy(DB::raw('CONCAT(reservation_first_name,"-",reservation_last_name)'),$orderby['dir']);
					
				}
				elseif($columns[$orderby['column']]['data']=='reservation_pdatetime')
				{
					$list=$list->orderBy(DB::raw('CONCAT(reservation_pdate,"-",reservation_ptime)'), $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_ddatetime')
				{
					$list=$list->orderBy(DB::raw('CONCAT(reservation_ddate,"-",reservation_dtime)'), $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_plocation')
				{
					$list=$list->leftJoin('locations', 'locations.id', '=', 'reservation_plocation_id');		
					$list=$list->orderBy('locations.name', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_dlocation')
				{
					$list=$list->leftJoin('locations', 'locations.id', '=', 'reservation_dlocation_id');		
					$list=$list->orderBy('locations.name', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='coupon_number')
				{
					$list=$list->leftJoin('coupons', 'coupons.id', '=', 'coupon_id');		
					$list=$list->orderBy('coupons.number', $orderby['dir']);
				}
				else
					$list=$list->orderBy($columns[$orderby['column']]['data'], $orderby['dir']);
			}
		}
		$recordsFiltered=$list->count();

        $list = $list->take(Input::get('length'))->skip(Input::get('start'))->get();

		$items=array();

        if (count($list))
        {
			foreach ($list as $order)
			{
				$items[]=array(
                    	'reservation_number'=>'<a href="/voucher/'.$order->company_id.'/'.$order->id.'" target="_blank">'.$order->reservation_number.'</a>',
                        'account_number'=>$order->account->account_number,
                    	'typerow'=>$orderby['dir'],//'car',
                    	'company_name'=>$order->company->name,
                    	'reservation_name'=>trim($order->reservation_first_name.' '.$order->reservation_last_name),
                    	'reservation_phone_number'=>$order->reservation_phone_number,
                    	'reservation_email'=>$order->reservation_email,
                    	'referral_id'=>$order->referral_id,
                    	'agency_name'=>'',
                    	'reservation_pdatetime'=>$order->reservation_pdate.' '.	$order->reservation_ptime,
                    	'reservation_ddatetime'=>$order->reservation_ddate.' '.	$order->reservation_dtime,
                    	'reservation_plocation'=>$order->plocation->name,
                    	'reservation_dlocation'=>$order->dlocation->name,
                    	'voucher_number'=>'<a href="/voucher/'.$order->company_id.'/'.$order->id.'" target="_blank">'.$order->voucher_number.'</a>',
                    	'reservation_for_days'=>$order->reservation_for_days,
                    	'coupon_number'=>($order->coupon?$order->coupon->number:''),
                    	'reservation_total_amount'=>$order->reservation_total_amount,
                    	'discont_amount'=>($order->coupon?$order->coupon->get_discount_amount($order->reservation_total_amount):''),
                    	'total_amount'=>($order->coupon?round($order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount),2):round($order->reservation_total_amount,2)),
                    	'reservation_date'=>$order->reservation_date,
                    	'status_name'=>($order->reservation_cancel?'Canceled':''),
                    	'ref'=>'site',
                    	'agent_name'=>'guest',
							
				);
			}
        }

		$data=array(
    		'draw'=>Input::get('draw'),
    		'recordsTotal'=>$recordsTotal,
    		'recordsFiltered'=>$recordsFiltered,
    		'data'=>$items,
		);
        return APIController::json_success_without_data($data);

    }


    public function getreports2()
    {
		$recordsTotal=Orders::count();
		$columns=Input::get('columns');
		$search=Input::get('search');
		$from=date('Y-m-d 00:00:00',strtotime(Input::get('mindate')));
		$to=date('Y-m-d 23:59:59',strtotime(Input::get('maxdate')));
		if (strlen($search['value'])>2)
		{
				$list=Orders::whereBetween('reservation_date', array($from, $to))->where('reservation_payment_option','=',1)->where('reservation_buy','=',1)->where('reservation_number', 'like', '%' . $search['value'] . '%')
								->orWhere('account_number', 'like', '%' . $search['value'] . '%')
								->orWhere('`companies`.name', 'like', '%' . $search['value'] . '%')
								->orWhere('reservation_first_name', 'like', '%' . $search['value'] . '%')
								->orWhere('reservation_last_name', 'like', '%' . $search['value'] . '%')
								->orWhere('voucher_number', 'like', '%' . $search['value'] . '%');
		}
		else
		{
				$list=Orders::where('reservation_payment_option','=',1)->where('reservation_buy','=',1);
		}
		$list=$list->select( DB::raw( 'orders.*' ) );
		$list=$list->leftJoin('accounts', 'accounts.id', '=', 'orders.account_id');		
		$list=$list->leftJoin('companies', 'companies.id', '=', 'orders.company_id');		
		if ($orderbys=Input::get('order'))
		{
			foreach ($orderbys as $orderby) 
			{
				if($columns[$orderby['column']]['data']=='account_number')
				{
					$list=$list->orderBy('accounts.account_number', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='company_name')
				{
					$list->orderBy('companies.name', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_name')
				{
					$list=$list->orderBy(DB::raw('CONCAT(reservation_first_name,"-",reservation_last_name)'),$orderby['dir']);
					
				}
				elseif($columns[$orderby['column']]['data']=='reservation_pdatetime')
				{
					$list=$list->orderBy(DB::raw('CONCAT(reservation_pdate,"-",reservation_ptime)'), $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_ddatetime')
				{
					$list=$list->orderBy(DB::raw('CONCAT(reservation_ddate,"-",reservation_dtime)'), $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_plocation')
				{
					$list=$list->leftJoin('locations', 'locations.id', '=', 'reservation_plocation_id');		
					$list=$list->orderBy('locations.name', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='reservation_dlocation')
				{
					$list=$list->leftJoin('locations', 'locations.id', '=', 'reservation_dlocation_id');		
					$list=$list->orderBy('locations.name', $orderby['dir']);
				}
				elseif($columns[$orderby['column']]['data']=='coupon_number')
				{
					$list=$list->leftJoin('coupons', 'coupons.id', '=', 'coupon_id');		
					$list=$list->orderBy('coupons.number', $orderby['dir']);
				}
				else
					$list=$list->orderBy($columns[$orderby['column']]['data'], $orderby['dir']);
			}
		}
		$recordsFiltered=$list->count();

        $list = $list->take(Input::get('length'))->skip(Input::get('start'))->get();

		$items=array();

        if (count($list))
        {
			foreach ($list as $order)
			{
				$items[]=array(
                    	'reservation_number'=>'<a href="/voucher/'.$order->company_id.'/'.$order->id.'" target="_blank">'.$order->reservation_number.'</a>',
                        'account_number'=>$order->account->account_number,
                    	'typerow'=>$orderby['dir'],//'car',
                    	'company_name'=>$order->company->name,
                    	'reservation_name'=>trim($order->reservation_first_name.' '.$order->reservation_last_name),
                    	'reservation_phone_number'=>$order->reservation_phone_number,
                    	'reservation_email'=>$order->reservation_email,
                    	'referral_id'=>$order->referral_id,
                    	'agency_name'=>'',
                    	'reservation_pdatetime'=>$order->reservation_pdate.' '.	$order->reservation_ptime,
                    	'reservation_ddatetime'=>$order->reservation_ddate.' '.	$order->reservation_dtime,
                    	'reservation_plocation'=>$order->plocation->name,
                    	'reservation_dlocation'=>$order->dlocation->name,
                    	'voucher_number'=>'<a href="/voucher/'.$order->company_id.'/'.$order->id.'" target="_blank">'.$order->voucher_number.'</a>',
                    	'reservation_for_days'=>$order->reservation_for_days,
                    	'coupon_number'=>($order->coupon?$order->coupon->number:''),
                    	'reservation_total_amount'=>$order->reservation_total_amount,
                    	'discont_amount'=>($order->coupon?$order->coupon->get_discount_amount($order->reservation_total_amount):''),
                    	'total_amount'=>($order->coupon?round($order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount),2):round($order->reservation_total_amount,2)),
                    	'reservation_date'=>$order->reservation_date,
                    	'status_name'=>($order->reservation_cancel?'Canceled':''),
                    	'ref'=>'site',
                    	'agent_name'=>'guest',
							
				);
			}
        }
		$data=array(
    		'draw'=>Input::get('draw'),
    		'recordsTotal'=>$recordsTotal,
    		'recordsFiltered'=>$recordsFiltered,
    		'data'=>$items,
		);
        return APIController::json_success_without_data($data);

    }
}
