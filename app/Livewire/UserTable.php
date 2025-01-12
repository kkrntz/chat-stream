<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\Conversation;
use Illuminate\Support\Facades\Log;

class UserTable extends Component
{
    use WithPagination;
    public $isVisibleChatBox = false;
    public $currentConversationId;

    public function toggleChatBox($userId)
    {
        $conversation = Conversation::where([
            ['user1',$userId],
            ['user2',auth()->user()->id]
        ])->orWhere([
            'user2'=> $userId,
            'user1'=> auth()->user()->id
        ])-> first();
        Log::info('me:'.auth()->user()->id);
        Log::info('user id:'.$userId);
        if(!($conversation)) {
            $currentConversationId = Conversation::create([
                "user1"=>auth()->user()->id,
                "user2"=>$userId
            ])->id;
        } else {
            $currentConversationId = $conversation->id;
        }
        Log::info('conversation id:'.$currentConversationId);
        $this->isVisibleChatBox = true;
    }

    public function closeChatBox()
    {
        $this->isVisibleChatBox = false;
    }

    public function render()
    {
        // Fetch users with search functionality, paginated
        $users = User::query()
            ->paginate(5);

        return view('livewire.user-table', compact('users'));
    }
}