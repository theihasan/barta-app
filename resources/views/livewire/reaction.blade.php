<div>
    <div>
        <button wire:click="like" wire:loading.attr="disabled" wire:poll.500ms="updateLikesInfo" class="bg-blue-500 text-white px-4 py-2">
            {{ $liked ? 'Unlike' : 'Like' }}
        </button>
        
    
        <span class="ml-2">{{ $likesCount }} {{ Str::plural('like', $likesCount) }}</span>
    </div>
    
</div>
