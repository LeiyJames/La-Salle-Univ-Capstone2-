<div>
    <x-sliders.default name="{{ $slider }}">
        <x-slot name="title">Edit FAQ</x-slot>
        <x-slot name="content">
            @isset($faq)
            <div class="py-3 space-y-3">
                <div>
                    <x-input-label :value="__('Question')" class="mb-1" />
                    <x-text-input-textarea class="w-full rounded-2xl" rows="3" wire:model="faq.faqs_question" />
                </div>
                <div>
                    <x-input-label :value="__('Answer')" class="mb-1" />
                    <x-text-input-textarea class="w-full rounded-2xl" rows="3" wire:model="faq.faqs_answer" />
                </div>
                <div>
                    <x-input-label :value="__('Status')" class="mb-1" />
                    <x-text-input-select type="text" class="w-full rounded-2xl" wire:model="faq.faqs_status">
                        <option value="" selected hidden>Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-text-input-select>
                </div>
            </div>
            @endisset
        </x-slot>
        <x-slot name="action">
            <x-secondary-button class="py-2.5" x-on:click="{{ $slider }} = false">
                <span class="w-full text-center">{{ __('Cancel') }}</span>
            </x-secondary-button>
            <x-primary-button class="py-2.5" wire:click="save">
                <span class="w-full text-center">{{ __('Save Changes') }}</span>
            </x-primary-button>
        </x-slot>
    </x-sliders.default>
</div>
