<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class UserAffiliate extends Model
{
    protected $table = 'user_affiliate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'commission_car', 'commission_hotel', 'referral_id',
    ];
}
