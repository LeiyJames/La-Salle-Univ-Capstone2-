<div class="sticky top-0 z-40">
    <div class="bg-gradient-to-r from-green-900 via-green-800 to-green-900 border-b border-green-700/70 shadow-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8" aria-label="Global">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <a href="/" wire:navigate.hover class="flex items-center gap-3 group focus:outline-none">
                    <img class="h-9 sm:h-10 w-auto object-contain transition-transform group-hover:scale-105"
                         src="{{ asset('assets/img/lsu-logotype-white 1.png') }}"
                         alt="La Salle University">
                    <div class="hidden sm:block border-l border-green-600/60 pl-3">
                        <span class="block text-[11px] font-black uppercase tracking-widest text-yellow-400 leading-none">Student Events</span>
                        <span class="block text-[10px] text-green-200 tracking-wider">Activities Center</span>
                    </div>
                </a>
            </div>

            <!-- Right: Search or Auth CTA -->
            <div class="flex items-center gap-3">
                @auth
                <a href="/admin" wire:navigate.hover
                    class="inline-flex items-center gap-2 rounded-xl bg-yellow-400 hover:bg-yellow-300 text-green-950 font-black px-4 py-2 text-xs uppercase tracking-wider shadow-sm transition-all transform active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <span>Admin Dashboard</span>
                </a>
                @else
                <a href="/login" wire:navigate.hover
                    class="inline-flex items-center gap-2 rounded-xl bg-green-950/70 hover:bg-black text-white hover:text-yellow-300 font-bold px-4 py-2 text-xs uppercase tracking-wider border border-green-600/50 shadow-sm transition-all transform active:scale-95">
                    <svg class="h-3.5 w-3.5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <span>Sign In</span>
                </a>
                @endauth
            </div>
        </nav>
    </div>
</div>
