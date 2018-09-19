<?php

namespace HertzApi\Model;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_number', 'account_password', 'account_res_source', 'company_id', 'iata_number',
    ];

    public function company() {
    	return $this->belongsTo('HertzApi\Model\Companies', 'company_id');
    }
}


?>