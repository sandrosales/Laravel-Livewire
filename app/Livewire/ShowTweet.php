<?php

namespace App\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class ShowTweet extends Component
{
    public $tweet;
    public $message = 'Teste de mensagem 2';

    public function render()
    {
        $tweets = Tweet::with('user')->get();

        return view('livewire.show-tweet', compact('tweets'));
    }
}
