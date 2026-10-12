<div>
    <div class="space-y-6">
        <!-- 1. Header & Quick Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="/admin" wire:navigate.hover class="hover:text-green-700 transition-colors">Home</a>
                    <span>/</span>
                    <span class="text-green-700 font-semibold">Events Management</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Events</h1>
                <p class="text-xs text-gray-500 mt-0.5">Manage schedules, active statuses, spotlight features, and event posters</p>
            </div>

            <!-- Header Action Buttons -->
            @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="/admin/event/spotlight" wire:navigate.hover
                    class="inline-flex items-center gap-2 rounded-xl bg-amber-50 px-4 py-2.5 text-xs font-bold text-amber-800 border border-amber-200/80 hover:bg-amber-100 transition-all shadow-xs">
                    <svg class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                    <span>Spotlight Manager</span>
                </a>

                <a href="/admin/event/create" wire:navigate.hover
                    class="inline-flex items-center gap-2 rounded-xl bg-green-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-green-800 transition-all transform active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Create Event</span>
                </a>
            </div>
            @endif
        </div>

        <!-- 2. Main Card Container -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <!-- Status Filter Tabs -->
            <div class="border-b border-gray-100 bg-gray-50/60 px-6 pt-3">
                <nav class="flex space-x-2 sm:space-x-4 overflow-x-auto" aria-label="Tabs">
                    <button type="button"
                        wire:click="setTab('all')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'all' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>All Events</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'all' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['all'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('upcoming')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'upcoming' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Upcoming</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'upcoming' ? 'bg-blue-100 text-blue-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['upcoming'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('ongoing')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'ongoing' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Happening Now</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'ongoing' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['ongoing'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('past')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'past' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Concluded</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'past' ? 'bg-gray-200 text-gray-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['past'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('draft')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'draft' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Drafts / Inactive</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'draft' ? 'bg-amber-100 text-amber-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['draft'] }}</span>
                    </button>
                </nav>
            </div>

            <!-- Search & Filters Toolbar -->
            <div class="p-5 border-b border-gray-100 bg-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search by event title, location, description..."
                            class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all placeholder:text-gray-400" />
                        @if ($search)
                        <button type="button" wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            &times;
                        </button>
                        @endif
                    </div>

                    <!-- Organization & Presets Dropdown -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <select wire:model.live="organization" class="py-2 pl-3 pr-8 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700">
                            <option value="">All Organizations / Colleges</option>
                            @foreach ($organizations as $org)
                            <option value="{{ $org }}">{{ $org }}</option>
                            @endforeach
                        </select>

                        @if ($search || $organization || $tab !== 'all')
                        <button type="button"
                            wire:click="resetFilters"
                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>Reset Filters</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 3. Event Records Table -->
            @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/75 text-xs uppercase tracking-wider text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3.5 font-semibold">Poster</th>
                            <th class="px-6 py-3.5 font-semibold cursor-pointer hover:text-gray-900" wire:click="sortBy('events_name')">
                                <div class="flex items-center gap-1.5">
                                    <span>Event Details</span>
                                    @if ($sortField === 'events_name')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-6 py-3.5 font-semibold cursor-pointer hover:text-gray-900" wire:click="sortBy('events_start_date')">
                                <div class="flex items-center gap-1.5">
                                    <span>Schedule & Timeline</span>
                                    @if ($sortField === 'events_start_date')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-6 py-3.5 font-semibold">Venue / Location</th>
                            <th class="px-6 py-3.5 font-semibold text-center">Status</th>
                            <th class="px-6 py-3.5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($data as $event)
                        @php
                            $start = \Carbon\Carbon::parse($event->events_start_date);
                            $end = \Carbon\Carbon::parse($event->events_end_date);
                            $today = \Carbon\Carbon::today();
                            $diffDays = $today->diffInDays($start, false);
                            $isOngoing = $today->gte($start) && $today->lte($end);
                            $isPast = $today->gt($end);
                            $isSpotlight = !empty($event->events_properties['spotlight'] ?? null);
                            $mediaUrl = $event->getFirstMediaUrl('events');
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <!-- Poster Thumbnail Column -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($mediaUrl)
                                    <img src="{{ $mediaUrl }}" class="w-12 h-12 rounded-xl object-cover border border-gray-200 shadow-2xs" alt="{{ $event->events_name }}" />
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200/60 flex items-center justify-center text-green-700">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>

                            <!-- Event Details -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/event/edit/{{ $event->events_id }}" wire:navigate.hover class="font-bold text-gray-900 hover:text-green-700 transition-colors">
                                        {{ $event->events_name }}
                                    </a>
                                    @if ($isSpotlight)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800" title="Featured on Homepage Spotlight">
                                        ★ Spotlight
                                    </span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-gray-100 text-gray-600">
                                        {{ $event->events_organization_type ?? 'Campus Wide' }}
                                    </span>
                                    @if ($event->events_workshop_registration)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700">
                                        Registration Open
                                    </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Schedule & Countdown -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs font-semibold text-gray-800">
                                    {{ $start->format('M d, Y') }}
                                    @if ($event->events_end_date && $event->events_end_date !== $event->events_start_date)
                                        <span class="text-gray-400 font-normal">&rarr;</span> {{ $end->format('M d, Y') }}
                                    @endif
                                </div>
                                <div class="mt-1">
                                    @if ($isOngoing)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                            Happening Now
                                        </span>
                                    @elseif ($isPast)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-600">
                                            Concluded
                                        </span>
                                    @elseif ($diffDays === 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-800">
                                            Starts Today
                                        </span>
                                    @elseif ($diffDays === 1)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                            Tomorrow
                                        </span>
                                    @elseif ($diffDays > 1 && $diffDays <= 7)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            In {{ $diffDays }} days
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-purple-50 text-purple-700">
                                            In {{ $diffDays }} days
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Venue / Location -->
                            <td class="px-6 py-4 text-xs text-gray-600 max-w-xs truncate">
                                {{ $event->events_location ?? 'La Salle University' }}
                            </td>

                            <!-- Status Toggle Column -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button type="button"
                                    wire:click="toggleStatus({{ $event->events_id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition-all {{ $event->events_status ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                                    title="Click to toggle between Active and Draft">
                                    <span>{{ $event->events_status ? 'Active' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- Actions Column -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- Edit -->
                                    <a href="/admin/event/edit/{{ $event->events_id }}" wire:navigate.hover
                                        class="p-2 rounded-xl text-gray-600 hover:text-green-700 hover:bg-green-50 transition-colors" title="Edit Event">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <!-- Public View -->
                                    <a href="/event/{{ $event->events_id }}/{{ str_replace(' ', '-', strtolower($event->events_name)) }}" target="_blank"
                                        class="p-2 rounded-xl text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition-colors" title="View Student Portal Page">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>

                                    <!-- Delete -->
                                    <button type="button"
                                        wire:click="delete({{ $event->events_id }})"
                                        class="p-2 rounded-xl text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors" title="Delete Event">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-12 text-center text-gray-500" colspan="6">
                                <div class="max-w-xs mx-auto">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 mx-auto">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-3 text-sm font-bold text-gray-900">No events matched</h3>
                                    <p class="mt-1 text-xs text-gray-500">Try adjusting your search terms, status tabs, or college filter.</p>
                                    @if ($search || $organization || $tab !== 'all')
                                    <button type="button" wire:click="resetFilters" class="mt-4 px-3 py-1.5 text-xs font-semibold rounded-lg bg-green-50 text-green-700 hover:bg-green-100 transition-colors">
                                        Clear all filters
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if ($data->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $data->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal Component -->
    @livewire('pages.admin.event.modal.delete', ['modal' => 'delete_event_modal'])
</div>
