<div class="space-y-8 pb-10">
    <!-- 1. Hero Welcome & Quick Actions Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-800 via-green-700 to-emerald-800 p-6 sm:p-8 text-white shadow-lg">
        <!-- Background decorative ambient circles -->
        <div class="absolute -right-12 -top-12 h-64 w-64 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
        <div class="absolute -left-12 -bottom-12 h-48 w-48 rounded-full bg-emerald-500/10 blur-xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-xs font-semibold backdrop-blur-sm border border-white/20">
                    La Salle University · Events Admin Portal
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Welcome back, {{ auth()->user()->users_given_name ?? 'Administrator' }}! 👋
                </h1>
                <p class="text-green-100/90 text-sm max-w-xl">
                    Today is <span class="font-semibold text-white">{{ now()->format('l, F j, Y') }}</span>. Here is your campus events summary, upcoming schedules, and management dashboard.
                </p>
            </div>

            <!-- Header Quick Action Buttons -->
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="/admin/event/create"
                    wire:navigate.hover
                    class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-green-800 shadow-md hover:bg-green-50 hover:shadow-lg transition-all transform active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>New Event</span>
                </a>

                <a href="/admin/event/spotlight"
                    wire:navigate.hover
                    class="inline-flex items-center gap-2 rounded-xl bg-green-900/60 px-4 py-2.5 text-sm font-semibold text-white border border-white/20 hover:bg-green-900/90 transition-all">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                    <span>Spotlight</span>
                </a>

                <a href="/"
                    target="_blank"
                    class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2.5 text-sm font-semibold text-white border border-white/20 hover:bg-white/20 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>View Public Site</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. KPI Metrics Grid (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Events -->
        <a href="/admin/event" wire:navigate.hover class="group bg-white rounded-2xl p-5 border border-gray-200/80 shadow-sm hover:shadow-md hover:border-green-300 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Events</span>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-gray-900">{{ $totalEvents }}</div>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">
                    <span>{{ $activeEvents }} published & active</span>
                </div>
            </div>
        </a>

        <!-- Upcoming This Month -->
        <a href="/admin/event" wire:navigate.hover class="group bg-white rounded-2xl p-5 border border-gray-200/80 shadow-sm hover:shadow-md hover:border-blue-300 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">This Month</span>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-gray-900">{{ $upcomingThisMonth }}</div>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">
                    <span class="font-medium text-blue-600">{{ now()->format('F Y') }}</span>
                    <span>schedule</span>
                </div>
            </div>
        </a>

        <!-- Spotlight Highlights -->
        <a href="/admin/event/spotlight" wire:navigate.hover class="group bg-white rounded-2xl p-5 border border-gray-200/80 shadow-sm hover:shadow-md hover:border-amber-300 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Spotlight Events</span>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-gray-900">{{ $spotlightCount }}</div>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">
                    <span class="font-medium text-amber-600">Featured</span>
                    <span>on main portal</span>
                </div>
            </div>
        </a>

        <!-- Registered Users -->
        <a href="/admin/user" wire:navigate.hover class="group bg-white rounded-2xl p-5 border border-gray-200/80 shadow-sm hover:shadow-md hover:border-purple-300 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">User Accounts</span>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-gray-900">{{ $totalUsers }}</div>
                <div class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">
                    <span>{{ $studentUsers }} student accounts</span>
                </div>
            </div>
        </a>
    </div>


    <!-- 4. Main Interactive Section (Calendar & Upcoming Events Feed) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Left: Calendar (7 Columns on large screens) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Campus Event Calendar</h2>
                        <p class="text-xs text-gray-500">Interactive schedule grid for La Salle University</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-700 border border-green-200/60">
                        {{ now()->format('F Y') }}
                    </span>
                </div>

                @livewire('component.public.calendar')
            </div>
        </div>

        <!-- Right: Upcoming Events & Spotlight Preview (5 Columns) -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Upcoming Events Feed -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-100">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Upcoming Events</h2>
                        <p class="text-xs text-gray-500">Chronological schedule feed</p>
                    </div>
                    <a href="/admin/event" wire:navigate.hover class="text-xs font-semibold text-green-700 hover:text-green-800 hover:underline">
                        View All &rarr;
                    </a>
                </div>

                @livewire('component.public.upcoming-events', ['take' => 4])
            </div>

            <!-- Spotlight Preview (if any) -->
            @if ($spotlightEvents->count() > 0)
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200/80 p-5 shadow-sm">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-amber-200/60">
                    <div class="flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-500 text-white text-xs">
                            ★
                        </span>
                        <h3 class="text-sm font-bold text-amber-900">Active Spotlight</h3>
                    </div>
                    <a href="/admin/event/spotlight" wire:navigate.hover class="text-xs font-semibold text-amber-700 hover:underline">
                        Manage &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @foreach ($spotlightEvents as $spot)
                    <div class="bg-white rounded-xl p-3.5 border border-amber-200/60 shadow-xs flex items-center justify-between gap-3">
                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm font-bold text-gray-900 truncate">{{ $spot->events_name }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ \Carbon\Carbon::parse($spot->events_start_date)->format('M d, Y') }} &bull; {{ $spot->events_location ?? 'Campus' }}
                            </p>
                        </div>
                        <a href="/admin/event/edit/{{ $spot->events_id }}" wire:navigate.hover class="shrink-0 text-xs font-semibold text-green-700 hover:text-green-800 hover:underline">
                            Edit
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- 5. Recently Added & Managed Events Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="p-6 pb-4 flex items-center justify-between flex-wrap gap-4 border-b border-gray-100">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Recently Added Events</h2>
                <p class="text-xs text-gray-500">Latest event records created in the system</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="/admin/event/create" wire:navigate.hover class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-700 text-white hover:bg-green-800 transition-colors shadow-xs">
                    <span>+ New Event</span>
                </a>
                <a href="/admin/event" wire:navigate.hover class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors">
                    <span>All Events ({{ $totalEvents }})</span>
                </a>
            </div>
        </div>

        @if ($recentEvents->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/75 text-xs uppercase tracking-wider text-gray-500 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5 font-semibold">Event Name</th>
                        <th class="px-6 py-3.5 font-semibold">Organization / Type</th>
                        <th class="px-6 py-3.5 font-semibold">Dates</th>
                        <th class="px-6 py-3.5 font-semibold">Location</th>
                        <th class="px-6 py-3.5 font-semibold">Status</th>
                        <th class="px-6 py-3.5 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($recentEvents as $event)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 hover:text-green-700 transition-colors">
                                <a href="/admin/event/edit/{{ $event->events_id }}" wire:navigate.hover>
                                    {{ $event->events_name }}
                                </a>
                            </div>
                            <div class="text-xs text-gray-500 line-clamp-1 max-w-xs mt-0.5">
                                {{ $event->events_description }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700">
                                {{ $event->events_organization_type ?? 'Campus Wide' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($event->events_start_date)->format('M d, Y') }}
                            </div>
                            @if ($event->events_end_date && $event->events_end_date !== $event->events_start_date)
                            <div class="text-[11px] text-gray-500">
                                to {{ \Carbon\Carbon::parse($event->events_end_date)->format('M d, Y') }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-600">
                            {{ $event->events_location ?? 'LSU Campus' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($event->events_status)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                    Draft / Off
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="/admin/event/edit/{{ $event->events_id }}" wire:navigate.hover class="px-3 py-1 rounded-lg text-xs font-semibold text-green-700 bg-green-50 hover:bg-green-100 transition-colors">
                                    Edit
                                </a>
                                <a href="/event/{{ $event->events_id }}/{{ str_replace(' ', '-', strtolower($event->events_name)) }}" target="_blank" class="px-2 py-1 rounded-lg text-xs font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-colors" title="View Public Page">
                                    ↗
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-12 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h3 class="mt-3 text-sm font-bold text-gray-900">No events found</h3>
            <p class="mt-1 text-xs text-gray-500">Get started by scheduling your first student event for La Salle University.</p>
            <div class="mt-4">
                <a href="/admin/event/create" wire:navigate.hover class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-green-700 text-white hover:bg-green-800 shadow-sm transition-all">
                    + Create First Event
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
