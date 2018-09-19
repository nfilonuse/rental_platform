<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_rental_id', 'type_coupon_id', 'status_coupon_id', 'number', 'amount', 'date_exp', 'usecoupone',
    ];

    public function typerental() {
    	return $this->belongsTo('HertzApi\Model\TypeRentals', 'type_rental_id');
    }
    public function typecoupon() {
    	return $this->belongsTo('HertzApi\Model\TypeCoupons', 'type_coupon_id');
    }
    public function statuscoupon() {
    	return $this->belongsTo('HertzApi\Model\StatusCoupons', 'status_coupon_id');
    }
	public function get_discount_amount($price)
	{
		$dicount=0;
		if ($this->status_coupon_id==2&&$this->usecoupone==1) {
			return 0;
		}
		if ($this->status_coupon_id==3) return 0;
		if ($this->type_coupon_id==0)
		{
			return $this->amount;
		}
		if ($this->type_coupon_id==1)
		{
			return round($price*$this->amount/100,2);
		}
	}
}


?>