<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
  use WithFileUploads;

  public $open = false;
  public $post, $image, $identificador;

  protected $rules = [
    'post.title' => 'required',
    'post.content' => 'required',
  ];

  public function mount(Post $post)
  {
    $this->post = $post;
    $this->identificador = rand();
  }

  public function save()
  {
    $this->validate();

    // if the user selected an image
    if ($this->image) {
      Storage::delete('posts/' . $this->post->image);

      $imagePath = $this->image->store('posts');
      $imageName = basename($imagePath);
      $this->post->image = $imageName;
    }

    $this->post->save();

    $this->reset(['open', 'image']);
    $this->identificador = rand();

    $this->emit('render');
    $this->emit('alert', 'Post updated successfully');
  }

  public function render()
  {
    return view('livewire.edit-post');
  }
}
