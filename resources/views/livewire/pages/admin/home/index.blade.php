<div class="space-y-10">
    <div class=" mx-auto">
        <img src="{{ asset('assets/img/admin-header.jpg') }}" class="w-full h-auto object-cover" alt="Header Image">
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="space-y-3">
            <h1 class="text-gray-500 font-medium text-lg md:text-2xl">Calendar of Events</h1>
            <div class="border bg-white rounded-2xl p-5">
                @livewire('component.public.calendar')
            </div>
        </div>

        @livewire('component.public.upcoming-events', ['take' => 4])
    </div>
</div>
