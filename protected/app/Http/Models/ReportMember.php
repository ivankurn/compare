<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ReportMember extends Model
{
    protected $table = 'ReportMember';
	protected $primaryKey = 'id_report';
    protected $fillable = [
        'total_transaction', 
    	'total_member', 
    	'total_male', 
    	'total_female',
    	'avg_age',
        'avg_spending',
        'avg_spending_a',
        'avg_spending_b',
        'avg_spending_c',
        'avg_spending_d',
    	'avg_spending_e',
    	'created_at',
    	'updated_at'
    ];
    protected $guarded = [
    	'id_report',
    	'created_at'
    ];
}
