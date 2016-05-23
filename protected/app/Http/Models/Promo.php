<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'Promo';
	protected $primaryKey = 'id_promo';
    protected $fillable = [
        'id_resto', 
    	'id_pembuat', 
    	'nama_promo', 
    	'deskripsi',
    	'gambar',
    	'created_at',
    	'updated_at'
    ];
    protected $guarded = [
    	'id_promo',
    	'created_at'
    ];
}
