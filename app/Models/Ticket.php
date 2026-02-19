<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'date',
        'user_id',
        'agent_id',

    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function agents()
    // {
    //     return $this->belongsTo(User::class, 'agent_id');
    // }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function agents()
    {
        return $this->belongsToMany(User::class, 'ticket_agents');
    }

}
