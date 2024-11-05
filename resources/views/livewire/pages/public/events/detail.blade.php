<div>
    @livewire('component.public.carousel' , ['height' => '500'])
    @livewire('layout.public.sub-navigation')

    <div class="p-4 mx-auto space-y-10 max-w-7xl lg:px-8 my-14">
        <div class="flex items-center justify-between">
            <nav class="flex space-x-4" aria-label="Tabs">
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'current']) wire:click="setTab('current')">Events & Activities</span>
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'upcoming']) wire:click="setTab('upcoming')">Upcoming Events</span>
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'archived']) wire:click="setTab('archived')">Archived Events</span>
            </nav>
            @if (in_array($tab, ['upcoming', 'archived']))
            <div class="relative flex items-center gap-3">
                <div class="relative">
                    <x-icons.search class="absolute top-[10.5px] left-3 w-4 h-4" stroke="#6b7280" />
                    <x-text-input type="text" class="pl-8 rounded-2xl" wire:model.live="search" />
                </div>
                <div x-data="{ open: false, toggle() { this.open = !this.open } }">
                    <x-icons.filter class="w-8 h-8 cursor-pointer" stroke="#6b7280" x-on:click="toggle" />
                    <div class="absolute left-0 z-50 w-full p-3 overflow-y-auto bg-white border rounded-md top-12 max-h-56" x-show="open">
                        <div class="flex flex-col gap-3">
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="ccsea" name="filter" class="cursor-pointer" value="ccsea" wire:model.live="filter" />
                                <label for="ccsea" class="text-bg-darkblue">CCSEA</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="cte" name="filter" class="cursor-pointer" value="cte" wire:model.live="filter" />
                                <label for="cte" class="text-bg-darkblue">CTE</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="con" name="filter" class="cursor-pointer" value="con" wire:model.live="filter" />
                                <label for="con" class="text-bg-darkblue">CON</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="cba" name="filter" class="cursor-pointer" value="cba" wire:model.live="filter" />
                                <label for="cba" class="text-bg-darkblue">CBA</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="basic_education" name="filter" class="cursor-pointer" value="basic_education" wire:model.live="filter" />
                                <label for="basic_education" class="text-bg-darkblue">Basic Education</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="higher_education" name="filter" class="cursor-pointer" value="higher_education" wire:model.live="filter" />
                                <label for="higher_education" class="text-bg-darkblue">Higher Education</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="workshop" name="filter" class="cursor-pointer" value="workshop" wire:model.live="filter" />
                                <label for="workshop" class="text-bg-darkblue">Workshop</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="sports" name="filter" class="cursor-pointer" value="sports" wire:model.live="filter" />
                                <label for="sports" class="text-bg-darkblue">Sports</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="abo" name="filter" class="cursor-pointer" value="abo" wire:model.live="filter" />
                                <label for="abo" class="text-bg-darkblue">ABO</label>
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <input type="radio" id="ibo" name="filter" class="cursor-pointer" value="ibo" wire:model.live="filter" />
                                <label for="ibo" class="text-bg-darkblue">IBO</label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        @if (in_array($tab, ['upcoming', 'archived']))
        <div>
            <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($data as $value)
                <div class="relative overflow-hidden border divide-y divide-gray-100 rounded-2xl">
                    <div class="relative h-40">
                        <img src="{{ $value->getFirstMedia('events') ? asset($value->getFirstMedia('events')->getUrl()) : asset('assets/img/Content Placeholder.png') }}" class="absolute object-cover w-full h-40">
                    </div>
                    <div class="flex gap-3 p-3 mb-[59px]">
                        <x-icons.calendar class="w-12 h-12" fill="#6b7280" />
                        <div class="flex-1">
                            <h1 class="font-semibold">{{ $value->name }}</h1>
                            <p class="text-sm">{{ $value->description }}</p>
                        </div>
                    </div>
                    <div class="absolute bottom-0 w-full p-3">
                        <a href="/event/{{ $value->id }}/{{ str_replace(' ', '-', strtolower($value->name)) }}">
                            <x-primary-button class="w-full rounded-2xl">
                                <span class="w-full text-center">Details</span>
                            </x-primary-button>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-1 text-center md:col-span-2 lg:col-span-3">
                    <span class="text-gray-500">No data available.</span>
                </div>
                @endforelse
            </div>

            @if ($data->hasPages())
            <div>
                {{ $data->links() }}
            </div>
            @endif
        </div>
        @else
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
            <div class="space-y-10 lg:col-span-2">
                <div class="space-y-3">
                    <div class="relative h-[500px] rounded-2xl overflow-hidden">
                        <img src="{{ $event->getFirstMedia('events') ? asset($event->getFirstMedia('events')->getUrl()) : asset('assets/img/Content Placeholder.png') }}" class="absolute w-full h-[500px] object-cover">
                    </div>
                    <h1 class="text-xl font-semibold">{{ $event->events_name }}</h1>
                    <ul class="flex gap-2">
                        <li class="bg-gray-100 rounded-2xl px-3 py-0.5">{{ $event->events_start_date }}</li>
                        <li class="bg-gray-100 rounded-2xl px-3 py-0.5">{{ $event->events_location }}</li>
                    </ul>
                    <p class="text-justify">{{ $event->events_description }}</p>

                    @if (explode(', ', $event->events_related_tags))
                    <ul class="flex gap-2">
                        @foreach (explode(', ', $event->events_related_tags) as $related_tag)
                        <li class="bg-gray-100 rounded-2xl px-3 py-0.5">{{ $related_tag }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <div>
                        @if ($event->events_workshop_registration)
                        <a href="{{ $event->events_registration_link }}" target="_blank">
                            <x-primary-button class="w-full md:w-auto">
                                <span class="w-full text-center">Register</span>
                            </x-primary-button>
                        </a>
                        @endif
                    </div>
                </div>

                @livewire('component.public.events-carousel', ['paginate' => 4, 'exept' => $event->events_id])
            </div>
            <div class="space-y-3">
                <div class="space-y-3">
                    <h3 class="font-semibold">Calendar</h3>
                    <div class="p-5 border rounded-2xl">
                        @livewire('component.public.calendar')
                    </div>
                </div>

                @livewire('component.public.upcoming-events', ['take' => 2, 'exept' => $event->events_id])
            </div>
        </div>
        @endif
    </div>
</div>
