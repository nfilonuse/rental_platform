<?php

namespace HertzApi\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'phone', 'second_phone', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'id', 'created_at', 'updated_at', 'commission_hotel',
    ];

    public function role() {
    	return $this->belongsTo('HertzApi\Model\Roles', 'role_id');
    }
	public function useraffiliate()
	{
		return $this->hasOne('HertzApi\Model\UserAffiliate')->orderBy('id', 'DESC')->latest();
	}

}
