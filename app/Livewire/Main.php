<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;

class Main extends Component
{
    public $searchUser = "";
    public $results = [];


    public function createConversation($receiverId)
    {
        //checking the conversation First if it exists or no
        $checkConversation = Conversation::where('receiver_id', auth()->user()->id)->where('sender_id', $receiverId)->orWhere('receiver_id', $receiverId)->where('sender_id', auth()->user()->id)->get();
        if(count($checkConversation)==0)
        {
            // dd('no convo');
            $createdConversation = Conversation::create(['receiver_id' => $receiverId , 'sender_id' => auth()->user()->id, 'last_message' => 'Click to start chat']);

            $createMessage = Message::create(['conversation_id'=> $createdConversation->id, 'sender_id' => auth()->user()->id, 'receiver_id'=> $receiverId]);

            $createdConversation->last_time_message = $createMessage->created_at;
            $createdConversation->save();
            $this->dispatch('refresh-chatlist');
        $this->reset();


        }
        
        elseif(count($checkConversation) >= 1)
        {
            dd('convo exists');   
        }
    }


    public function render()
    {
        if(strlen($this->searchUser) >= 1)
        {
            $this->results = User::where('name', 'like','%'. $this->searchUser. '%')->get();
        }
        return view('livewire.main', ['result' => $this->results]);
    }
}
