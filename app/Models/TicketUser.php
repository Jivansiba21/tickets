<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    protected $table = 'ticket_users';

    protected $fillable = [
        'user_id',
        'ticket_id',
    ];
}
