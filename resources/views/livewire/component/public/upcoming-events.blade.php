<div class="space-y-3">
    <div class="flex items-center justify-between">
        <h3 class="font-bold text-gray-900 text-sm sm:text-base">Upcoming Events</h3>
    </div>

    @forelse ($data as $event)
    <div class="p-5 space-y-2 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
        <a href="/event/{{ $event->events_id }}/{{ str_replace(' ', '-', strtolower($event->events_name)) }}">
            <h4 class="font-semibold text-gray-900 hover:text-green-700 transition-colors">{{ $event->events_name }}</h4>
        </a>
        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">{{ $event->events_description }}</p>
    </div>
    @empty
    <!-- Empty State with Border, Notification Pill, and Icon -->
    <div class="p-6 sm:p-8 rounded-2xl border-2 border-dashed border-gray-200 bg-white/70 text-center flex flex-col items-center justify-center space-y-3.5 shadow-xs">
        <!-- Notification Pill -->
        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-xs">
            All Caught Up
        </span>

        <!-- Calendar Icon -->
        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100/80 border border-emerald-200/60 flex items-center justify-center text-green-700 shadow-xs">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-3.75h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>
        </div>

        <!-- Notification Message -->
        <div class="space-y-1">
            <h4 class="text-sm font-bold text-gray-800">No Events Scheduled</h4>
            <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
                There are no upcoming campus activities or events scheduled for these dates. Check back soon!
            </p>
        </div>
    </div>
    @endforelse

    @if ($data->hasPages())
    <div>
        {{ $data->links() }}
    </div>
    @endif
</div>
