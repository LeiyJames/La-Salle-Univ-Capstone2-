<div>
    @livewire('component.public.carousel' , ['height' => '500'])
    @livewire('layout.public.sub-navigation')

    <div class="p-4 mx-auto space-y-10 max-w-7xl lg:px-8 my-14">
        <div class="flex items-center justify-between">
            <h1 href="#" class="font-medium text-green-700">Frequently Asked Questions</h1>
            <div class="relative">
                <x-icons.search class="absolute top-[10.5px] left-3 w-4 h-4" stroke="#6b7280" />
                <x-text-input type="text" class="pl-8 rounded-2xl" wire:model.live="search" />
            </div>
        </div>
        <div class="overflow-hidden border rounded-2xl">
            <div class="divide-y divide-gray-100">
                @forelse ($data as $faq)
                <div x-data="{ open: false, toggle() { this.open = !this.open } }">
                    <div
                        class="flex items-center justify-between p-3 cursor-pointer hover:bg-gray-100"
                        x-bind:class="open ? 'bg-gray-100' : ''"
                        x-on:click="toggle">
                        <h3 class="font-semibold">{{ $faq->faqs_question }}</h3>
                        <x-icons.caret-up-down class="w-5 h-5" fill="#6b7280" />
                    </div>
                    <div class="p-3" x-show="open">
                        <p>{{ $faq->faqs_answer }}</p>
                    </div>
                </div>
                @empty
                <span class="text-gray-500">No data available.</span>
                @endforelse
            </div>
        </div>

        @if ($data->hasPages())
        <div>
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
