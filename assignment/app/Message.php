<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'colleague_email', 'messagecontent', 'key', 'expires_at'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];
}
