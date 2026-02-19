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
        'status'

    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'ticket_users');
    }

    public function user()
    {
        return $this->belongsTo(TicketUser::class, 'ticket_id');
    }

    public function agents()
    {
        return $this->belongsToMany(User::class, 'ticket_agents');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
