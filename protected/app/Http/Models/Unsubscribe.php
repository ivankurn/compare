<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Unsubscribe extends Model
{
    protected $table = 'Unsubscribe';
	protected $primaryKey = 'id_unsubscribe';
    protected $fillable = [
    	'id_user', 
    	'alasan',
    	'updated_at'
    ];
    protected $guarded = [
    	'id_unsubscribe',
    	'created_at'
    ];
}
