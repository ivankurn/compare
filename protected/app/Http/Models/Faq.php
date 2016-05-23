<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'Faq';
	protected $primaryKey = 'id_faq';
    protected $fillable = [
        'question', 
    	'answer', 
    	'created_at',
    	'updated_at'
    ];
    protected $guarded = [
    	'id_faq',
    	'created_at'
    ];
}
