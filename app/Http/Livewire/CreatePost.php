<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
  use WithFileUploads;

  public $open = false;
  public $title, $content, $image, $identificador;

  public function mount()
  {
    $this->identificador = rand();
  }

  protected $rules = [
    'title' => 'required',
    'content' => 'required',
    'image' => 'required|image',
  ];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function save()
  {
    $this->validate();

    $imagePath = $this->image->store('posts');
    $imageName = basename($imagePath);

    Post::create([
      'title' => $this->title,
      'content' => $this->content,
      'image' => $imageName,
    ]);

    $this->reset(['open', 'title', 'content', 'image']);
    $this->identificador = rand();

    // render is the name of the event you want to emit
    $this->emit('render');
    $this->emit('alert', 'Post created successfully');
  }

  public function render()
  {
    return view('livewire.create-post');
  }
}
