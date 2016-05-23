<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Pulau extends Model
{
    protected $table = 'Pulau';
	protected $primaryKey = 'id_pulau';
    protected $fillable = [
    	'nama_pulau', 
    ];

    protected $guarded = [
    	'id_pulau'
    ];

    public $timestamps = false;
}
