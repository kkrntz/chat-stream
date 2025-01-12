<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithPagination;
use App\Events\MessageSent;
use App\Models\Conversation;
use Illuminate\Support\Facades\Log;

class ChatBox extends Component
{
    use WithPagination;

    public $conversationId;
    public $message = '';
    public $messages = [];
    public $user;

    public function mount($conversationId)
    {
        // $this->conversation = Conversation::find($this->conversationId);
        $this->conversationId = $conversationId;
        $this->user = auth()->user();
        Log::info('currentConvId:'.$conversationId);
        $this->loadMessages();
    }

    public function sendMessage()
    {
        if (empty($this->message)) {
            return;
        }

        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'user_id' => $this->user->id,
            'message' => $this->message,
        ]);

        $this->message = '';
        $this->loadMessages();

        // Broadcast the message using Livewire's action or event
        // $this->emit('messageSent', $message);
        broadcast(new MessageSent($message));
    }

    public function loadMessages()
    {
        $conversation = Conversation::find($this->conversationId);
        $this->messages = $conversation->messages()->latest()->get();
        if(!$conversation) {
            $this->messages = array();
        } else {
            $this->messages = $conversation->messages()->latest()->get();
        }
    }

    public function render()
    {
        return view('livewire.chat-box');
    }
}
