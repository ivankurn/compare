<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'Users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'nama_user', 
        'email', 
        'password', 
        'alamat_user', 
        'kota_user', 
        'country_code_user', 
        'mobile_phone_user', 
        'tanggal_lahir', 
        'occupation', 
        'gender',
        'foto',
        'verifikasi_email',
        'is_admin',
        'created_at',
        'updated_at'
    ];
    protected $quarded = [
        'id_user'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

}
