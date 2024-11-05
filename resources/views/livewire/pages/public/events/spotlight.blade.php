<div>
    @isset($event)
    <div class="p-4 mx-auto space-y-10 max-w-7xl lg:px-8 my-14">
        <div class="grid grid-cols-3 gap-10">
            <div class="flex items-center col-span-3 md:col-span-2">
                <div class="space-y-3">
                    <h1 class="text-5xl font-bold">{{ $event->events_name }}</h1>
                    <p>{{ $event->events_properties['spotlight']['description'] }}</p>
                    <div>
                        <a href="/event/{{ $event->events_id }}/{{ str_replace(' ', '-', strtolower($event->events_name)) }}">
                            <x-primary-button class="rounded-2xl">
                                <span class="w-full text-center">More Info</span>
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block md:col-span-1">
                <div class="relative overflow-hidden h-96 rounded-2xl">
                    <img src="{{ $event->getFirstMedia('events') ? asset($event->getFirstMedia('events')->getUrl()) : asset('assets/img/Content Placeholder.png') }}" class="absolute object-cover w-full h-96">
                </div>
            </div>
        </div>
    </div>
    @endisset

    <div class="p-4 mx-auto space-y-10 max-w-7xl lg:px-8 my-14">
        <div class="flex flex-col items-center justify-between gap-3 md:flex-row">
            <nav class="flex space-x-4" aria-label="Tabs">
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'current']) wire:click="setTab('current')">Schedule of Activities</span>
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'academic_based']) wire:click="setTab('academic_based')">Academic-Based Organization</span>
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'interest_based']) wire:click="setTab('interest_based')">Interest-Based Organization</span>
            </nav>

            @if (in_array($tab, ['academic_based', 'interest_based']))
            <div class="flex items-center gap-3">
                <div class="relative flex items-center gap-3">
                    <div class="relative">
                        <x-icons.search class="absolute top-[10.5px] left-3 w-4 h-4" stroke="#6b7280" />
                        <x-text-input type="text" class="pl-8 rounded-2xl" wire:model.live="search" />
                    </div>
                    <div class="" x-data="{ open: false, toggle() { this.open = !this.open } }">
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
            </div>
            @endif
        </div>
        @if (in_array($tab, ['academic_based', 'interest_based']))
        <div class="space-y-10">
            <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($data as $value)
                <div class="relative overflow-hidden border divide-y divide-gray-100 rounded-2xl" x-data="{ more: false, toggleDetails() { this.more = !this.more } }">
                    <div class="relative h-40">
                        <img src="{{ $value->getFirstMedia('events') ? asset($value->getFirstMedia('events')->getUrl()) : asset('assets/img/Content Placeholder.png') }}" class="absolute object-cover w-full h-40">
                    </div>
                    <div class="flex gap-3 p-3 mb-[59px]">
                        <x-icons.calendar class="w-12 h-12" fill="#6b7280" />
                        <div class="flex-1">
                            <h1 class="font-semibold">{{ $event->events_name }}</h1>
                            <p x-show="!more" class="text-sm">
                                @if (strlen($event->events_description) >= 50)
                                <span>{{ substr($event->description, 0, 50) }}</span>
                                <span class="text-sm">
                                    <span>...</span>
                                    <span class="text-blue-700" x-on:click="toggleDetails">See More</span>
                                </span>
                                @else
                                <span>{{ $event->events_description }}</span>
                                @endif
                            <p x-show="more" class="text-sm" x-on:click="toggleDetails">{{ $event->events_description }}</p>
                        </div>
                    </div>
                    <div class="absolute bottom-0 w-full p-3">
                        <a href="/event/{{ $value->id }}/{{ str_replace(' ', '-', strtolower($value->events_name)) }}">
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
        @isset($activity)
        <div class="flex items-center justify-between">
            <nav class="flex space-x-4" aria-label="Tabs">
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $activity_tab == 'basic_education']) wire:click="setActivityTab('basic_education')">Basic Education</span>
                <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $activity_tab == 'higher_education']) wire:click="setActivityTab('higher_education')">Higher Education</span>
            </nav>
        </div>
        <div class="overflow-hidden border rounded-2xl">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th scope="col" class="uppercase py-3.5 text-center text-sm font-semibold text-gray-100 bg-green-700">Date/Time</th>
                        <th scope="col" class="uppercase py-3.5 text-center text-sm font-semibold text-gray-100 bg-green-700">Activity Name</th>
                        <th scope="col" class="uppercase py-3.5 text-center text-sm font-semibold text-gray-100 bg-green-700">Location</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @php $count = 1; @endphp

                    @forelse ($activity[$activity_tab] ?? [] as $activity_date => $items)
                    <tr>
                        <td class="py-4 text-sm font-medium text-center text-gray-100 bg-green-500 whitespace-nowrap">{{ date('m/d/Y', strtotime($activity_date)) }} | Day {{ $count }}</td>
                        <td class="py-4 text-sm font-medium text-center text-gray-100 bg-green-500 whitespace-nowrap" colspan="2"></td>
                    </tr>
                    @foreach (collect($items)->sortBy('date') as $value)
                    <tr>
                        <td class="py-4 text-sm font-medium text-center text-gray-500 whitespace-nowrap">{{ date('m/d/Y H:i:s', strtotime($value['date'])) }}</td>
                        <td class="py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ $value['name'] }}</td>
                        <td class="py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ $value['location'] }}</td>
                    </tr>
                    @endforeach

                    @php $count++; @endphp
                    @empty
                    <tr>
                        <td class="py-4 text-sm text-center text-gray-500 whitespace-nowrap" colspan="3">
                            <span>No data available</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @else
        <div class="mt-5">
            <span class="text-gray-500">No data available.</span>
        </div>
        @endisset
        @endif
    </div>
</div>
