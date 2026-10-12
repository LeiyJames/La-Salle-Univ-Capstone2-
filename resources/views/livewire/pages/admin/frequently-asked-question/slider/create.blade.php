<div>
    <x-sliders.default name="{{ $slider }}">
        <x-slot name="title">Add Frequently Asked Question</x-slot>
        <x-slot name="content">
            <div class="py-4 space-y-4">
                <div>
                    <x-input-label :value="__('Question')" class="mb-1 font-semibold text-gray-800" />
                    <x-text-input-textarea class="w-full rounded-xl text-xs border-gray-300 focus:border-green-600 focus:ring-green-600" rows="3" placeholder="e.g. How do I register a new student organization?" wire:model="faq.faqs_question" />
                    @error('faq.faqs_question')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label :value="__('Answer')" class="mb-1 font-semibold text-gray-800" />
                    <x-text-input-textarea class="w-full rounded-xl text-xs border-gray-300 focus:border-green-600 focus:ring-green-600" rows="5" placeholder="Provide a helpful, detailed answer for students..." wire:model="faq.faqs_answer" />
                    @error('faq.faqs_answer')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label :value="__('Publication Status')" class="mb-1 font-semibold text-gray-800" />
                    <x-text-input-select class="w-full rounded-xl text-xs border-gray-300 focus:border-green-600 focus:ring-green-600" wire:model="faq.faqs_status">
                        <option value="1">Active (Published on website)</option>
                        <option value="0">Inactive (Draft / Hidden)</option>
                    </x-text-input-select>
                    @error('faq.faqs_status')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="action">
            <x-secondary-button class="py-2.5" x-on:click="{{ $slider }} = false">
                <span class="w-full text-center">{{ __('Cancel') }}</span>
            </x-secondary-button>
            <x-primary-button class="py-2.5 bg-green-700 hover:bg-green-800" wire:click="save" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save" class="w-full text-center font-bold">{{ __('Save Question') }}</span>
                <span wire:loading wire:target="save" class="w-full text-center font-bold">{{ __('Saving...') }}</span>
            </x-primary-button>
        </x-slot>
    </x-sliders.default>
</div>