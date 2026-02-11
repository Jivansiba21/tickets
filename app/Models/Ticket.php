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
];


    public function users(){
        return $this->belongsToMany(User::class, 'ticket_users');
    }

    public function agents(){
        return $this->belongsToMany(User::class, 'ticket_agents');
    }

}
