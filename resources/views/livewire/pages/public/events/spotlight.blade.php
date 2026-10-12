<div>
    @livewire('component.public.carousel', ['height' => '500'])
    @livewire('layout.public.sub-navigation')

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

    <div class="p-4 mx-auto space-y-8 max-w-7xl lg:px-8 my-10 sm:my-14">
        <!-- Main Navigation Tabs -->
        <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center border-b border-gray-200 pb-3">
            <nav class="flex space-x-4 sm:space-x-8 overflow-x-auto w-full md:w-auto" aria-label="Tabs">
                <button type="button" @class([
                    'pb-3 text-sm sm:text-base font-bold transition-all border-b-2 whitespace-nowrap',
                    'border-green-700 text-green-800' => $tab == 'current',
                    'border-transparent text-gray-500 hover:text-gray-800 hover:border-gray-300' => $tab != 'current'
                ]) wire:click="setTab('current')">
                    Schedule of Activities
                </button>
                <button type="button" @class([
                    'pb-3 text-sm sm:text-base font-bold transition-all border-b-2 whitespace-nowrap',
                    'border-green-700 text-green-800' => $tab == 'academic_based',
                    'border-transparent text-gray-500 hover:text-gray-800 hover:border-gray-300' => $tab != 'academic_based'
                ]) wire:click="setTab('academic_based')">
                    Academic-Based Organization
                </button>
                <button type="button" @class([
                    'pb-3 text-sm sm:text-base font-bold transition-all border-b-2 whitespace-nowrap',
                    'border-green-700 text-green-800' => $tab == 'interest_based',
                    'border-transparent text-gray-500 hover:text-gray-800 hover:border-gray-300' => $tab != 'interest_based'
                ]) wire:click="setTab('interest_based')">
                    Interest-Based Organization
                </button>
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
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <div class="p-8 rounded-2xl border-2 border-dashed border-gray-200 bg-white/70 text-center flex flex-col items-center justify-center space-y-3.5">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100/80 border border-emerald-200/60 flex items-center justify-center text-green-700">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-3.75h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-gray-800">No Spotlight Activities Scheduled</h4>
                            <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
                                There are no spotlight activities or events scheduled at this time. Check back soon!
                            </p>
                        </div>
                    </div>
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
        <div class="space-y-6">
            <!-- Level Toggle Pills -->
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Level:</span>
                <button type="button" @class([
                    'px-4 py-1.5 rounded-full text-xs font-bold transition-all',
                    'bg-green-700 text-white shadow-xs' => $activity_tab == 'basic_education',
                    'bg-gray-100 text-gray-600 hover:bg-gray-200' => $activity_tab != 'basic_education'
                ]) wire:click="setActivityTab('basic_education')">
                    Basic Education
                </button>
                <button type="button" @class([
                    'px-4 py-1.5 rounded-full text-xs font-bold transition-all',
                    'bg-green-700 text-white shadow-xs' => $activity_tab == 'higher_education',
                    'bg-gray-100 text-gray-600 hover:bg-gray-200' => $activity_tab != 'higher_education'
                ]) wire:click="setActivityTab('higher_education')">
                    Higher Education
                </button>
            </div>

            <!-- Activities Table Card -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-2xl shadow-sm">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-green-800 to-green-900 text-white">
                            <th scope="col" class="uppercase py-4 px-6 text-center text-xs font-bold tracking-wider">Date / Time</th>
                            <th scope="col" class="uppercase py-4 px-6 text-center text-xs font-bold tracking-wider">Activity Name</th>
                            <th scope="col" class="uppercase py-4 px-6 text-center text-xs font-bold tracking-wider">Location</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
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
                        <td class="py-20 sm:py-28 px-4 text-center text-gray-500" colspan="3">
                            <div class="max-w-md mx-auto flex flex-col items-center justify-center space-y-4">
                                <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100/80 border border-emerald-200/60 flex items-center justify-center text-green-700 shadow-xs">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-3.75h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-base sm:text-lg font-bold text-gray-800">No Spotlight Activities Scheduled</h4>
                                    <p class="text-xs sm:text-sm text-gray-500 leading-relaxed">
                                        There are no spotlight activities or events scheduled at this time. Check back soon!
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
        @else
        <div class="mt-5 p-8 rounded-2xl border-2 border-dashed border-gray-200 bg-white/70 text-center flex flex-col items-center justify-center space-y-3.5">
            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100/80 border border-emerald-200/60 flex items-center justify-center text-green-700">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-3.75h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
            </div>
            <div class="space-y-1">
                <h4 class="text-sm font-bold text-gray-800">No Spotlight Activities Scheduled</h4>
                <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
                    There are no spotlight activities or events scheduled at this time. Check back soon!
                </p>
            </div>
        </div>
        @endisset
        @endif
    </div>
</div>
