<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
	public $timestamps = false;
	protected $table = 'ForgotPassword';
	protected $primaryKey = 'id_forgot_password';
    protected $fillable = [
    	'id_forgot_password',
    	'id_user', 
    	'kode_forgot', 
    	'valid_until'
    ];
	
}
