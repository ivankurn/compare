<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'ContactUs';
	protected $primaryKey = 'id_contactus';
    protected $fillable = [
    	'nama', 
    	'email', 
    	'no_hp', 
    	'perihal', 
        'id_job',
        'cv',
    	'pesan',
        'created_at',
    	'updated_at'
    ];

    protected $quarded = [
    	'id_contactus'
    ];
}
