<div class="relative w-full overflow-hidden bg-green-950"
    x-data="{
        current: 0,
        total: {{ max($galleries->count(), 1) }},
        timer: null,
        startAutoplay() {
            if (this.total > 1) {
                this.timer = setInterval(() => {
                    this.next();
                }, 5000);
            }
        },
        stopAutoplay() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        next() {
            this.current = (this.current + 1) % this.total;
        },
        prev() {
            this.current = (this.current - 1 + this.total) % this.total;
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()">

    <!-- Carousel Slides Container -->
    <div class="relative h-[340px] sm:h-[420px] md:h-[480px] lg:h-[520px] w-full">
        @forelse ($galleries as $index => $gallery)
        @php
            $imageUrl = $gallery->getFirstMediaUrl('gallery') ?: asset('assets/img/Panaghugpong2023 1.png');
        @endphp
        <div x-show="current === {{ $index }}"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 w-full h-full">
            <img src="{{ $imageUrl }}"
                 alt="Carousel Banner"
                 class="w-full h-full object-cover">
            <!-- Subtle gradient scrim at bottom so content pops -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
        </div>
        @empty
        <!-- Fallback University Hero Slide -->
        <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-green-900 via-green-800 to-green-950 flex items-center justify-center">
            <img src="{{ asset('assets/img/Panaghugpong2023 1.png') }}"
                 alt="LSU Campus Events"
                 class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20 flex flex-col items-center justify-center text-center px-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-400 text-green-950 text-xs font-black tracking-wider uppercase mb-3 shadow-lg">
                    Official Campus Event Portal
                </span>
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-black text-white tracking-tight drop-shadow-md max-w-3xl">
                    Discover, Engage & Experience Lasallian Events
                </h1>
                <p class="mt-2 text-xs sm:text-base text-gray-200 max-w-xl drop-shadow">
                    Stay updated with the latest university assemblies, seminars, sports meets, and student organization highlights.
                </p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Navigation Arrows (Shown when more than 1 slide) -->
    @if ($galleries->count() > 1)
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 sm:pl-6 z-10">
        <button type="button"
                x-on:click="prev()"
                class="rounded-full bg-black/40 hover:bg-black/70 text-white p-2 sm:p-2.5 backdrop-blur-md transition-all transform hover:scale-110 active:scale-95 focus:outline-none border border-white/20 shadow-lg"
                aria-label="Previous Slide">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>
    </div>

    <div class="absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-6 z-10">
        <button type="button"
                x-on:click="next()"
                class="rounded-full bg-black/40 hover:bg-black/70 text-white p-2 sm:p-2.5 backdrop-blur-md transition-all transform hover:scale-110 active:scale-95 focus:outline-none border border-white/20 shadow-lg"
                aria-label="Next Slide">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>

    <!-- Slide Indicators & Counter -->
    <div class="absolute bottom-12 sm:bottom-14 left-1/2 -translate-x-1/2 z-10 flex items-center gap-2 bg-black/40 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/20">
        @foreach ($galleries as $index => $gallery)
        <button type="button"
                x-on:click="current = {{ $index }}"
                class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                :class="current === {{ $index }} ? 'w-6 bg-yellow-400' : 'w-2 bg-white/50 hover:bg-white'"
                aria-label="Go to slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    @endif
</div>