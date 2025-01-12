<div class="p-6 bg-white border-b border-gray-200">

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            @if($user->id != auth()->user()->id)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $user->email }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">
                    <button wire:click="toggleChatBox({{ $user->id }})" class="text-blue-600 hover:text-blue-800">
                        Chat
                    </button>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    @if($isVisibleChatBox)
        @livewire('chat-box', ['conversationId' => $currentConversationId])
    @endif
</div>