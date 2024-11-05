<div class="space-y-3">
    <h3 class="font-semibold">Upcoming Events</h3>
    @forelse ($data as $event)
    <div class="p-5 space-y-3 bg-white border rounded-2xl">
        <a href="/event/{{ $event->events_id }}/{{ str_replace(' ', '-', strtolower($event->events_name)) }}">
            <h3 class="font-semibold tet-gray-500">{{ $event->events_name }}</h3>
        </a>
        <p class="truncate">{{ $event->events_description }}</p>
    </div>
    @empty
    <span>No data available</span>
    @endforelse

    @if ($data->hasPages())
    <div>
        {{ $data->links() }}
    </div>
    @endif
</div>
