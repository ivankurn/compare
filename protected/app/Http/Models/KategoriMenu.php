<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    protected $table = 'KategoriMenu';
    protected $fillable = [
    	'id_menu', 
    	'id_kategori'
    ];

    public $timestamps = false;
}
