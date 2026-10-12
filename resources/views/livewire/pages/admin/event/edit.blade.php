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

        @if (session()->has('error'))
        <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-xs text-red-800 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <svg class="h-4 w-4 text-red-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <div class="overflow-hidden bg-white rounded-2xl">
            <div class="p-4 px-4 space-y-3 sm:p-6 sm:pb-4">
                <div class="relative flex items-end justify-between">
                    <div>
                        <x-input-label for="event-photo" :value="__('Photo (leave empty to keep current)')" class="mb-1" />
                        <input type="file" id="event-photo" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer" wire:model="file" accept="image/*" />

                        <div wire:loading wire:target="file" class="text-xs text-green-600 font-medium mt-1 flex items-center gap-1.5">
                            <svg class="animate-spin h-3.5 w-3.5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Uploading poster preview...</span>
                        </div>

                        @error('file')
                        <span class="mt-2 text-xs text-red-500 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <x-primary-button class="py-2.5" wire:click="preview" wire:loading.attr="disabled" wire:target="file">
                        <span class="w-full text-center">{{ __('Preview') }}</span>
                    </x-primary-button>
                </div>

                @if ($file && method_exists($file, 'temporaryUrl'))
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-200 flex items-center gap-3">
                    <img src="{{ $file->temporaryUrl() }}" class="h-16 w-24 object-cover rounded-lg border shadow-xs" alt="New poster preview">
                    <div class="text-xs text-gray-600">
                        <p class="font-semibold text-gray-800">New Poster Selected</p>
                        <p class="text-gray-400 text-[11px]">Will replace the existing event poster when saved.</p>
                    </div>
                </div>
                @endif
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
                    <x-input-label :value="__('Related Tags')" class="mb-2 font-semibold text-gray-800" />
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2.5 p-3 rounded-xl border border-gray-200 bg-gray-50/70">
                        @php
                            $availableTags = [
                                'ccsea' => 'CCSEA',
                                'cte' => 'CTE',
                                'con' => 'CON',
                                'cba' => 'CBA',
                                'basic_education' => 'Basic Education',
                                'higher_education' => 'Higher Education',
                                'workshop' => 'Workshop',
                                'sports' => 'Sports',
                                'abo' => 'ABO',
                                'ibo' => 'IBO',
                            ];
                        @endphp
                        @foreach ($availableTags as $tagKey => $tagLabel)
                        <label class="flex items-center gap-2 p-2 rounded-lg bg-white border border-gray-200 hover:border-green-500 hover:bg-green-50/40 cursor-pointer transition-all shadow-2xs">
                            <input type="checkbox" value="{{ $tagKey }}" wire:model="event.events_related_tags" class="rounded text-green-700 focus:ring-green-600 border-gray-300">
                            <span class="text-xs font-semibold text-gray-700">{{ $tagLabel }}</span>
                        </label>
                        @endforeach
                    </div>
                    <span class="text-[11px] text-gray-400 mt-1 block">Check any categories or colleges that apply to this event.</span>

                    @error('event.events_related_tags')
                    <span class="mt-2 text-xs text-red-500 block">{{ $message }}</span>
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
                    <x-primary-button class="py-2.5 bg-green-700 hover:bg-green-800 disabled:opacity-50" wire:click="save" wire:loading.attr="disabled" wire:target="file, save">
                        <span wire:loading.remove wire:target="save, file" class="w-full text-center">{{ __('Save Changes') }}</span>
                        <span wire:loading wire:target="file" class="w-full text-center">{{ __('Uploading Poster...') }}</span>
                        <span wire:loading wire:target="save" class="w-full text-center">{{ __('Saving Changes...') }}</span>
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
