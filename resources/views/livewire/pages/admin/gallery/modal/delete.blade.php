<div>
    <x-modals.default name="{{ $modal }}" maxWidth="sm:max-w-md">
        <div class="p-6">
            <div class="flex items-start gap-4">
                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-1 text-left">
                    <h3 class="text-base font-bold text-gray-900 leading-6">Delete Carousel Banner</h3>
                    <p class="mt-2 text-xs text-gray-500">
                        Are you sure you want to delete this carousel banner? It will be permanently removed from the public student homepage revolving slider.
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-50/80 px-6 py-3.5 sm:flex sm:flex-row-reverse gap-3 rounded-b-2xl border-t border-gray-100">
            <button type="button"
                wire:click="submit"
                wire:loading.attr="disabled"
                class="inline-flex w-full justify-center rounded-xl bg-red-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-red-700 sm:w-auto transition-all active:scale-95">
                <span wire:loading.remove wire:target="submit">{{ __('Delete Banner') }}</span>
                <span wire:loading wire:target="submit">{{ __('Deleting...') }}</span>
            </button>
            <button type="button"
                x-on:click="{{ $modal }} = false"
                class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2.5 text-xs font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-all">
                {{ __('Cancel') }}
            </button>
        </div>
    </x-modals.default>
</div>