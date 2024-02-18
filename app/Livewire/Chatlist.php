<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;

class Chatlist extends Component
{
    public $conversations;
    public $selectedConversation;
    public $receiverInstance;
    public $senderInstance;

    // protected $listener = ['refresh-bra' => 'render'];

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
            return [
            "echo-private:chat.{$auth_id},MessageSent"=>"broadcastedMessageReceived",
        ];
    }

    public function broadcastedMessageReceived($event)
    {
      $this->dispatch('refreshChatListForReceiver')->self();
    }

  public function chatUserSelected(Conversation $conversation, $receiverId, $senderId)
    {
    //problem is here that changing the chat alignement or maybe with DESC
      $this->selectedConversation = $conversation;
      $this->receiverInstance = User::find($receiverId);
      $this->senderInstance = User::find($senderId);

      $this->dispatch('loadConversation', $this->selectedConversation, $this->receiverInstance, $this->senderInstance)->to(Chatbox::class);
      $this->dispatch('sendMessageEvent', $this->selectedConversation, $this->receiverInstance, $this->senderInstance)->to(Sendmessage::class);
    }
    
      
    public function mount()
    {
      $this->conversations = Conversation::with(['senderInverseRelation','receiverInverseRelation'])->where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->orderBy('last_time_message', 'DESC')->get();
      // dd($this->conversations);
    }

    #[On('refreshChatListForReceiver')]      
    #[On('refresh-chatlist')]   
    public function render()
    {
      $this->conversations = Conversation::with(['senderInverseRelation','receiverInverseRelation'])->where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->orderBy('last_time_message', 'DESC')->get();
    
      return view('livewire.chatlist',[
          'conversations', $this->conversations,
        ]);
    }
}
