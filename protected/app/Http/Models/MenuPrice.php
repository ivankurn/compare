<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPrice extends Model
{
	protected $table = 'MenuPrice';
	protected $primaryKey = 'price_id';
	
    protected $fillable = [
    	'id_menu',
    	'plu_id',
    	'id_store',
    	'type', 
    	'size', 
    	'harga'
    ];

    protected $guarded = [
    	'price_id'
    ];

    public $timestamps = false;
}
