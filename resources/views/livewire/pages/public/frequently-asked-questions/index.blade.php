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
                <div class="p-8 text-center flex flex-col items-center justify-center space-y-3.5">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100/80 border border-emerald-200/60 flex items-center justify-center text-green-700">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-bold text-gray-800">No FAQs Available</h4>
                        <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
                            There are no frequently asked questions available at this time. Check back soon!
                        </p>
                    </div>
                </div>
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
