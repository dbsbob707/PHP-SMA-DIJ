<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Page extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'password', 'expires_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'key', 'password',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];
}
