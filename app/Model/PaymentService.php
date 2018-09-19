<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use HertzApi\Model\Checkoutinfo as Checkoutinfo;
use HertzApi\Model\Countries as Countries;
use HertzApi\Model\States as States;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard as CreditCard;
use Illuminate\Support\Facades\Input as Input;
use Auth;

class PaymentService extends Model
{
    protected $table = false;

    private $card=null;
    private $selectpayment='paypal';
    private $gateway=null;
	private $mainform=array();
	private $returnUrl='http://gogo.softaddicts.com/api/paymant/success';
	private $cancelUrl='http://gogo.softaddicts.com//api/paymant/cancel';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public static function get_token_BT()
	{
		$gateway = Omnipay::create('Braintree');
		$gateway->setTestMode(false);
		return $gateway->clientToken()->send()->getToken();

	}
    public function __construct(Request $request)
    {
   		$this->selectpayment=$request['selectpayment'];
   	    if (Auth::guest())
		{
   			$checkoutinfo=Checkoutinfo::where('billing_token',Input::get('_token'))->first();
    	}
    	else
		{
   			$checkoutinfo=Checkoutinfo::where('user_id',Auth::User()->id)->first();
    	}
        $this->setCard(
        	'',
        	$checkoutinfo->billing_first_name,
        	$checkoutinfo->billing_last_name,
        	$request[$this->selectpayment]['number'],
        	$request[$this->selectpayment]['month'],
        	$request[$this->selectpayment]['year'],
        	$request[$this->selectpayment]['cvv2'],
        	$checkoutinfo->billing_company,
        	$checkoutinfo->billing_phone,
        	$checkoutinfo->billing_address,
        	$checkoutinfo->billing_email,
        	$checkoutinfo->billing_city,
        	$checkoutinfo->billing_country_id,
        	$checkoutinfo->billing_state_id,
        	$checkoutinfo->billing_zip_code
        );
		if ($this->selectpayment=='paypal')
		{
			$this->PayPal();
		}
		if ($this->selectpayment=='stripe')
		{
			$this->Stripe();
		}

    }

	public function PayPal()
	{
		$this->gateway = Omnipay::create('Braintree');
/*		
		$this->gateway->setMerchantId('ty76rv9k3cmpts4w');
		$this->gateway->setPublicKey('vzrz6y7w45vyhqqk');
		$this->gateway->setPrivateKey('c65251333dde2c6b5fd135ac43a99ced');
    	$this->gateway->setTestMode(true);
*/
		
		//$this->gateway->setMerchantId('64rzts98pbzjb4vw');
		//$this->gateway->setPublicKey('nwfbfb3h3b2tzy3m');
		//$this->gateway->setPrivateKey('cd6864af0902bb419391ceabe860228b');
    	//$this->gateway->setTestMode(false);

		$this->gateway = Omnipay::create('Braintree');
		if (config('app.debug'))
		{
			$this->gateway->setMerchantId('79wp2x354qm96n92');
			$this->gateway->setPublicKey('mr7wz5g25xz5h7vm');
			$this->gateway->setPrivateKey('25cfe866f7672e89c7c0d297862c4c53');
			$this->gateway->setTestMode(true);
		}
		else
		{
			$this->gateway->setMerchantId('64rzts98pbzjb4vw');
			$this->gateway->setPublicKey('nwfbfb3h3b2tzy3m');
			$this->gateway->setPrivateKey('cd6864af0902bb419391ceabe860228b');
			$this->gateway->setTestMode(false);
		}


		//    	$this->gateway = Omnipay::create('PayPal_Rest');
//		$this->gateway->setClientId('ARgUF_VFX-MN73rmbAcFXZTFqSNPRnILjYh6ppmujyiH7vQDIX8HlAzPJ0ujsL7Kc2MhPyWo5jhl5aXe');
//		$this->gateway->setSecret('EBDEX0KrWva_eD-kuYPdk5PKRXYNq-mEB_g0i7yaLR9x1hnqBWUO_l127cEXPwleFbViXdgdkovYAh6x');
//		$this->gateway->setClientId('AUc1mET6ZCTUcf2nbz2K6Q4s4IAowoG4aafzzsMWpggUnO296idZHgNAAzWcgA36cE_zQgzeWaQBNPXK');
//		$this->gateway->setSecret('EA6GKeVXt9lbpxuRu0HF660_6-CrYYboatyjJtSBjJYX7Z9f4fVZaMaW6qTAmTpSuO7Gc0_MfcEuT-kR');

/*
    	$this->gateway = Omnipay::create('PayPal_Express');
    	$this->gateway->setUsername('filonuse_api1.gmail.com');
    	$this->gateway->setPassword('1369045494');
    	$this->gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31A6MKtA10tc-9OK8-JQ5vm7fy0vRe');
*/
    	//$this->gateway->setSolutionType('DoDirectPayment');
    	//$this->gateway->setNoShipping(true);
	}

	public function Stripe()
	{
		$this->gateway = Omnipay::create('Stripe');
		$this->gateway->setApiKey('sk_test_oAzFuoYWwZgASYJfJRuz0DJf');;
		
	}
	private function setCard($title='',$firstname='',$lastname='', $number='', $em='',$ey='',$cvv='', $company='', $phone='', $address='', $email='', $city='', $country_id='', $state_id='', $zipcode='')
	{
		$country=Countries::where('id',intval($country_id))->first();
		$state=States::where('id',intval($state_id))->first();
		$card = new CreditCard(array());
		$card->setTitle($title);
		$card->setFirstName($firstname);
		$card->setLastName($lastname);

		$card->setNumber($number);
		$card->setExpiryMonth($em);
		$card->setExpiryYear($ey);
		$card->setCvv($cvv);

		$company=($company?$company:'');
		$card->setCompany($company);
		$card->setPhone($phone);
		$card->setEmail($email);

		$card->setAddress1($address);
		$card->setCity($city);
		$card->setCountry($country->smallname);

		$state=($state?$state->smallname:'');
		$card->setState($state);

		$zipcode=($zipcode?$zipcode:'');
		$card->setPostcode($zipcode);
        $this->card=$card;
	}

	public function process()
	{
		// Send purchase request
		try
		{
			//$transaction = $this->gateway->purchase($this->mainform);
			$transaction = $this->gateway->authorize($this->mainform);
			
			$response = $transaction->send();

		} catch (Exception $e) {

		   echo 'Caught exception: ',  $e->getMessage(), "\n";

		}
		return $response;

	}
	public function processBT($token)
	{
		// Send purchase request
		try
		{
			$this->mainform['token']=$token;
			$response = $this->gateway->purchase($this->mainform)->send();
			
		} catch (Exception $e) {

		   echo 'Caught exception: ',  $e->getMessage(), "\n";

		}
		return $response;

	}
	public function setproduct($amount,$currency,$description)
	{
		$this->mainform=[
		    'amount'        => $amount,
		    'currency'      => $currency,
		    'description'   => $description,
		    'returnUrl' 	=> $this->returnUrl,
		    'cancelUrl' 	=> $this->cancelUrl,
		    'card'          => $this->card,
		];


	}
}


?>