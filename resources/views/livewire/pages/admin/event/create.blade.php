<div x-data="data">
    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-gray-800 uppercase">Create Event</h1>
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs text-gray-400 hover:text-green-700">Home</a>
                    <span class="text-xs text-gray-400">/</span>
                    <a href="/admin/event" class="text-xs text-gray-400 hover:text-green-700">Events</a>
                    <span class="text-xs text-gray-400">/</span>
                    <span class="text-xs text-green-700 font-semibold">Create Event</span>
                </div>
            </div>
        </div>

        @if (session()->has('error'))
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs flex items-center gap-2.5 shadow-xs">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        @endif

        <div class="overflow-hidden bg-white rounded-2xl border border-gray-200 shadow-sm">
            <div class="p-4 px-4 space-y-5 sm:p-6 sm:pb-4">
                <!-- Photo Upload Field with Preview -->
                <div class="space-y-2">
                    <x-input-label for="event-photo" :value="__('Event Poster / Banner Photo')" class="mb-1 font-semibold text-gray-800" />
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/60">
                        @if ($file && method_exists($file, 'temporaryUrl'))
                            <div class="relative rounded-xl overflow-hidden border border-gray-200 shadow-xs w-32 h-24 shrink-0 bg-white">
                                <img src="{{ $file->temporaryUrl() }}" alt="Preview" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="flex-1 space-y-1.5">
                            <input type="file" id="event-photo" class="text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-700 file:text-white hover:file:bg-green-800 cursor-pointer" accept="image/png, image/jpeg, image/jpg, image/webp" wire:model="file" />
                            <p class="text-[11px] text-gray-400">PNG, JPG, JPEG up to 5MB. Landscape 16:9 recommended.</p>
                            
                            <div wire:loading wire:target="file" class="text-xs text-green-700 font-semibold flex items-center gap-2 pt-1">
                                <svg class="animate-spin h-3.5 w-3.5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                                <span>Uploading image preview...</span>
                            </div>
                        </div>

                        @if ($file)
                        <x-secondary-button class="py-2 px-3 text-xs shrink-0" wire:click="preview">
                            <span class="w-full text-center">{{ __('Preview Card') }}</span>
                        </x-secondary-button>
                        @endif
                    </div>

                    @error('file')
                    <span class="mt-1 text-xs text-red-500 block">{{ $message }}</span>
                    @enderror
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
                        <option value="interest_based">Interest-Based</option>
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
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    @error('event.events_registration_link')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="justify-end gap-3 px-4 py-3 bg-gray-50 sm:flex sm:px-6">
                <a href="/admin/event">
                    <x-secondary-button class="py-2.5">
                        <span class="w-full text-center">{{ __('Cancel') }}</span>
                    </x-secondary-button>
                </a>
                @if (in_array(auth()->user()?->users_role, ['admin', 'editor']))
                <x-primary-button class="py-2.5" wire:click="save" wire:target="save, file" wire:loading.attr="disabled" wire:loading.class="pointer-events-none opacity-60">
                    <span wire:loading.remove wire:target="save, file" class="w-full text-center">{{ __('Publish') }}</span>
                    <span wire:loading wire:target="file" class="w-full text-center">{{ __('Uploading image...') }}</span>
                    <span wire:loading wire:target="save" class="w-full text-center">{{ __('Publishing...') }}</span>
                </x-primary-button>
                @endif
            </div>
        </div>
    </div>

    @if ($file)
    @livewire('pages.admin.event.modal.preview', ['modal' => 'event_preview_modal', 'file' => $file])
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                event_preview_modal: @entangle('event_preview_modal')
            }))
        })
    </script>
</div>
