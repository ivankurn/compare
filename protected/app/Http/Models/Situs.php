<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Situs extends Model
{
	protected $table = 'Situs';
	
    protected $fillable = [
    	'about',
        'tos'
    ];

    public $timestamps = false;
}
