<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['user_id' ,'role'];
    protected $table ='user_role';

    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
