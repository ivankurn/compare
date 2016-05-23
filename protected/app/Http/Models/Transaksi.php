<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'Transaksi';
	protected $primaryKey = 'id_transaksi';
    protected $fillable = [
    	'receipt_number', 
    	'id_store', 
    	'id_card',
    	'tipe',
    	'amount',
    	'status',
		'created_at',
    	'updated_at'
    ];
    
    protected $guarded = [
    	'id_transaksi'
    ];
}
