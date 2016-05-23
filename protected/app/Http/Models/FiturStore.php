<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FiturStore extends Model
{
    protected $table = 'FiturStore';
	protected $primaryKey = 'id_store';
    
    protected $fillable = [
        'id_store'
        'id_fitur'
    ];
    
    protected $guarded = [
    	'id_store'
    ];

    public $timestamps = false;

    public function relasiF(){
        return $this->hasMany('Fitur', 'store');
    }
}
