<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class UserAffiliateOrders extends Model
{
    protected $table = 'user_affiliate_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'commission', 'commission_amount',
    ];
}
