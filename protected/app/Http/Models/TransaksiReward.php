<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiReward extends Model
{
    protected $table = 'TransaksiReward';
	protected $primaryKey = 'id_transaksi_reward';
    protected $fillable = [
    	'id_transaksi',
        'id_reward',
		'created_at',
    	'updated_at'
    ];
    protected $guarded = [
    	'id_transaksi_reward'
    ];
}
