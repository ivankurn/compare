<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $table = 'Cards';
	protected $primaryKey = 'id_card';
    protected $fillable = [
        'id_user', 
    	'card_number', 
    	'distribution_id', 
    	'card_pin', 
    	'status',
    	'point',
    	'balance',
    	'customer',
    	'issued_date',
    	'activated_date',
    	'confirmed_date',
    	'expired_date',
    	'created_at',
    	'updated_at',
		'created_at'
    ];
    protected $guarded = [
    	'id_card'
    ];
}
