@props(['name' => false])

<div 
    class="relative z-50" 
    aria-labelledby="slide-over-title" 
    role="dialog" 
    aria-modal="true"
    x-show="{{ $name }}">
    <div 
        class="fixed inset-0 bg-black bg-opacity-50"
        x-transition:enter="ease-out duration-500" 
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" 
        x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0" 
        x-show="{{ $name }}"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div 
                    class="pointer-events-auto w-screen max-w-md"
                    x-show="{{ $name }}"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" 
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" 
                    x-transition:leave-end="translate-x-full"
                    x-on:click.away="{{ $name }} = false">
                    <div class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                        <div class="flex min-h-0 flex-1 flex-col">
                            <div class="px-4 sm:px-6 pt-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-semibold leading-6 text-gray-600"
                                        id="slide-over-title">
                                        {{ $title }}
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button"
                                            class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            x-on:click="{{ $name }} = false">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 sm:px-6 border-t border-gray-100 overflow-y-auto">
                                {{ $content }}
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 justify-end px-4 py-4 gap-3">
                            {{ $action }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>