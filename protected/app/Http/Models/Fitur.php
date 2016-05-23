<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
    protected $table = 'Fitur';
	protected $primaryKey = 'id_fitur';
    
    protected $fillable = [
        'nama_fitur'
    ];
    
    protected $guarded = [
    	'id_fitur'
    ];

    public $timestamps = false;

    public function store(){
    	return $this->belongsTo('Store');
    }
}
