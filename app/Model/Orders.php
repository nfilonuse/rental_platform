<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mail;
class Orders extends Model
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'checkout_detail_id',
		'user_id',
		'reservation_number',
		'voucher_number',
		'record_loc',
		'company_id',

		'car_class_id',

		'agent_id',

		'rate_id',

		'car_class_code',

		'rate_code',

		'account_id',

		'coupon_id',

		'reservation_first_name',
		'reservation_last_name',

		'reservation_phone_number',
		'reservation_email',

		'reservation_country',

		'reservation_plocation_id',
		'reservation_pdate',
		'reservation_ptime',
		'reservation_dlocation_id',
		'reservation_ddate',
		'reservation_dtime',

		'reservation_for_days',
		'reservation_currency_code',

		'reservation_total_amount',
		'reservation_weekly_amount',
		'reservation_daily_amount',

		'reservation_cancel_number',
		'reservation_cancel_comments',
		'reservation_cancel',
		'reservation_cancel_date',

		'reservation_buy',
		'reservation_payment_option',
		'reservation_buy_date',


        'reservation_date',
        
        'referral_id',
    ];
/*
    public function car_class() {
    	return $this->belongsTo('HertzApi\Model\Carclasses', 'car_class_id');
    }

    public function agent() {
    	return $this->belongsTo('HertzApi\Model\Agents', 'agent_id');
    }
*/
    public function billing() {
    	return $this->belongsTo('HertzApi\Model\Checkoutinfo', 'checkout_detail_id');
    }

    public function plocation() {
    	return $this->belongsTo('HertzApi\Model\Locations', 'reservation_plocation_id');
    }

    public function dlocation() {
    	return $this->belongsTo('HertzApi\Model\Locations', 'reservation_dlocation_id');
    }

    public function rate() {
    	return $this->belongsTo('HertzApi\Model\Rates', 'rate_id');
    }

    public function account() {
    	return $this->belongsTo('HertzApi\Model\Accounts', 'account_id');
    }

    public function coupon() {
    	return $this->belongsTo('HertzApi\Model\Coupons', 'coupon_id');
    }

    public function company() {
    	return $this->belongsTo('HertzApi\Model\Companies', 'company_id');
    }

    public function user() {
    	return $this->belongsTo('HertzApi\Model\User', 'user_id');
    }
    public static function makevaucher($order) {
		$voucher_number=DB::table('orders')->max('voucher_number');
		if (intval($voucher_number)<10) $voucher_number=1000;
		$voucher_number++;
		$order->voucher_number=$voucher_number;
		$order->save();
		return $voucher_number;
	}

    public function sendsuccess() 
	{
        if ($this->id<=0) return;
        
		$order=Orders::where('id',$this->id)->with(['rate'=>function($query){
            return $query->with('packages');
        }])->first();
        
		$row=$order->toarray();
		$row['reservation_plocation_name']=$order->plocation->name;
        $row['reservation_dlocation_name']=$order->dlocation->name;
        $row["voucher_description"]=$order->rate->name.": ";
        foreach ($order->rate->packages as $package)
        {
            $row["voucher_description"].=$package->description."\n";
        }
		$row["reservation_total_amount_word"]=Orders::convert_number_to_words($row["reservation_total_amount"]);
					
		Mail::send('emails.car.invoice.company_'.$this->company->id, ['order' => $order, 'params' => $row], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($order->billing->billing_email, $order->billing->billing_first_name.' '.$order->billing->billing_last_name)->subject('GOGOFLORIDA.COM :: INVOICE');
		});

		Mail::send('emails.car.invoice.company_'.$this->company->id, ['order' => $order, 'params' => $row], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($value = config('app.email'), config('app.name'))->subject('GOGOFLORIDA.COM :: NEW RESERVATION');
		});
	}

    public function sendbookerror() 
	{
		if ($this->id<=0) return;
		$order=$this;
					
		Mail::send('emails.car.invoice.bookerror', ['order' => $order], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($order->billing->billing_email, $order->billing->billing_first_name.' '.$order->billing->billing_last_name)->subject('GOGOFLORIDA.COM :: BOOKING FAILED');
		});

		Mail::send('emails.car.invoice.bookerror', ['order' => $order], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($value = config('app.email'), config('app.name'))->subject('GOGOFLORIDA.COM :: BOOKING FAILED');
		});
	}
    public function sendpayerror() 
	{
		if ($this->id<=0) return;
		$order=$this;
					
		Mail::send('emails.car.invoice.payerror', ['order' => $order], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($order->billing->billing_email, $order->billing->billing_first_name.' '.$order->billing->billing_last_name)->subject('GOGOFLORIDA.COM :: PAYMENT FAILED');
		});

	}

    public function sendcancel() 
	{
		if ($this->id<=0) return;
		$order=$this;
					
		Mail::send('emails.car.cancelres.cancel', ['order' => $order], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($order->billing->billing_email, $order->billing->billing_first_name.' '.$order->billing->billing_last_name)->subject('GOGOFLORIDA.COM :: VOUCHER #'.$order->voucher_number.' WAS CANCELED');
		});

		Mail::send('emails.car.cancelres.cancel', ['order' => $order], function ($m) use ($order) {
			$m->from($value = config('app.email'), config('app.name'));
            $m->to($value = config('app.email'), config('app.name'))->subject('GOGOFLORIDA.COM :: VOUCHER #'.$order->voucher_number.' WAS CANCELED');
		});
        
	}

	public static function convert_number_to_words($number) {
   
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ', ';
    $negative    = 'negative ';
    $inte2       = ' Dollars ';
    $decimal     = ' and ';
    $deci2       = ' Cents ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Forty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . self::convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number].$inte2;
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units].$inte2;
            } else {
            $string .= $inte2;
            }

            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . self::convert_number_to_words($remainder);
            } else {
            $string .= $inte2;
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= self::convert_number_to_words($remainder);
            }else {
            $string .= $inte2;
            }

            break;
    }


    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        if ($fraction < 21) {
            $string .= $dictionary[intval($fraction)];
        } else {
            $tens   = ((int) ($fraction / 10)) * 10;
            $units  = $fraction % 10;
            $string .= $dictionary[$tens];
            if ($units) {
                $string .= ' '.$dictionary[$units];
            }
       }

    $string .= $deci2;
    }

    return $string;
	}
}


?>