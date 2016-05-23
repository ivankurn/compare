<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'Kota';
	protected $primaryKey = 'id_kota';
    protected $fillable = [
    	'id_provinsi', 
    	'nama_kota'
    ];

    protected $guarded = [
    	'id_kota'
    ];

    public $timestamps = false;
}
