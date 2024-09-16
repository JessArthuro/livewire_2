<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
  public $open = false;
  public $title, $content;

  public function save() {
    Post::create([
      'title' => $this->title,
      'content' => $this->content
    ]);

    $this->reset(['open', 'title', 'content']);

    // render is the name of the event you want to emit
    $this->emit('render');
    $this->emit('alert', 'Post created successfully');
  }

  public function render()
  {
    return view('livewire.create-post');
  }
}
