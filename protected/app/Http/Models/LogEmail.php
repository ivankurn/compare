<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LogEmail extends Model
{
    protected $table = 'LogEmail';
	protected $primaryKey = 'id_log_email';
    
    protected $fillable = [
        'id_user',
        'kepada',
        'subject',
        'isi_email',
        'created_at',
        'updated_at'
    ];
    
    protected $guarded = [
    	'id_log_email',
        'created_at'
    ];

}
