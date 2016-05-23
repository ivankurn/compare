<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
	protected $table = 'Rewards';
	protected $primaryKey = 'id_reward';
    protected $fillable = [
    	'nama_reward',
        'deskripsi', 
    	'reward', 
    	'gambar',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [
    	'created_at',
        'id_reward'
    ];
	
}
