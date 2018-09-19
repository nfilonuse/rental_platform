<?php
namespace HertzApi\Model\modules;

	//PROD RATESHOP
	if (!defined('DOLLAR_RATESHOP_WS_URL')) define("DOLLAR_RATESHOP_WS_URL","http://ota.dollar.com/OTA/2010A/RateService.svc?WSDL");
	//BOOKING
	if (!defined('DOLLAR_BOOKING_WS_URL')) define("DOLLAR_BOOKING_WS_URL","http://ota.dollar.com/OTA/2010A/ReservationService.svc?wsdl");
	//PROD RATESHOP
	if (!defined('THRIFTY_RATESHOP_WS_URL')) define("THRIFTY_RATESHOP_WS_URL","http://ota.thrifty.com/OTA/2010A/RateService.svc?WSDL");
	//BOOKING
	if (!defined('THRIFTY_BOOKING_WS_URL')) define("THRIFTY_BOOKING_WS_URL","http://ota.thrifty.com/OTA/2010A/ReservationService.svc?wsdl");
	//PROD
	if (!defined('HERTS_URL')) define("HERTS_URL","https://vv.xnet.hertz.com/DirectLinkWEB/handlers/DirectLinkHandler?id=ota2007a");
/*
	//TEST RATESHOP  
	 define("DOLLAR_RATESHOP_WS_URL","http://consumerservices.staging.dollar.com/OTA/2010A/RateService.svc?WSDL");
	//TEST BOOKING 
	 define("DOLLAR_BOOKING_WS_URL","http://consumerservices.staging.dollar.com/OTA/2010A/ReservationService.svc?wsdl"); 
	//TEST RATESHOP
	define("THRIFTY_RATESHOP_WS_URL","http://consumerservices.staging.thrifty.com/OTA/2010A/RateService.svc?WSDL");
	//TEST BOOKING 
	define("THRIFTY_BOOKING_WS_URL","http://consumerservices.staging.thrifty.com/OTA/2010A/ReservationService.svc?wsdl"); 

	//TEST
	define("HERTS_URL","https://vv.xqual.hertz.com/DirectLinkWEB/handlers/DirectLinkHandler?id=ota2007a");
*/
	use HertzApi\Model\Accounts as Accounts;

	use nusoap_client;
	use DateTime;
	use Parser;

	class HertsCarRental {
		var $xml;
		var $action_code;
		var $car_company;
		var $webserviceURL;
		var $vars;
		var $account_id="";
		var $response = "";
		var $error=false;
		var $error_no='';
		var $error_text='';

		public function __construct($action_code,$vars="")
		{
			$this->action_code = $action_code;
			$this->account_id = '2';
			$this->vars = ($vars=="")?$_POST:$vars;
			$this->loadCredential(); // if $use_current_credential faslse, load credential according account_id;
			if ($vars['company_id']==2)
				$this->car_company = 'thrifty';
			if ($vars['company_id']==1)
				$this->car_company = 'dollar';
			if ($vars['company_id']==3)
				$this->car_company = 'herts';
			$this->xml = $this->setRequestXML($action_code);
			$this->setCredential();

		}

		private function setCredential()
		{
			//@todo:fix
			$this->xml = str_replace('<?xml version="1.0"?>','',$this->xml);

/*
			$this->xml = str_replace("{RES_SOURCE}",$this->vars["account_res_source"],$this->xml);
			$this->xml = str_replace("{RES_PASSWORD}",$this->vars["account_password"],$this->xml);
			$this->xml = str_replace("{TOUR_OPERATOR_NBR}",$this->vars["account_number"],$this->xml);
			$this->webserviceURL = $this->vars["car_company_webservice_url"];
*/
		}

		private function loadCredential(){
			//print_r($this->vars);
			if(trim($this->vars["account_number"])==""){
				$account=Accounts::find(2)->toarray();
			}else{
				$account=Accounts::where('account_number',$this->vars["account_number"])->first()->toarray();
			}

			foreach($account as $key=>$val){
				$this->vars[$key]=$val;
			}
			//print_r($this->vars);
			//exit;
		}

		function sendPostRequest($xml){ //******************** Sends request ************/
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, HERTS_URL);
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
		    $result = curl_exec($ch);
		    if ( curl_errno($ch) ) {
		        $result = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch);
		    } else {
		        $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
		        switch($returnCode){
		            case 404:
        		        $result = 'ERROR -> 404 Not Found';
		                break;
        		    default:
		                break;
		        }
		    }
		    curl_close($ch);
		    return $result;
		}
		/* getting response from web service*/
		private function getResponseXML()
		{


				if($this->action_code=="RateShop" || $this->action_code=="SingleCarRateShop"){ //rateshop
					$wsdl='https://vv.xnet.hertz.com/DirectLinkWEB/handlers/DirectLinkHandler?id=ota2007a';
					$soapAction = "http://www.opentravel.org/OTA/2003/05/OTA2010A.RateService/GetRates";
					$methodname = "GetRates";

				}else{ //booking
					$wsdl = ($this->car_company=="dollar")?DOLLAR_BOOKING_WS_URL:THRIFTY_BOOKING_WS_URL;;
					if($this->action_code=="Booking"){
						$wsdl='https://vv.xnet.hertz.com/DirectLinkWEB/handlers/DirectLinkHandler?id=ota2007a';
						$methodname = "MakeReservation";
						$soapAction = "http://www.opentravel.org/OTA/2003/05/OTA2010A.ReservationService/MakeReservation";
					}else if($this->action_code=="RetrieveReservation"){
						$soapAction ="http://DTG.TourDirect/IReservationService/RetrieveReservation";
						$methodname="RetrieveReservation";

					}else if($this->action_code=="ModifyReservation"){
						$soapAction ="http://www.opentravel.org/OTA/2003/05/OTA2010A.ReservationService/ModifyReservation";
						$methodname="ModifyReservation";
					}else if($this->action_code=="CANCEL"){
						$soapAction ="http://www.opentravel.org/OTA/2003/05/OTA2010A.ReservationService/CancelReservation";
						$methodname="CancelReservation";
					}
				}
			//print_r($this->xml);
			//exit;
			file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogHR'.date('Ymd').'.txt',$this->xml,FILE_APPEND);
			file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogHR'.date('Ymd').'.txt',print_r($this->vars,true),FILE_APPEND);
			
			$result = $this->sendPostRequest($this->xml);
				file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogHR'.date('Ymd').'.txt',$result,FILE_APPEND);
				
			//print_r($wsdl);
			//print_r($this->xml);
			//print_r($result);
			//exit;

				if($this->action_code=="RateShop" || $this->action_code=="SingleCarRateShop"){
					$result = $this->parseResponseXML($result);
				}else{
					if($this->action_code=="Booking"){
						$result = $this->parseResponseXML($result);
					}else if($this->action_code=="RetrieveReservation"){
						$result = $this->parseResponseXML($r["RetrieveReservationResult"]);
					}else if($this->action_code=="ModifyReservation"){
						$result = $this->parseResponseXML($result);
					}else if($this->action_code=="CANCEL"){
						$result = $this->parseResponseXML($result);
					}
				}
			//unset($client);
			$this->response = $result;
			return $result;
		}

		public function getBookingCancelResult()
		{
			$arr_result=array();
			$xml=$this->getResponseXML();
			$arr_result=array(
				"cancellation_number"=>'error'
			);

			if (!$this->error)
			{
				$parser=Parser::xml($xml);
				$arr_result=array(
					"cancellation_number"=>$parser['VehCancelRSCore']['UniqueID']['@ID']
				);
			}
			return $arr_result;
		}

		public function getSearchResult(){
			$arr_result=array();
			$x = simplexml_load_string($this->getResponseXML());
			if (!$this->error)
			{
				$pd = $this->toString($x->VehAvailRSCore->VehRentalCore["PickUpDateTime"]);
				$dd = $this->toString($x->VehAvailRSCore->VehRentalCore["ReturnDateTime"]);
				$cd = self::count_days($pd,$dd);
				if ($cd==0) $cd=1;
				foreach($x->VehAvailRSCore->VehVendorAvails->VehVendorAvail->VehAvails->VehAvail as $car)
				{
					$car_total ="0";
					$car_wrate ="0";
					$car_drate="0";
					$car_total =$this->toString($car->VehAvailCore->TotalCharge["EstimatedTotalAmount"]);
					if(strtolower($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitName"])=="week"){
						$car_wrate = $this->toString($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitCharge"]);
						$car_wrate=round(floatval($car_wrate),0);
					}elseif(strtolower($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitName"])=="day"){
						$car_drate = $this->toString($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitCharge"]);
						$car_drate=round(floatval($car_drate),0);
					}

					if($car_drate=="0"){
						$car_drate=round(floatval($car_total)/$cd);
					}
					if($car_wrate=="0"){
						$car_wrate=round(floatval($car_total)/7);
					}
					$arr_result[]=array(
							"code"=>$this->toString($car->VehAvailCore->Vehicle["VendorCarType"]),
							"name"=>trim($this->toString($car->VehAvailCore->Vehicle->VehMakeModel["Name"]).' '.$this->toString($car->VehAvailCore->Vehicle["VendorCarType"])),
							"car_make"=>$this->toString($car->VehAvailCore->Vehicle->VehMakeModel["Name"]),
							"car_model"=>$this->toString($car->VehAvailCore->Vehicle["VendorCarType"]),
							"rate_code"=>$this->toString($car->VehAvailCore->RentalRate->RateQualifier["RateQualifier"]),
							//"car_rate"=>$this->toString($car->arrLineItem->LineItem->dblRate),
							"total-price"=>$this->toString($car->VehAvailCore->TotalCharge["EstimatedTotalAmount"]), //total rate
							"weekly-price"=>$car_wrate, //weekly rate
							"daily-price"=>$car_drate , //daily rate
							"image"=>'https://images.hertz.com/vehicles/220x128/'.$this->toString($car->VehAvailCore->Vehicle->PictureURL),
							"car_currency_code"=>$this->toString($car->VehAvailCore->TotalCharge["CurrencyCode"]),
							"car_for_days"=>$this->toString($cd),
							"reference_id"=>$this->toString($car->VehAvailCore->Reference["ID"]),
							"reference_type"=>$this->toString($car->VehAvailCore->Reference["Type"]),

							"baggage"=>$this->toString($car->VehAvailCore->Vehicle["BaggageQuantity"]),
							"doors"=>4,
							"seats"=>$this->toString($car->VehAvailCore->Vehicle["PassengerQuantity"])

					);
				}
			}
			return $arr_result;
		}

		public function getBookingResult(){
			$arr_result=array();
			$xml=$this->getResponseXML();
			$arr_result=array(
				"confirmation_number"=>'error'
			);

			if (!$this->error)
			{
				$parser=Parser::xml($xml);
				$arr_result=array(
					"confirmation_number"=>$parser['VehResRSCore']['VehReservation']['VehSegmentCore']['ConfID']['@ID']
				);
			}
			return $arr_result;
		}

		public function getReservationResult(){
			$xml = @simplexml_load_string($this->getResponseXML());
			$arr_result=array();
			//echo "<pre>";
			//print_r($xml);
			return $arr_result;
		}

		private function toString($obj){
			return (string) $obj;
		}

		/* creating xml accoding to user inputs*/
		private function setRequestXML($cmd="")
		{
			$xml_file = "";
				switch($cmd){
					case 'SingleCarRateShop':
					case 'RateShop':
						$xml_file = dirname(__FILE__)."/xml/".$this->car_company."/single_car_rate_shop.xml";
					break;
					case 'Booking':
						$xml_file  = dirname(__FILE__)."/xml/".$this->car_company."/booking.xml";
					break;
					case 'RetrieveReservation':
						$xml_file  = dirname(__FILE__)."/xml/".$this->car_company."/retrieve_reservation.xml";
					break;
					case 'CANCEL':
						$xml_file  = dirname(__FILE__)."/xml/".$this->car_company."/cancel_booking.xml";
					break;
				}


			if($xml_file!="")
			{
				$x = file_get_contents($xml_file);
                $this->vars['LOYALTYSET']="";
                $this->vars['LOYALTY']="";
				if($this->vars['LOYALTY'] != "")  {
                               $this->vars['LOYALTYSET'] = '<CustLoyalty ProgramID="ZT" MembershipID="'.$this->vars['LOYALTY'].'" TravelSector="2" />';
				 }

				foreach($this->vars as $key=>$val){
					$k = trim($key);
					//@todo:fix for vehicle_pref for thirfity;
					//$v = $this->escapeXML(trim($val));
					$v = $val;
					$x = str_replace("{".$k."}",$v,$x);
				}
				$xml = simplexml_load_string($x);
				return str_replace(array("\n","\r","\t"),array("","",""),$xml->asXML());
			}
		}

		private function escapeXML($xmlValue) {
			// Escape any XML entities
			$xmlValue = str_replace("&", "&amp;", $xmlValue);
			$xmlValue = str_replace("<", "&lt;", $xmlValue);
			$xmlValue = str_replace(">", "&gt;", $xmlValue);
			$xmlValue = str_replace("\"", "&quot;", $xmlValue);
			$xmlValue = str_replace("'", "&apos;", $xmlValue);

			return $xmlValue;
		}

		private function parseResponseXML($response_xml="")
		{
			/*echo "<textarea rows='50' cols='100'>";
			echo $response_xml;
			echo "</textarea>";
			$rxml = html_entity_decode($response_xml);
			*/
			$this->error_no = 0;
			$this->error_text = '';
			$x = simplexml_load_string($response_xml);
			//print_r($response_xml);
			//exit;
			if (isset($x->Errors))
			{
				//rateshop
				if($this->action_code=="RateShop"){

					$this->error_no = (int) $x->Errors->Error["Code"];
					$this->error_text .= (string) $x->Errors->Error["ShortText"];
				}
				//BOOKING
				if($this->action_code=="Booking"){
					$this->error_no = (int) $x->Errors->Error["Code"];
					$this->error_text .= (string) $x->Errors->Error["ShortText"];
				}
				//Modify
				if($this->action_code=="ModifyReservation"){
					$this->error_no = (int) $x->Errors->Error["Code"];
					$this->error_text .= (string) $x->Errors->Error["ShortText"];
				}

				//CANCEL
				if($this->action_code=="CANCEL"){
					$this->error_no = (int) $x->Errors->Error["Code"];
					$this->error_text .= (string) $x->Errors->Error["ShortText"];
				}
				$this->error=true;
				return false;
			}
			return $response_xml;
		}


		static function encodeObject($obj)
		{
			return base64_encode(serialize($obj));
		}

		static function decodeObject($obj)
		{
			return unserialize(base64_decode($obj));
		}

		static  function count_days($a, $b )
		{
			$fd = explode("T", $a);
			$ld = explode("T", $b);
			$datetime1 = new DateTime($fd[0]);
			$datetime2 = new DateTime($ld[0]);
			$interval = $datetime1->diff($datetime2);
			return $interval->format('%a');
		}
	}
?>
