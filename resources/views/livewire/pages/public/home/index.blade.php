<div>
    <!-- 1. Hero Carousel Banner -->
    @livewire('component.public.carousel', ['height' => '500'])

    <!-- 2. Floating Quick Feature Navigation Bar -->
    @livewire('layout.public.sub-navigation')

    <div class="space-y-6 sm:space-y-10 pb-12 pt-6 sm:pt-8">
        <!-- Main Event Discovery Section -->
        @livewire('component.public.events')

        <!-- Campus Engagement Callout Banner -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-900 via-green-800 to-green-950 p-8 sm:p-12 shadow-xl border border-green-700/50">
                <div class="relative z-10 max-w-2xl space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-yellow-400 text-green-950 shadow-sm">
                        Student Activities Center
                    </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Have an activity proposal or need event guidance?
                </h2>
                <p class="text-xs sm:text-sm text-green-100 leading-relaxed">
                    The Student Activities Center is here to support student organizations, collegiate councils, and committees in bringing their creative campus initiatives to life.
                </p>
                <div class="pt-2 flex flex-wrap gap-3">
                    <a href="/frequently-asked-questions" wire:navigate.hover
                       class="inline-flex items-center gap-2 rounded-xl bg-yellow-400 hover:bg-yellow-300 text-green-950 font-bold px-4 py-2.5 text-xs uppercase tracking-wider shadow-md transition-all">
                        <span>Check Student FAQs</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="/about-us" wire:navigate.hover
                       class="inline-flex items-center gap-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold px-4 py-2.5 text-xs uppercase tracking-wider border border-white/20 backdrop-blur-sm transition-all">
                        <span>About SAC Programs</span>
                    </a>
                </div>
            </div>

            <!-- Decorative background accents -->
            <div class="absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-green-700/30 blur-3xl pointer-events-none"></div>
            <div class="absolute right-12 top-1/2 -translate-y-1/2 hidden lg:block opacity-15 pointer-events-none">
                <svg class="h-64 w-64 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
            </div>
        </div>
    </div>
</div>
</div>