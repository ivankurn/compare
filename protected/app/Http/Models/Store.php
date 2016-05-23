<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'Store';
	protected $primaryKey = 'id_store';
    protected $fillable = [
    	'slug_store', 
    	'nama_store', 
    	'alamat_store',
    	'kota_resto',
    	'kota_store',
    	'pulau',
    	'kodepos_store',
        'latitude',
    	'longitude',
        'jam_buka',
        'jam_tutup',
    	'phone_resto',
		'created_at',
    	'updated_at'
    ];

    protected $guarded = [
    	'id_transaksi'
    ];

    public function event(){
        return $this->belongsTo('Events');
    }

    public function fitur(){
        return $this->belongsTo('FiturStore');
    }
}
