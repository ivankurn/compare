<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'Kategori';
	protected $primaryKey = 'id_kategori';
	protected $fillable = [
		'kategori'
	];
	protected $guarded = [
		'id_kategori'
	];
	
	public $timestamps = false;
	
	public function menu()
    {
        return $this->belongsTo('Menu');
    }
}
