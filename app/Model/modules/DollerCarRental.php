<?php
	//@include_once("config.php");
	require_once('nusoap/nusoap.php');
	require_once('nusoap/class.wsdlcache.php');
	class DollerCarRental {

		var $xml;
		var $action_code;
		var $car_company;
		var $webserviceURL;
		var $vars;
		var $account_id="";
		var $response = "";

		/**************************************************************
		* dollar
		*
		*
		*
		*/
		public function __construct($action_code,$vars="")
		{
			$this->action_code = $action_code;
			$this->account_id = '1';
			$this->vars = $vars;
			$this->loadCredential(); // if $use_current_credential faslse, load credential according account_id;
			$this->car_company = "dollar";
			$this->xml = $this->setRequestXML($action_code);
			$this->setCredential();
			//echo htmlentities($this->xml);
			//echo htmlentities($this->xml);
			//exit;
		}

		private function setCredential()
		{
			//@todo:fix
			$this->xml = str_replace('<?xml version="1.0"?>','',$this->xml);

			// fetch database and replace
			$this->xml = str_replace("{RES_SOURCE}",$this->vars["account_res_source"],$this->xml);
			$this->xml = str_replace("{RES_PASSWORD}",$this->vars["account_password"],$this->xml);
			$this->xml = str_replace("{TOUR_OPERATOR_NBR}",$this->vars["account_number"],$this->xml);
			$this->webserviceURL = $this->vars["car_company_webservice_url"];


		}

		private function loadCredential(){
			$db = new Database();
			if(trim($this->vars["account_number"])==""){
				/*$db->executeQuery("select * from #__accounts as ac
									inner join #__car_companies as cc on ac.car_company_id=cc.car_company_id
									where ac.account_id='1'");
									*/
			}else{
				$db->executeQuery("select * from #__accounts as ac
									inner join #__car_companies as cc on ac.car_company_id=cc.car_company_id
									where ac.account_number='".$this->vars["account_number"]."'");

			}
			$row=$db->getResult();
			foreach($row as $key=>$val){
				$this->vars[$key]=$val;
			}
		}

		/* getting response from web service*/
		/* getting response from web service*/
		private function getResponseXML()
		{
				//echo htmlentities($this->xml);
				//exit;
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

				//echo htmlentities($this->xml);
				//exit;
				file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogDL'.date('Ymd').'.txt',$wsdl,FILE_APPEND);
				$client = new nusoap_client($wsdl,'wsdl');
				$client->soap_defencoding = 'utf-8';
				$r=$client->send($this->xml, $soapAction, '');
				$response_xml = $client->responseData;
				$response_xml= preg_replace('#(</?)s:#','$1',$response_xml);
				file_put_contents(dirname(__FILE__). DIRECTORY_SEPARATOR . 'LogDL'.date('Ymd').'.txt',$response_xml,FILE_APPEND);

				if($this->action_code=="RateShop" || $this->action_code=="SingleCarRateShop"){
					$xml = simplexml_load_string($response_xml);
					$result =$xml->Body->GetRatesResponse->asXML();
					$result = $this->parseResponseXML($result);
				}else{
					if($this->action_code=="Booking"){
						$xml = simplexml_load_string($response_xml);
						$result =$xml->Body->MakeReservationResponse->asXML();
						$result = $this->parseResponseXML($result);
					}else if($this->action_code=="RetrieveReservation"){
						$result = $this->parseResponseXML($r["RetrieveReservationResult"]);
					}else if($this->action_code=="ModifyReservation"){
						$xml = simplexml_load_string($response_xml);
						$result =$xml->Body->ModifyReservationResponse->asXML();
						$result = $this->parseResponseXML($result);
					}else if($this->action_code=="CANCEL"){
						$xml = simplexml_load_string($response_xml);
						$result =$xml->Body->CancelReservationResponse->asXML();
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
			$arr_result=array(
						  "cancellation_number"=>$this->toString($xml->OTA_VehCancelRS->VehCancelRSCore->UniqueID["ID"])
			);
			return $arr_result;
		}

		public function getSearchResult(){
			$arr_result=array();
			$x = simplexml_load_string($this->getResponseXML());

			$pd = $this->toString($x->OTA_VehAvailRateRS->VehAvailRSCore->VehRentalCore["PickUpDateTime"]);
			$dd = $this->toString($x->OTA_VehAvailRateRS->VehAvailRSCore->VehRentalCore["ReturnDateTime"]);
			$cd = self::count_days($dd,$pd);

			foreach($x->OTA_VehAvailRateRS->VehAvailRSCore->VehVendorAvails->VehVendorAvail->VehAvails->VehAvail as $car)
			{
				$car_wrate ="0";
				$car_drate="0";
				if(strtolower($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitName"])=="week"){
					$car_wrate = $this->toString($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitCharge"]);
				}else{
					$car_drate = $this->toString($car->VehAvailCore->RentalRate->VehicleCharges->VehicleCharge[0]->Calculation["UnitCharge"]);
				}

				if($car_drate=="0"){
					$car_drate=round($car_wrate/7);
				}


				$arr_result[]=array(
						"car_type"=>$this->toString($car->VehAvailCore->Vehicle["VendorCarType"]),
						"car_make"=>$this->toString($car->VehAvailCore->Vehicle->VehMakeModel["Name"]),
						"car_model"=>$this->toString($car->VehAvailCore->Vehicle["VendorCarType"]),
						"rate_code"=>$this->toString($car->VehAvailCore->RentalRate->RateQualifier["RateQualifier"]),
						//"car_rate"=>$this->toString($car->arrLineItem->LineItem->dblRate),
						"car_rate"=>$this->toString($car->VehAvailCore->TotalCharge["RateTotalAmount"]), //total rate
						"car_wrate"=>$car_wrate, //weekly rate
						"car_drate"=>$car_drate , //daily rate
						"car_image"=>$this->toString($car->VehAvailCore->Vehicle->PictureURL),
						"car_currency_code"=>$this->toString($car->VehAvailCore->TotalCharge["CurrencyCode"]),
						"car_for_days"=>$this->toString($cd),
						"reference_id"=>$this->toString($car->VehAvailCore->Reference["ID"]),
						"reference_type"=>$this->toString($car->VehAvailCore->Reference["Type"]),

						"vehtype_vehicle_category"=>$this->toString($car->VehAvailCore->Vehicle->VehType["VehicleCategory"]),
						"vehtype_door_count"=>$this->toString($car->VehAvailCore->Vehicle->VehType["DoorCount"]),
						"vehclass_size"=>$this->toString($car->VehAvailCore->Vehicle->VehClass["Size"])

				);
			}
			return $arr_result;
		}

		public function getBookingResult(){
			$arr_result=array();
			$xml = @simplexml_load_string($this->getResponseXML());
			$x = $xml;
			$arr_result=array(
				"confirmation_number"=>$this->toString($x->OTA_VehResRS->VehResRSCore->VehReservation->VehSegmentCore->ConfID["ID"])
			);
			return $arr_result;
		}
			/*

		public function getReservationResult(){

			$xml = @simplexml_load_string($this->getResponseXML());
			$arr_result=array();
			switch($this->car_company){
			 	case 'dollar':
					$x = $xml->RESERVATION;
					$arr_result=array(
						"confirmation_number"=>$this->toString($x->CONFIRMATION_NBR),
						"first_name"=>$this->toString($x->FIRST_NAME),
						"last_name"=>$this->toString($x->LAST_NAME),
						"phone"=>$this->toString($x->PHONE),
						"pickup_location"=>$this->toString($x->PICKUP_LOCATION_DISPLAY),
						"pickup_date"=>$this->toString($x->PICKUP_DATE),
						"pickup_time"=>$this->toString($x->PICKUP_TIME),
						"dropoff_location"=>$this->toString($x->RETURN_LOCATION_DISPLAY),
						"dropoff_date"=>$this->toString($x->RETURN_DATE),
						"dropoff_time"=>$this->toString($x->RETURN_TIME),
						"car_type"=>$this->toString($x->CAR_DISPLAY),
						"car_image"=>$this->toString($x->CAR_IMAGE),
						"rate_amount"=>$this->toString($x->RATE_AMOUNT),
						"currency_code"=>$this->toString($x->CURRENCY_CODE)
					);
				break;
				case 'thrifty':
						//BookReservationResult
						echo "<pre>";
						print_r($xml);
						exit;
					break;
			}
			return $arr_result;
		}*/

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
					$xml_file = "xml/dollar/single_car_rate_shop.xml";
				break;
				case 'Booking':
					$xml_file  = "xml/dollar/booking.xml";
				break;
				case 'RetrieveReservation':
					$xml_file  = "xml/dollar/retrieve_reservation.xml";
				break;
				case 'CANCEL':
					$xml_file  = "xml/dollar/cancel_booking.xml";
					break;
			}

			if($xml_file!="")
			{
				$x = file_get_contents($xml_file);
                                $this->vars['LOYALTYSET']="";
				if($this->vars['LOYALTY'] != "")  {
                               $this->vars['LOYALTYSET'] = '<CustLoyalty ProgramID="ZR" MembershipID="'.$this->vars['LOYALTY'].'" TravelSector="2" />';
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
			$x = simplexml_load_string($response_xml);

			//rateshop
			if($this->action_code=="RateShop"){
				$error_no = (int) $x->OTA_VehAvailRateRS->Errors->Error["Code"];
				$error_msg .= (string) $x->OTA_VehAvailRateRS->Errors->Error["ShortText"];
			}
			//BOOKING
			if($this->action_code=="Booking"){
				$error_no = (int) $x->OTA_VehResRS->Errors->Error["Code"];
				$error_msg .= (string) $x->OTA_VehResRS->Errors->Error["ShortText"];
			}
			//Modify
			if($this->action_code=="ModifyReservation"){
				$error_no = (int) $x->OTA_VehModifyRS->Errors->Error["Code"];
				$error_msg .= (string) $x->OTA_VehModifyRS->Errors->Error["ShortText"];
			}

			//CANCEL
			if($this->action_code=="CANCEL"){
				$error_no = (int) $x->OTA_VehCancelRS->Errors->Error["Code"];
				$error_msg .= (string) $x->OTA_VehCancelRS->Errors->Error["ShortText"];
			}

			if($error_no>0 || $error_msg!="")
			{
				$this->onErrorResponse($error_no,$error_msg);
				$rxml =  "";
			}
			return $response_xml;
		}

		private function onErrorResponse($error_no,$message)
		{
			echo "<script language='javascript'>";
			echo "location.href='error.php?err_no=".$error_no."&err_msg=".base64_encode($message)."&return_url=".base64_encode($_SERVER["REQUEST_URI"])."';";
			echo "</script>";
			exit;
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
			if($a =="" || $b=="")return "";

			$fd = explode("T", $a);
			$ld = explode("T", $b);

			$dd = explode("-", $fd[0]);
			$dt = explode("-", $ld[0]);

			$ft = explode(":", $fd[1]);
			$lt = explode(":", $ld[1]);

			$gd_a = getdate( $fd[0] );
			$gd_b = getdate( $ld[0]  );

			$a_new = mktime( $ft[0], $ft[1], $ft[2], $dd[1], $dd[2], $dd[0]);
			$b_new = mktime( $lt[0], $lt[1], $lt[2], $dt[1], $dt[2], $dt[0]);
			return ceil( ( $a_new - $b_new ) / 86400 );
		}
	}
?>
