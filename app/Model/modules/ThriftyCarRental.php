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
	//PROD RATESHOP
	define("DOLLAR_RATESHOP_WS_URL","http://ota.dollar.com/OTA/2010A/RateService.svc?WSDL");
	//BOOKING
	define("DOLLAR_BOOKING_WS_URL","http://ota.dollar.com/OTA/2010A/ReservationService.svc?wsdl");
	//PROD RATESHOP
	define("THRIFTY_RATESHOP_WS_URL","http://ota.thrifty.com/OTA/2010A/RateService.svc?WSDL");
	//BOOKING
	define("THRIFTY_BOOKING_WS_URL","http://ota.thrifty.com/OTA/2010A/ReservationService.svc?wsdl");
	//PROD
	define("HERTS_URL","https://vv.xnet.hertz.com/DirectLinkWEB/handlers/DirectLinkHandler?id=ota2007a");

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

	class ThriftyCarRental {
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
			$this->xml = $this->setRequestXML($action_code);

			$this->setCredential();

		}

		private function setCredential()
		{
			//@todo:fix
			
			$this->xml = str_replace('<?xml version="1.0"?>','',$this->xml);


			//$this->xml = str_replace("{RES_SOURCE}",$this->vars["account_res_source"],$this->xml);
			//$this->xml = str_replace("{RES_PASSWORD}",$this->vars["account_password"],$this->xml);
			//$this->xml = str_replace('{OPERATOR_NBR}',$this->vars["account_number"],$this->xml);
			//$this->webserviceURL = $this->vars["car_company_webservice_url"];
			//print_r($this->xml);
			//exit;

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
		}

		/* getting response from web service*/
		private function getResponseXML()
		{


				if($this->action_code=="RateShop" || $this->action_code=="SingleCarRateShop"){ //rateshop
					$wsdl = ($this->car_company=="dollar")?DOLLAR_RATESHOP_WS_URL:THRIFTY_RATESHOP_WS_URL;
					$soapAction = "http://www.opentravel.org/OTA/2003/05/OTA2010A.RateService/GetRates";
					$methodname = "GetRates";

				}else{ //booking
					$wsdl = ($this->car_company=="dollar")?DOLLAR_BOOKING_WS_URL:THRIFTY_BOOKING_WS_URL;;
					if($this->action_code=="Booking"){
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
				file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogTF'.date('Ymd').'.txt',$wsdl,FILE_APPEND);
				$client = new nusoap_client($wsdl,'wsdl');
				$client->soap_defencoding = 'utf-8';
				$client->operation = $methodname;
				$r=$client->send($this->xml, $soapAction, '');
				$response_xml = $client->responseData;
				file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogTF'.date('Ymd').'.txt',$response_xml,FILE_APPEND);
//			print_r($wsdl);
			//print_r($response_xml);
			//print_r($this->car_company);
			//print_r($this->xml);
			//exit;

				if($this->action_code=="RateShop" || $this->action_code=="SingleCarRateShop"){
					$xml = simplexml_load_string($response_xml);
					$name_spaces = $xml->getNamespaces(true);
					$result=$xml->children($name_spaces['s'])->Body->children()->GetRatesResponse->asXML();
					$result = $this->parseResponseXML($result);
				}else{
					if($this->action_code=="Booking"){
						$xml = simplexml_load_string($response_xml);
						$name_spaces = $xml->getNamespaces(true);
						$result=$xml->children($name_spaces['s'])->Body->children()->MakeReservationResponse->asXML();
						$result = $this->parseResponseXML($result);
					}else if($this->action_code=="RetrieveReservation"){
						$result = $this->parseResponseXML($r["RetrieveReservationResult"]);
					}else if($this->action_code=="ModifyReservation"){
						$xml = simplexml_load_string($response_xml);
						$result =$xml->Body->ModifyReservationResponse->asXML();
						$result = $this->parseResponseXML($result);
					}else if($this->action_code=="CANCEL"){
						$xml = simplexml_load_string($response_xml);
						$name_spaces = $xml->getNamespaces(true);
						$result=$xml->children($name_spaces['s'])->Body->children()->CancelReservationResponse->asXML();
						$result = $this->parseResponseXML($result);
					}
				}
			unset($client);
			$this->response = $result;
			return $result;
		}

		public function getBookingCancelResult()
		{
			$arr_result=array();
			$xml = @simplexml_load_string($this->getResponseXML());
			if (!$this->error)
			{
				$arr_result=array(
							  "cancellation_number"=>$this->toString($xml->OTA_VehCancelRS->VehCancelRSCore->UniqueID["ID"])
				);
			}
			return $arr_result;
		}

		public function getSearchResult(){
			$arr_result=array();
			$x = simplexml_load_string($this->getResponseXML());
			if (!$this->error)
			{
				$pd = $this->toString($x->OTA_VehAvailRateRS->VehAvailRSCore->VehRentalCore["PickUpDateTime"]);
				$dd = $this->toString($x->OTA_VehAvailRateRS->VehAvailRSCore->VehRentalCore["ReturnDateTime"]);
				$cd = self::count_days($pd,$dd);

				foreach($x->OTA_VehAvailRateRS->VehAvailRSCore->VehVendorAvails->VehVendorAvail->VehAvails->VehAvail as $car)
				{
					$car_wrate ="0";
					$car_drate="0";
					if(strtolower($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitName"])=="week"){
						$car_wrate = $this->toString($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitCharge"]);
						$car_wrate=round(floatval($car_wrate),0);
					}else{
						$car_drate = $this->toString($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitCharge"]);
						$car_drate=round(floatval($car_drate),0);
					}

					if($car_drate=="0"){
						$car_drate=round($car_wrate/7);
					}
					$arr_result[]=array(
							"code"=>$this->toString($car->VehAvailCore->Vehicle["VendorCarType"]),
							"name"=>trim($this->toString($car->VehAvailCore->Vehicle->VehMakeModel["Name"]).' '.$this->toString($car->VehAvailCore->Vehicle["VendorCarType"])),
							"car_make"=>$this->toString($car->VehAvailCore->Vehicle->VehMakeModel["Name"]),
							"car_model"=>$this->toString($car->VehAvailCore->Vehicle["VendorCarType"]),
							"rate_code"=>$this->toString($car->VehAvailCore->RentalRate->RateQualifier["RateQualifier"]),
							//"car_rate"=>$this->toString($car->arrLineItem->LineItem->dblRate),
							"total-price"=>$this->toString($car->VehAvailCore->TotalCharge["RateTotalAmount"]), //total rate
							"weekly-price"=>$car_wrate, //weekly rate
							"daily-price"=>$car_drate , //daily rate
							"image"=>$this->toString($car->VehAvailCore->Vehicle->PictureURL),
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
				if (count($parser['OTA_VehResRS']['VehResRSCore']['VehReservation']['VehSegmentCore']['ConfID'])>1)
				{
					foreach ($parser['OTA_VehResRS']['VehResRSCore']['VehReservation']['VehSegmentCore']['ConfID'] as $item)
					{
						if ($item['@Type']==14)
						{
							$arr_result=array(
								"confirmation_number"=>$item['@ID']
							);
						}
					}
				}
				else
				{
					$arr_result=array(
						"confirmation_number"=>$parser['OTA_VehResRS']['VehResRSCore']['VehReservation']['VehSegmentCore']['ConfID']['@ID']
					);
				}
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
			//rateshop
			if($this->action_code=="RateShop"){

				if (isset($x->OTA_VehAvailRateRS->Errors))
				{
					$this->error=true;
					$this->error_no = (int) $x->OTA_VehAvailRateRS->Errors->Error["Code"];
					$this->error_text .= (string) $x->OTA_VehAvailRateRS->Errors->Error["ShortText"];
					return false;
				}
			}
			//BOOKING
			if($this->action_code=="Booking"){
				if (isset($x->OTA_VehResRS->Errors))
				{
					$this->error=true;
					$this->error_no = (int) $x->OTA_VehResRS->Errors->Error["Code"];
					$this->error_text .= (string) $x->OTA_VehResRS->Errors->Error["ShortText"];
					return false;
				}
			}
			//Modify
			if($this->action_code=="ModifyReservation"){
				if (isset($x->OTA_VehModifyRS->Errors))
				{
					$this->error=true;
					$this->error_no = (int) $x->OTA_VehModifyRS->Errors->Error["Code"];
					$this->error_text .= (string) $x->OTA_VehModifyRS->Errors->Error["ShortText"];
					return false;
				}
			}

			//CANCEL
			if($this->action_code=="CANCEL"){
				if (isset($x->OTA_VehCancelRS->Errors))
				{
					$this->error=true;
					$this->error_no = (int) $x->OTA_VehCancelRS->Errors->Error["Code"];
					$this->error_text .= (string) $x->OTA_VehCancelRS->Errors->Error["ShortText"];
					return false;
				}
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
