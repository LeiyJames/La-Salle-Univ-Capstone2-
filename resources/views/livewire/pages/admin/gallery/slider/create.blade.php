<div>
    <x-sliders.default name="{{ $slider }}">
        <x-slot name="title">New Photo</x-slot>
        <x-slot name="content">
            <div class="space-y-3 py-3">
                <div>
                    <x-input-label for="gallery-photo" :value="__('Photo')" class="mb-1" />
                    <input type="file" id="gallery-photo" class="w-full" wire:model="file" />

                    @error('file')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label :value="__('Type')" class="mb-1" />
                    <x-text-input-select type="text" class="rounded-2xl w-full" wire:model="type" disabled="{{ true }}">
                        <option value="" hidden>Select</option>
                        <option value="carousel">Carousel</option>
                    </x-text-input-select>

                    @error('type')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="action">
            <x-secondary-button class="py-2.5" x-on:click="{{ $slider }} = false">
                <span class="w-full text-center">{{ __('Cancel') }}</span>
            </x-secondary-button>
            <x-primary-button class="py-2.5" wire:click="save">
                <span class="w-full text-center">{{ __('Save') }}</span>
            </x-primary-button>
        </x-slot>
    </x-sliders.default>
</div>