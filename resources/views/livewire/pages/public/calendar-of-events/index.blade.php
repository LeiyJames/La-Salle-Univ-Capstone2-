<div>
    @livewire('component.public.carousel' , ['height' => '500'])
    @livewire('layout.public.sub-navigation')

    <div class="p-4 mx-auto space-y-10 max-w-7xl lg:px-8 my-14">
        <h1 href="#" class="font-medium text-green-700">Calendar of Events</h1>
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
            <div class="p-5 border rounded-2xl">
                @livewire('component.public.calendar')
            </div>

            <div class="relative space-y-5">
                @isset($event)
                <div class="p-5 space-y-3 border rounded-2xl">
                    <h3 class="font-semibold">{{ $event->events_name }}</h3>
                    <p>{{ $event->events_description }}</p>
                    <a href="/event/spotlight" class="mt-3">
                        <x-primary-button class="rounded-2xl">
                            <span class="w-full text-center">Schedule of Activities</span>
                        </x-primary-button>
                    </a>
                </div>
                @endisset

                @livewire('component.public.upcoming-events', ['take' => 4])
            </div>
        </div>
    </div>
</div>
