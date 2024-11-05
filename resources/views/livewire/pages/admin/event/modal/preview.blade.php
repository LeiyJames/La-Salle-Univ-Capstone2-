<div>
    <x-modals.default name="{{ $modal }}" maxWidth="sm:max-w-3xl">
        <div class="p-4 px-4 sm:p-6 sm:pb-4">
            <div class="space-y-3">
                @isset($event)
                <div class="relative h-[500px] rounded-2xl overflow-hidden">
                    <img src="{{ $file ?? asset('assets/img/Content Placeholder.png') }}" class="absolute w-full h-[500px] object-cover">
                </div>
                <h1 class="text-xl font-semibold">{{ $event['events_name'] }}</h1>
                <ul class="flex gap-2">
                    <li class="bg-gray-100 rounded-2xl px-3 py-0.5">{{ $event['events_start_date'] }}</li>
                    <li class="bg-gray-100 rounded-2xl px-3 py-0.5">{{ $event['events_location'] }}</li>
                </ul>
                <p class="text-justify">{{ $event['events_description'] }}</p>
                <ul class="flex gap-2">
                    @foreach ($event['events_related_tags'] as $related_tag)
                    <li class="bg-gray-100 rounded-2xl px-3 py-0.5">{{ $related_tag }}</li>
                    @endforeach
                </ul>
                <div>
                    @if ($event['events_workshop_registration'])
                    <a href="{{ $event['events_registration_link'] }}" target="_blank">
                        <x-primary-button class="w-full md:w-auto">
                            <span class="w-full text-center">Register</span>
                        </x-primary-button>
                    </a>
                    @endif
                </div>
                @else
                <span>No data available</span>
                @endisset
            </div>
        </div>
        <div class="justify-end gap-3 px-4 py-3 bg-gray-50 sm:flex sm:px-6">
            <x-secondary-button class="py-2.5" x-on:click="{{ $modal }} = false">
                <span class="w-full text-center">{{ __('Close') }}</span>
            </x-secondary-button>
        </div>
    </x-modals.default>
</div>
