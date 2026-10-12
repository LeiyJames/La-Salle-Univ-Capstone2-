<div id="events-section" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <!-- Header & Tabs -->
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 pb-2 border-b border-gray-200">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-100 text-green-800 border border-green-200">
                    Student Activities Hub
                </span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Campus Events & Happenings</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1">Explore university assemblies, departmental activities, seminars, and sports meets</p>
        </div>

        <!-- Main Status Tabs -->
        <div class="flex items-center gap-2 p-1 bg-gray-100 rounded-2xl self-start md:self-auto">
            <button type="button"
                wire:click="setTab('upcoming')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $tab === 'upcoming' ? 'bg-white text-green-800 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                <span>Upcoming Events</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'upcoming' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">{{ $upcomingCount }}</span>
            </button>

            <button type="button"
                wire:click="setTab('archived')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $tab === 'archived' ? 'bg-white text-green-800 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                <span>Past Archive</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] {{ $tab === 'archived' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">{{ $archivedCount }}</span>
            </button>
        </div>
    </div>

    <!-- Search & Department Filter Chips -->
    <div class="space-y-4 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center justify-between">
            <!-- Search Field -->
            <div class="relative flex-1 max-w-md">
                <svg class="absolute top-3 left-3.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search event title, venue, or keywords..."
                    class="w-full pl-10 pr-4 py-2 bg-gray-50/70 border border-gray-200 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:bg-white focus:border-green-600 focus:ring-1 focus:ring-green-600 transition-all">
                @if ($search)
                <button type="button" wire:click="$set('search', '')" class="absolute right-3 top-2.5 text-xs text-gray-400 hover:text-gray-600">✕</button>
                @endif
            </div>

            <!-- Active Filter Status or Reset -->
            @if ($filter || $search)
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span>Filtering active</span>
                <button type="button" wire:click="resetFilters" class="text-xs text-red-600 font-semibold hover:underline flex items-center gap-1">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Clear all filters</span>
                </button>
            </div>
            @endif
        </div>

        <!-- Category / Tag Chips -->
        <div class="pt-2 border-t border-gray-100 flex items-center gap-2 overflow-x-auto pb-1 text-xs no-scrollbar">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider shrink-0 mr-1">Filter by Org:</span>
            
            <button type="button"
                wire:click="setFilter('')"
                class="px-3 py-1.5 rounded-xl font-bold transition-all whitespace-nowrap {{ empty($filter) ? 'bg-green-700 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                All Departments
            </button>

            @php
                $tags = [
                    'ccsea' => 'CCSEA',
                    'cba' => 'CBA',
                    'cte' => 'CTE',
                    'con' => 'CON',
                    'basic_education' => 'Basic Ed',
                    'higher_education' => 'Higher Ed',
                    'sports' => 'Sports',
                    'workshop' => 'Workshop',
                    'abo' => 'ABO',
                    'ibo' => 'IBO',
                ];
            @endphp

            @foreach ($tags as $tagKey => $tagLabel)
            <button type="button"
                wire:click="setFilter('{{ $tagKey }}')"
                class="px-3 py-1.5 rounded-xl font-medium transition-all whitespace-nowrap {{ $filter === $tagKey ? 'bg-green-700 text-white font-bold shadow-sm ring-2 ring-yellow-400/50' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $tagLabel }}
            </button>
            @endforeach
        </div>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse ($data as $event)
        @php
            $posterUrl = $event->getFirstMediaUrl('events') ?: asset('assets/img/Panaghugpong2023 1.png');
            $eventDate = $event->events_start_date ? \Carbon\Carbon::parse($event->events_start_date) : null;
            $isToday = $eventDate && $eventDate->isToday();
            $slug = str_replace(' ', '-', strtolower($event->events_name));
        @endphp
        <div class="group bg-white rounded-2xl sm:rounded-3xl border border-gray-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">
            <!-- Event Poster Header -->
            <div class="relative h-48 w-full bg-gray-100 overflow-hidden">
                <img src="{{ $posterUrl }}"
                     alt="{{ $event->events_name }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>

                <!-- Department Tag Badge -->
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-white/90 backdrop-blur-md text-green-900 shadow-sm">
                        {{ strtoupper($event->events_related_tags ?? 'Campus Event') }}
                    </span>
                </div>

                <!-- Date / Status Chip -->
                <div class="absolute top-3 right-3">
                    @if ($isToday)
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-red-600 text-white shadow-md animate-pulse">
                        <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                        Happening Today
                    </span>
                    @elseif ($eventDate)
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[10px] font-bold bg-black/60 backdrop-blur-md text-white border border-white/20">
                        {{ $eventDate->format('M d, Y') }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- Event Card Body -->
            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div class="space-y-2.5">
                    <!-- Date & Time Meta -->
                    @if ($eventDate)
                    <div class="flex items-center gap-3 text-[11px] text-gray-500 font-medium">
                        <div class="flex items-center gap-1.5 text-green-800 font-semibold">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <span>{{ $eventDate->format('D, M d, Y') }}</span>
                        </div>
                        @if ($event->events_start_time)
                        <span>•</span>
                        <div class="flex items-center gap-1 text-gray-500">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($event->events_start_time)->format('h:i A') }}</span>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Event Name -->
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-green-700 transition-colors line-clamp-2 leading-snug">
                        <a href="/event/{{ $event->events_id }}/{{ $slug }}" wire:navigate.hover>
                            {{ $event->events_name }}
                        </a>
                    </h3>

                    <!-- Location Pin -->
                    @if ($event->events_location)
                    <div class="flex items-center gap-1.5 text-xs text-gray-500">
                        <svg class="h-3.5 w-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="truncate">{{ $event->events_location }}</span>
                    </div>
                    @endif

                    <!-- Description preview -->
                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                        {{ $event->events_description }}
                    </p>
                </div>

                <!-- CTA Button -->
                <div class="pt-3 border-t border-gray-100">
                    <a href="/event/{{ $event->events_id }}/{{ $slug }}" wire:navigate.hover
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-gray-50 hover:bg-green-700 text-gray-700 hover:text-white px-4 py-2.5 text-xs font-bold transition-all duration-200 group-hover:border-transparent">
                        <span>View Event Details</span>
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-span-1 md:col-span-2 lg:col-span-3 py-16 text-center bg-white rounded-3xl border border-gray-200">
            <div class="max-w-sm mx-auto flex flex-col items-center">
                <div class="h-16 w-16 rounded-3xl bg-green-50 flex items-center justify-center text-green-700 mb-4">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-900">No events found</h3>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                    @if ($search || $filter)
                        No campus events matched your current search or department filter.
                    @else
                        No {{ $tab === 'upcoming' ? 'upcoming' : 'archived' }} events are currently listed on the portal.
                    @endif
                </p>
                @if ($search || $filter)
                <button type="button"
                    wire:click="resetFilters"
                    class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-green-700 px-4 py-2 text-xs font-bold text-white shadow-sm hover:bg-green-800 transition-all">
                    <span>Reset All Filters</span>
                </button>
                @endif
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($data->hasPages())
    <div class="pt-4 flex justify-center">
        {{ $data->links() }}
    </div>
    @endif
</div>
