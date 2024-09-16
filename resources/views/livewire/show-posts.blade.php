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
        @foreach ($posts as $post)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $post->id }}
          </th>
          <td class="px-6 py-4">
            {{ $post->title }}
          </td>
          <td class="px-6 py-4">
            {{ $post->content }}
          </td>
          <td class="px-6 py-4 text-right">
            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
</div>