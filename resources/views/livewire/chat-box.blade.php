<div class="fixed bottom-0 right-0 m-4 w-80 bg-white shadow-lg rounded-lg">

    <div class="grid grid-cols-4 chat-header bg-blue-500 text-white text-center py-2 rounded-t-lg">
        <h2 class="col-span-3 text-left indent-3 align-middle text-lg font-semibold">Test</h2>
        <button wire:click="closeChatBox" class="mt-2 bg-blue-500 text-white px-4 rounded-lg">X</button>
    </div>

    <div class="h-96 overflow-y-auto">
        @foreach ($messages as $message)
            <div class="mb-4 {{ $message->user_id == auth()->id() ? 'text-right' : 'text-left' }}">
                <p class="text-sm font-semibold">{{ $message->user->name }}</p>
                <p class="bg-gray-200 p-2 rounded-lg inline-block">{{ $message->message }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-4 flex gap-4">
        <input type="text" wire:model="message" class="w-full border px-4 rounded-lg" placeholder="Type your message...">
        <button wire:click="sendMessage" class="mt-2 bg-blue-500 text-white px-4 rounded-lg">Send</button>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        Echo.channel('chat.' + @this.fromUserId + @this.toUserId)
            .listen('MessageSent', (event) => {
                // Reload messages when a new message is received
                @this.loadMessages();
            });
    });
</script>