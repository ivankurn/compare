<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LogSms extends Model
{
    protected $table = 'LogSms';
	protected $primaryKey = 'id_log_sms';
    
    protected $fillable = [
        'id_user',
        'kepada',
        'subject',
        'isi_sms',
        'created_at',
        'updated_at'
    ];
    
    protected $guarded = [
    	'id_log_sms',
        'created_at'
    ];

}
