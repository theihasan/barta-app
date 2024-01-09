<?php

namespace App\Livewire;

use App\Models\React;
use Livewire\Component;
use App\Events\PostLiked;

class Reaction extends Component
{
    public $postId;
    public $likesCount = 0;
    public $liked = false;
    public function mount($postId)
    {
        $this->postId = $postId;
        $this->updateLikesInfo();
    }
    public function like()
    {
        if (!$this->userHasLiked()) {
            React::create([
                'user_id' => auth()->id(),
                'post_id' => $this->postId,
            ]);
            event(new PostLiked(auth()->user(), $this->postId));
            $this->liked = true;
            $this->likesCount++;
        }

    }

    public function unlike()
{
    if ($this->userHasLiked()) {
        React::where('user_id', auth()->id())->where('post_id', $this->postId)->delete();
        $this->liked = false;
        $this->likesCount--;
    }
}

protected $listeners = [
    'postUnliked' => 'updateLikesInfo',
];

    public function updateLikesInfo()
    {
        $this->likesCount = React::where('post_id', $this->postId)->count();
        $this->liked = $this->userHasLiked();
    }
    private function userHasLiked()
    {
        return React::where('user_id', auth()->id())->where('post_id', $this->postId)->exists();
    }

    public function render()
    {
        return view('livewire.reaction');
    }
}
