<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'colleague_email', 'messagecontent', 'key'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
