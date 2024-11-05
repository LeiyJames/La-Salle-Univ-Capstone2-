<div>
    <x-modals.default name="{{ $modal }}" maxWidth="sm:max-w-sm">
        <div class="px-4 p-4 sm:p-6 sm:pb-4">
            <div class="space-y-3">
                <p class="text-gray-500">Are you sure you want to delete?</p>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex justify-end sm:px-6 gap-3">
            <x-secondary-button class="py-2.5" x-on:click="{{ $modal }} = false">
                <span class="w-full text-center">{{ __('Close') }}</span>
            </x-secondary-button>
            <x-danger-button class="py-2.5" wire:click="submit">
                <span class="w-full text-center">{{ __('Yes') }}</span>
            </x-danger-button>
        </div>
    </x-modals.default>
</div>