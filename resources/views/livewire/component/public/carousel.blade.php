<div class="relative flex items-center gap-1">
    @if ($data->onFirstPage())
    <x-icons.caret-left class="w-8 h-8 cursor-not-allowed" fill="#6b7280" />
    @else
    <x-icons.caret-left class="w-8 h-8 cursor-pointer" fill="#6b7280" wire:click="previousPage('{{ $data->getPageName() }}')" />
    @endif

    <div class="relative h-[{{ $height }}px] bg-gray-300 flex-1">
        @forelse ($data as $gallery)
        <img src="{{ $gallery->getFirstMedia('gallery') ? asset($gallery->getFirstMedia('gallery')->getUrl()) : asset('assets/img/Content Placeholder.png') }}" class="absolute w-full h-[{{ $height }}px] object-cover">
        @empty
        <img src="{{ asset('assets/img/Panaghugpong2023 1.png') }}" class="absolute w-full h-[{{ $height }}px] object-cover">
        @endforelse
    </div>

    @if ($data->hasMorePages())
    <x-icons.caret-right class="w-8 h-8 cursor-pointer" fill="#6b7280" wire:click="nextPage('{{ $data->getPageName() }}')" />
    @else
    <x-icons.caret-right class="w-8 h-8 cursor-not-allowed" fill="#6b7280" />
    @endif
</div>