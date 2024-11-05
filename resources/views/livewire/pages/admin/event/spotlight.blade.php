<div>
    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-gray-600 uppercase">Event Spotlight</h1>
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs text-gray-400">Home</a>
                    <span class="text-xs text-gray-400">/</span>
                    <a href="/admin/event" class="text-xs text-gray-400">Events</a>
                    <span class="text-xs text-gray-400">/</span>
                    <span class="text-xs text-blue-400">Spotlight</span>
                </div>
            </div>
            <div>
                <x-primary-button class="py-2.5" wire:click="save" wire:target="save" wire:loading.class="pointer-events-none animate-pulse">
                    <span class="w-full text-center">{{ __('Save Changes') }}</span>
                </x-primary-button>
            </div>
        </div>

        <div class="overflow-hidden bg-white rounded-2xl">
            <div class="p-4 px-4 space-y-3 sm:p-6 sm:pb-4">
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <x-input-label :value="__('Events')" class="mb-1" />
                            <x-text-input-select type="text" class="w-full rounded-2xl" wire:model.live="spotlight.event_id">
                                <option value="" hidden selected>Select</option>
                                @foreach ($events as $event)
                                <option value="{{ $event->events_id }}">{{ $event->events_name }}</option>
                                @endforeach
                            </x-text-input-select>

                            @error('spotlight.event_id')
                            <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 md:col-span-1">
                                <x-input-label for="event-start-date" :value="__('Start Date')" class="mb-1" />
                                <x-text-input type="date" id="event-start-date" class="w-full bg-gray-100" disabled wire:model="spotlight.start_date" />
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <x-input-label for="event-end-date" :value="__('End Date')" class="mb-1" />
                                <x-text-input type="date" id="event-end-date" class="w-full bg-gray-100" disabled wire:model="spotlight.end_date" />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <x-input-label :value="__('Description')" class="mb-1" />
                    <x-text-input-textarea class="w-full" rows="3" wire:model="spotlight.description" />

                    @error('spotlight.description')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="overflow-hidden bg-white rounded-2xl">
            <div class="p-4 space-y-3 sm:p-6">
                <div class="flex items-center justify-between">
                    <nav class="flex gap-4" aria-label="Tabs">
                        <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'basic_education']) wire:click="setTab('basic_education')">Basic Education</span>
                        <span @class(['cursor-pointer text-gray-500 hover:text-gray-700 font-medium', 'text-green-700' => $tab == 'higher_education']) wire:click="setTab('higher_education')">Higher Education</span>
                    </nav>
                </div>

                <table class="min-w-full border-t divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Date / Time</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Activity Name</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Location</th>
                            <th scope="col" class="uppercase relative py-3.5">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($activity[$tab] ?? [] as $key => $act)
                        <tr>
                            <td class="whitespace-nowrap py-1.5 text-sm font-medium text-gray-900">
                                <x-text-input type="datetime-local" class="w-full" wire:model="activity.{{ $tab }}.{{ $key }}.date" />

                                @error('activity.{{ $tab }}.{{ $key }}.date')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                                @enderror

                                @isset($customError[$key])
                                <p class="mt-2 text-xs text-red-500">{{ $customError[$key]['message'] }}</p>
                                @endisset
                            </td>
                            <td class="whitespace-nowrap py-1.5 text-sm text-gray-500">
                                <x-text-input type="text" class="w-full" wire:model="activity.{{ $tab }}.{{ $key }}.name" />

                                @error('activity.{{ $tab }}.{{ $key }}.name')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                            <td class="whitespace-nowrap py-1.5 text-sm text-gray-500">
                                <x-text-input type="text" class="w-full" wire:model="activity.{{ $tab }}.{{ $key }}.location" />

                                @error('activity.{{ $tab }}.{{ $key }}.location')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                            <td class="relative whitespace-nowrap py-1.5 text-right text-sm font-medium space-x-3">
                                <a href="#" class="text-red-600 hover:text-red-900" wire:click="removeActivity({{ $key }})" wire:target="removeActivity({{ $key }})" wire:loading.class="pointer-events-none animate-pulse">
                                    <span>Remove</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="whitespace-nowrap py-1.5 text-sm font-medium text-gray-900 text-center" colspan="4">
                                <span>No data available</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="divide-y divide-gray-200">
                        <tr>
                            <td class="pt-2 text-sm whitespace-nowrap" colspan="4">
                                <x-primary-button wire:click="addActivity" wire:target="addActivity" wire:loading.class="pointer-events-none animate-pulse">
                                    <span class="w-full text-center">{{ __('Add Activity') }}</span>
                                </x-primary-button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
