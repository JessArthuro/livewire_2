<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
  use WithFileUploads;
  use WithPagination;

  public $search, $post, $image, $identificador;
  public $sort = 'id';
  public $direction = 'desc';
  public $open_edit = false;

  public function mount()
  {
    $this->identificador = rand();
    $this->post = new Post();
  }

  public function updatingSearch()
  {
    $this->resetPage();
  }

  protected $rules = [
    'post.title' => 'required',
    'post.content' => 'required',
  ];

  // listen to the child event and execute the parent component's render function
  protected $listeners = ['render' => 'render'];

  public function render()
  {
    $posts = Post::where('title', 'like', '%' . $this->search . '%')
      ->orWhere('content', 'like', '%' . $this->search . '%')
      ->orderBy($this->sort, $this->direction)
      ->paginate(10);

    return view('livewire.show-posts', compact('posts'));
  }

  public function sort($sort)
  {
    if ($this->sort == $sort) {
      if ($this->direction == 'desc') {
        $this->direction = 'asc';
      } else {
        $this->direction = 'desc';
      }
    } else {
      $this->sort = $sort;
      $this->direction = 'asc';
    }
  }

  public function edit(Post $post)
  {
    $this->post = $post;
    $this->open_edit = true;
  }

  public function update()
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

    $this->reset(['open_edit', 'image']);
    $this->identificador = rand();

    $this->emit('alert', 'Post updated successfully');
  }
}
