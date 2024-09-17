<div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="px-6 py-3 bg-white flex items-center gap-4 flex-wrap">
      <x-jet-input wire:model="search" class="flex-1" type="text" placeholder="Buscar por titulo o contenido..." />
      @livewire('create-post')
    </div>

    @if ($posts->count())
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th wire:click="sort('id')" scope="col" class="cursor-pointer px-6 py-3" style="width: 7%;">
            <div class="flex justify-between items-center">
              <span>ID</span>
              {{-- Sort --}}
              @if ($sort == 'id')
              @if ($direction == 'asc')
              <i class="fa-solid fa-sort-up"></i>
              @else
              <i class="fa-solid fa-sort-down"></i>
              @endif
              @else
              <i class="fa-solid fa-sort"></i>
              @endif
            </div>
          </th>
          <th wire:click="sort('title')" scope="col" class="cursor-pointer px-6 py-3">
            <div class="flex justify-between items-center">
              <span>Title</span>
              {{-- Sort --}}
              @if ($sort == 'title')
              @if ($direction == 'asc')
              <i class="fa-solid fa-sort-up"></i>
              @else
              <i class="fa-solid fa-sort-down"></i>
              @endif
              @else
              <i class="fa-solid fa-sort"></i>
              @endif
            </div>
          </th>
          <th wire:click="sort('content')" scope="col" class="cursor-pointer px-6 py-3">
            <div class="flex justify-between items-center">
              <span>Content</span>
              {{-- Sort --}}
              @if ($sort == 'content')
              @if ($direction == 'asc')
              <i class="fa-solid fa-sort-up"></i>
              @else
              <i class="fa-solid fa-sort-down"></i>
              @endif
              @else
              <i class="fa-solid fa-sort"></i>
              @endif
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            <span class="sr-only">Options</span>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $item)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $item->id }}
          </th>
          <td class="px-6 py-4">
            {{ $item->title }}
          </td>
          <td class="px-6 py-4">
            {{ $item->content }}
          </td>
          <td class="px-6 py-4">
            {{-- @livewire('edit-post', ['post' => $post, key($post->id)]) --}}
            <button wire:click="edit({{ $item }})" class="btn btn-green"><i class="fa-solid fa-pen-to-square"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="px-6 py-3">
      No existe ningún registro coincidente...
    </div>
    @endif
  </div>

  <x-jet-dialog-modal wire:model="open_edit">
    <x-slot name="title">
      Edit Post {{ $post->id }}
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
      <x-jet-secondary-button class="mr-2" wire:click="$set('open_edit', false)">
        Cancel
      </x-jet-secondary-button>
      <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
        Update
      </x-jet-danger-button>
    </x-slot>
  </x-jet-dialog-modal>
</div>