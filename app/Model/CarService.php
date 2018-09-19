<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Model\modules\DollerCarRental;
//use HertzApi\Model\modules\ThriftyCarRental as ThriftyCarRental;

class CarService extends Model
{
    protected $table = false;

	public static function findCar($company_id,$input_data)
	{
		$data=array();
    	switch ($company_id)
    	{
    		case 2:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("RateShop",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 3:
				include_once('modules/HertsCarRental.php');
				$tcr = new modules\HertsCarRental("RateShop",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
				if (!$tcr->error)
				{
					foreach ($data['result'] as $key=>$item)
					{
						$data['result'][$key]['car_make']=trim($data['result'][$key]['car_make']);
						$data['result'][$key]['car_model']=trim(substr($data['result'][$key]['car_make'],0,strpos($data['result'][$key]['car_make'],' ')));
					}
				}
    		break;
    		case 1:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("RateShop",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
		}
		return $data;

	}

	public static function BookingCar($company_id,$input_data)
	{
		$data=array();
    	switch ($company_id)
    	{
    		case 2:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("Booking",$input_data);
				$result = $tcr->getBookingResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 3:
				include_once('modules/HertsCarRental.php');
				$tcr = new modules\HertsCarRental("Booking",$input_data);
				$result = $tcr->getBookingResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 1:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("Booking",$input_data);
				$result = $tcr->getBookingResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    	}
		return $data;

	}

	public static function CancelCar($company_id,$input_data)
	{
		$data=array();
    	switch ($company_id)
    	{
    		case 2:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("CANCEL",$input_data);
				$result = $tcr->getBookingCancelResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 3:
				include_once('modules/HertsCarRental.php');
				$tcr = new modules\HertsCarRental("CANCEL",$input_data);
				$result = $tcr->getBookingCancelResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 1:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("CANCEL",$input_data);
				$result = $tcr->getBookingCancelResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
		}
		return $data;

	}

	public static function RetrieveReservationCar($company_id,$input_data)
	{
		$data=array();
    	switch ($company_id)
    	{
    		case 2:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("RetrieveReservation",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 3:
				include_once('modules/HertsCarRental.php');
				$tcr = new modules\HertsCarRental("RetrieveReservation",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 1:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("RetrieveReservation",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    	}
		return $data;

	}

	public static function ModifyReservationCar($company_id,$input_data)
	{
		$data=array();
    	switch ($company_id)
    	{
    		case 2:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("ModifyReservation",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 3:
				include_once('modules/HertsCarRental.php');
				$tcr = new modules\HertsCarRental("ModifyReservation",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    		case 1:
				include_once('modules/ThriftyCarRental.php');
				$tcr = new modules\ThriftyCarRental("ModifyReservation",$input_data);
				$result = $tcr->getSearchResult();
				$data['result']=$result;
				$data['error']=$tcr->error;
				$data['error_no']=$tcr->error_no;
				$data['error_text']=$tcr->error_text;
    		break;
    	}
		return $data;

	}
}


?>