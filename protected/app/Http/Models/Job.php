<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'Job';
	protected $primaryKey = 'id_job';
    
    protected $fillable = [
        'id_job',
        'nama_job',
        'requirement',
        'gambar',
        'date_start',
        'date_end',
        'status',
        'created_at',
        'updated_at'
    ];
    
    protected $guarded = [
    	'id_job',
        'created_at'
    ];

    public function contactUs(){
    	return $this->belongsTo('ContactUs');
    }
}
