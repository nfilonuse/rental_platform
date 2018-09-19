<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Checkoutinfo extends Model
{
    protected $table = 'checkout_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'user_id',
		'billing_first_name',
		'billing_last_name',

		'billing_company',
		'billing_phone',
		'billing_address',

		'billing_email',
		'billing_art',
		'billing_city',

		'billing_country_id',
		'billing_state_id',
		'billing_zip_code',

		'account_first_name',
		'account_last_name',

		'account_company',
		'account_phone',
		'account_address',

		'account_email',
		'account_art',
		'account_city',

		'account_country_id',
		'account_state_id',
		'account_zip_code',

		'send_notified',
		'billing_token',
    ];

    public function country() {
    	return $this->belongsTo('HertzApi\Model\Countries', 'billing_country_id');
    }

    public function state() {
    	return $this->belongsTo('HertzApi\Model\States', 'billing_state_id');
    }

    public function account_country() {
    	return $this->belongsTo('HertzApi\Model\Countries', 'billing_country_id');
    }

    public function account_state() {
    	return $this->belongsTo('HertzApi\Model\States', 'billing_state_id');
    }
}


?>