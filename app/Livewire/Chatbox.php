<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;


class Chatbox extends Component
{
    public $selectedConversation;
    public $receiverInstance;
    public $senderInstance;
    public $messageCount;
    public $messages;
    public $paginate = 10;


    public function getListeners()
    {
        $auth_id = auth()->user()->id;
            return [
            "echo-private:chat.{$auth_id},MessageSent"=>"broadcastedMessageReceived",
        ];
    }


    public function broadcastedMessageReceived($event)
    {
      if($this->selectedConversation)
    {
        $broadcastedMessage = Message::find($event['message_id']);
        if($this->selectedConversation->id == $event['conversation_id'])
        {
            $this->messages->push($broadcastedMessage);
            $broadcastedMessage->read = 1;
            $broadcastedMessage->save();
        }
    }
    }

    #[On('loadConversation')]
    public function loadConversation(Conversation $conversation, User $receiverId, User $senderId)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiverId;
        $this->senderInstance = $senderId;
        $this->messageCount = Message::where('conversation_id',$this->selectedConversation->id)->count();
        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
        ->skip($this->messageCount - $this->paginate)
        ->take($this->paginate)->get();
    }

    #[On('refresh-me')]
    public function refresh()
    {
        $this->loadConversation($this->selectedConversation, $this->receiverInstance, $this->senderInstance);
    }

    public function render()
    {

    return view('livewire.chatbox', [
        'receiverInstance' => $this->receiverInstance,
        'senderInstance' => $this->senderInstance,
        'messages' => $this->messages,
    ]);
    }
}
