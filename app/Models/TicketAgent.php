<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAgent extends Model
{
    protected $table = 'ticket_agents';

    protected $fillable = [
        'user_id',
        'ticket_id',
    ]; 
}
