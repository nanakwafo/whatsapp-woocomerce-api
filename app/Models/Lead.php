<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    protected $fillable = [
        'email',
        'store_url',
        'allow_marketing',
    ];

}
