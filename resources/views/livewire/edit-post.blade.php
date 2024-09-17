<div>
  <button wire:click="$set('open', true)" class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></button>

  <x-jet-dialog-modal wire:model="open">
    <x-slot name="title">
      Edit Post
    </x-slot>

    <x-slot name="content">
      @if ($image)
      <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="" style="height: 12rem">
      @else
      <img class="mb-4" src="{{ asset('storage/posts/' . $post->image) }}" alt="" style="height: 12rem">
      @endif

      <div class="mb-4">
        <x-jet-label value="Title" />
        <x-jet-input type="text" class="w-full" wire:model="post.title" />
        <x-jet-input-error for="post.title" />
      </div>

      <div class="mb-4">
        <x-jet-label value="Content" />
        <x-jet-input type="text" class="w-full" wire:model="post.content" />
        <x-jet-input-error for="post.content" />
      </div>

      <div>
        <input wire:model="image" type="file" id="{{ $identificador }}">
        <x-jet-input-error for="image" />
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
        Cancel
      </x-jet-secondary-button>
      <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
        Update
      </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>
</div>