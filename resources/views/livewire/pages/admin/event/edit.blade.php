<div x-data="data">
    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-gray-600 uppercase">Edit Event</h1>
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs text-gray-400">Home</a>
                    <span class="text-xs text-gray-400">/</span>
                    <a href="/admin/event" class="text-xs text-gray-400">Events</a>
                    <span class="text-xs text-gray-400">/</span>
                    <span class="text-xs text-blue-400">{{ $event['events_name'] }}</span>
                </div>
            </div>
        </div>
        <div class="overflow-hidden bg-white rounded-2xl">
            <div class="p-4 px-4 space-y-3 sm:p-6 sm:pb-4">
                <div class="relative flex items-end justify-between">
                    <div>
                        <x-input-label for="event-photo" :value="__('Photo')" class="mb-1" />
                        <input type="file" id="event-photo" class="w-full" wire:model="file" />

                        @error('file')
                        <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <x-primary-button class="py-2.5" wire:click="preview">
                        <span class="w-full text-center">{{ __('Preview') }}</span>
                    </x-primary-button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <x-input-label for="event-name" :value="__('Name')" class="mb-1" />
                            <x-text-input type="text" id="event-name" class="w-full"  wire:model="event.events_name" />

                            @error('event.events_name')
                            <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 md:col-span-1">
                                <x-input-label for="event-start-date" :value="__('Start Date')" class="mb-1" />
                                <x-text-input type="date" id="event-start-date" class="w-full" wire:model="event.events_start_date" />

                                @error('event.events_start_date')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <x-input-label for="event-end-date" :value="__('End Date')" class="mb-1" />
                                <x-text-input type="date" id="event-end-date" class="w-full" wire:model="event.events_end_date" />

                                @error('event.events_end_date')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <x-input-label :value="__('Location')" class="mb-1" />
                    <x-text-input-textarea class="w-full" rows="1" wire:model="event.events_location" />

                    @error('event.events_location')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label :value="__('Description')" class="mb-1" />
                    <x-text-input-textarea class="w-full" rows="3" wire:model="event.events_description" />

                    @error('event.events_description')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label :value="__('Category')" class="mb-1" />
                    <x-text-input-select type="text" class="w-full rounded-2xl" wire:model="event.events_organization_type">
                        <option value="" selected hidden>Select</option>
                        <option value="academic_based">Academic-Based</option>
                    </x-text-input-select>

                    @error('event.events_organization_type')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="event-related-tags" :value="__('Related Tags')" class="mb-1" />
                    <x-text-input-select type="text" class="w-full rounded-2xl" wire:model="event.events_related_tags" multiple>
                        <option value="" selected hidden>Select</option>
                        <option value="ccsea">CCSEA</option>
                        <option value="cte">CTE</option>
                        <option value="con">CON</option>
                        <option value="cba">CBA</option>
                        <option value="basic_education">Basic Education</option>
                        <option value="higher_education">Higher Education</option>
                        <option value="workshop">Workshop</option>
                        <option value="sports">Sports</option>
                        <option value="abo">ABO</option>
                        <option value="ibo">IBO</option>
                    </x-text-input-select>

                    @error('event.events_related_tags')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label :value="__('Has a Workshop Registration?')" class="mb-1" />
                    <div class="flex items-center overflow-hidden border rounded-lg">
                        <div class="flex gap-3 px-3">
                            <span class="inline-flex items-center gap-1">
                                <input type="radio" id="yes" name="registration" class="cursor-pointer" value="1" wire:model.live="event.events_workshop_registration" />
                                <label for="yes" class="text-bg-darkblue">Yes</label>
                            </span>
                            <span class="inline-flex items-center gap-1">
                                <input type="radio" id="no" name="registration" class="cursor-pointer" value="0" wire:model.live="event.events_workshop_registration" />
                                <label for="no" class="text-bg-darkblue">No</label>
                            </span>
                        </div>

                        <div class="flex-1">
                            <x-text-input type="text" id="event-name" class="w-full border-0 border-l rounded-none" placeholder="Registration Link" disabled="{{ ! $event['events_workshop_registration'] }}" wire:model="event.events_registration_link" />
                        </div>
                    </div>

                    @error('event.events_workshop_registration')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror

                    @error('event.events_registration_link')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="justify-between gap-3 px-4 py-3 bg-gray-50 sm:flex sm:px-6">
                <div class="w-40">
                    <x-text-input-select type="text" class="w-full rounded-2xl" wire:model="event.events_status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-text-input-select>
                </div>

                <div class="flex gap-3">
                    <a href="/admin/event">
                        <x-secondary-button class="py-2.5">
                            <span class="w-full text-center">{{ __('Cancel') }}</span>
                        </x-secondary-button>
                    </a>

                    @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                    <x-primary-button class="py-2.5" wire:click="save" wire:target="save" wire:loading.class="pointer-events-none animate-pulse">
                        <span class="w-full text-center">{{ __('Save Changes') }}</span>
                    </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @livewire('pages.admin.event.modal.preview', ['modal' => 'event_preview_modal'])

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                event_preview_modal: @entangle('event_preview_modal')
            }))
        })
    </script>
</div>
