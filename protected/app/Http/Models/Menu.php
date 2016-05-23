<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'Menu';
	protected $primaryKey = 'id_menu';
    protected $fillable = [
    	'nama_menu',
    	'available_size',
    	'available_type',
    	'deskripsi', 
    	'gambar',
    	'redeem_point',
    	'deliverable',
    	'status'
    ];
    protected $guarded = [
    	'id_menu'
    ];

    public function relasiK(){
        return $this->hasMany('Kategori', 'menu');
    }

    public function relasiT(){
        return $this->hasMany('Tag', 'menu');
    }
	
}
