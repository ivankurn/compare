<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'Events';
	protected $primaryKey = 'id_event';
    
    protected $fillable = [
        'id_store', 
    	'nama_event', 
    	'waktu_start', 
    	'waktu_end',
    	'deskripsi',
    	'gambar',
    	'created_at',
    	'updated_at'
    ];

    protected $guarded = [
    	'id_event',
    	'created_at'
    ];

    public function relasiS()
    {
        return $this->hasMany('Store', 'event');
    }
}
