<div class="space-y-3">
    <h3 class="font-semibold">Other Events & Activities</h3>
    <div class="flex items-center gap-1 -mx-9">
        @if ($data->onFirstPage())
        <x-icons.caret-left class="w-8 h-8 cursor-not-allowed" fill="#6b7280" />
        @else
        <x-icons.caret-left class="w-8 h-8 cursor-pointer" fill="#6b7280" wire:click="previousPage('{{ $data->getPageName() }}')" />
        @endif

        <div class="grid flex-1 grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4">
            @forelse ($data as $event)
            <div class="relative overflow-hidden border divide-y divide-gray-100 rounded-2xl">
                <div class="relative h-32">
                    <img src="{{ $event->getFirstMedia('events') ? asset($event->getFirstMedia('events')->getUrl()) : asset('assets/img/Content Placeholder.png') }}" class="absolute object-cover w-full h-32">
                </div>
                <div class="flex gap-3 p-3 mb-[59px]">
                    <div class="flex-1">
                        <h1 class="font-semibold">{{ $event->events_name }}</h1>
                        <p class="text-sm truncate">{{ $event->events_description }}</p>
                    </div>
                </div>
                <div class="absolute bottom-0 w-full p-3">
                    <a href="/event/{{ $event->events_id }}/{{ str_replace(' ', '-', strtolower($event->events_name)) }}">
                        <x-primary-button class="w-full rounded-2xl">
                            <span class="w-full text-center">Details</span>
                        </x-primary-button>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-4 p-8 rounded-2xl border-2 border-dashed border-gray-200 bg-white/70 text-center flex flex-col items-center justify-center space-y-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-xs">
                    <span>No Other Events</span>
                </span>
                <p class="text-xs text-gray-500">There are no additional activities scheduled at this time.</p>
            </div>
            @endforelse
        </div>

        @if ($data->hasMorePages())
        <x-icons.caret-right class="w-8 h-8 cursor-pointer" fill="#6b7280" wire:click="nextPage('{{ $data->getPageName() }}')" />
        @else
        <x-icons.caret-right class="w-8 h-8 cursor-not-allowed" fill="#6b7280" />
        @endif
    </div>

    @if ($data->hasPages())
    <div class="lg:hidden">
        {{ $data->links() }}
    </div>
    @endif
</div>
