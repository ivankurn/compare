<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'Tag';
	protected $primaryKey = 'id_menu';
    protected $fillable = [
    	'id_menu',
    	'tag'    
    ];
    
    protected $guarded = [
    	'id_menu'
    ];

    public $timestamps = false;


}
