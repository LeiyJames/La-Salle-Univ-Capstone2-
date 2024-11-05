@props(['name' => false, 'maxWidth' => 'sm:max-w-2xl'])

<div 
    class="relative z-50" 
    aria-labelledby="modal-title" 
    role="dialog" 
    ria-modal="true"
    x-show="{{ $name }}">
    <div 
        class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"
        x-show="{{ $name }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full {{ $maxWidth }}"
                x-show="{{ $name }}"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-on:click.away="{{ $name }} = false">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>