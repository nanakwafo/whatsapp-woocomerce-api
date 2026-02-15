<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappConversation extends Model
{
    
     protected $fillable = [
        
        'phone_number',
        'last_inbound_at',
        'session_expires_at',
    ];
}
