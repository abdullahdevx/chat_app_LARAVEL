<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function conversationInverseRelation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function userInverseRelation()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }



}
