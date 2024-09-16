<div>
  <x-jet-danger-button wire:click="$set('open', true)">
    Create new post
  </x-jet-danger-button>

  <x-jet-dialog-modal wire:model="open">
    <x-slot name="title">
      Create new post
    </x-slot>

    <x-slot name="content">
      @if ($image)
      <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="" style="height: 12rem">
      @endif

      <div class="mb-4">
        <x-jet-label value="Title" />
        <x-jet-input type="text" class="w-full" wire:model="title" />
        <x-jet-input-error for="title" />
      </div>

      <div class="mb-4">
        <x-jet-label value="Content" />
        <x-jet-input type="text" class="w-full" wire:model="content" />
        <x-jet-input-error for="content" />
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
      <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
        Create
      </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>
</div>