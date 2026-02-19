<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{
    protected $fillable = [
        'message_id',
        'filepath'];

    public function message()
    {
        return $this->belongsTo(TicketMessage::class,'message_id');
    }
}
