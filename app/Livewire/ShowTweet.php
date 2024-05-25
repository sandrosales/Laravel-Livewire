<?php

namespace App\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweet extends Component
{
    use WithPagination;

    public $tweet;
    public $content;

    protected $rules = [
        'content' => 'required|min:5|max:255',
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->paginate(3);

        return view('livewire.show-tweet', compact('tweets'));
    }

    public function create()
    {
        $this->validate();

        Tweet::create([
            'content' => $this->content,
            'user_id' => 1, //auth()->user()->id
        ]);

        $this->content = '';
    }
}
