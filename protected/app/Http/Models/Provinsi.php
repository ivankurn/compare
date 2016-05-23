<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'Provinsi';
	protected $primaryKey = 'id_provinsi';
    protected $fillable = [
    	'nama_provinsi', 
    ];

    protected $guarded = [
    	'id_provinsi'
    ];

    public $timestamps = false;
}
