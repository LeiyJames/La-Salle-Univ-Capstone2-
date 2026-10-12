<div class="relative z-20 -mt-8 sm:-mt-10 max-w-6xl mx-auto px-4 sm:px-6">
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl shadow-gray-200/60 border border-gray-100 p-3 sm:p-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 sm:gap-4">
            <!-- 1. Event Spotlight -->
            <a href="/event/spotlight" wire:navigate.hover
               class="group flex items-center gap-3 p-3 rounded-2xl transition-all duration-200 {{ request()->is('event/spotlight*') ? 'bg-yellow-50 border border-yellow-300 shadow-sm' : 'hover:bg-green-50/80 hover:border-green-200 border border-transparent' }}">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ request()->is('event/spotlight*') ? 'bg-yellow-400 text-green-950' : 'bg-green-100 text-green-800 group-hover:bg-green-700 group-hover:text-white' }} transition-colors shadow-sm">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-green-800 truncate">Event Spotlight</h4>
                    <p class="text-[10px] text-gray-500 hidden sm:block truncate">Featured campus events</p>
                </div>
            </a>

            <!-- 2. Calendar of Events -->
            <a href="/calendar-of-events" wire:navigate.hover
               class="group flex items-center gap-3 p-3 rounded-2xl transition-all duration-200 {{ request()->is('calendar-of-events*') ? 'bg-yellow-50 border border-yellow-300 shadow-sm' : 'hover:bg-green-50/80 hover:border-green-200 border border-transparent' }}">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ request()->is('calendar-of-events*') ? 'bg-yellow-400 text-green-950' : 'bg-green-100 text-green-800 group-hover:bg-green-700 group-hover:text-white' }} transition-colors shadow-sm">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-green-800 truncate">Event Calendar</h4>
                    <p class="text-[10px] text-gray-500 hidden sm:block truncate">Monthly schedules & dates</p>
                </div>
            </a>

            <!-- 3. FAQs -->
            <a href="/frequently-asked-questions" wire:navigate.hover
               class="group flex items-center gap-3 p-3 rounded-2xl transition-all duration-200 {{ request()->is('frequently-asked-questions*') ? 'bg-yellow-50 border border-yellow-300 shadow-sm' : 'hover:bg-green-50/80 hover:border-green-200 border border-transparent' }}">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ request()->is('frequently-asked-questions*') ? 'bg-yellow-400 text-green-950' : 'bg-green-100 text-green-800 group-hover:bg-green-700 group-hover:text-white' }} transition-colors shadow-sm">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-green-800 truncate">Helpdesk & FAQ</h4>
                    <p class="text-[10px] text-gray-500 hidden sm:block truncate">Common student inquiries</p>
                </div>
            </a>

            <!-- 4. About SAC -->
            <a href="/about-us" wire:navigate.hover
               class="group flex items-center gap-3 p-3 rounded-2xl transition-all duration-200 {{ request()->is('about-us*') ? 'bg-yellow-50 border border-yellow-300 shadow-sm' : 'hover:bg-green-50/80 hover:border-green-200 border border-transparent' }}">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ request()->is('about-us*') ? 'bg-yellow-400 text-green-950' : 'bg-green-100 text-green-800 group-hover:bg-green-700 group-hover:text-white' }} transition-colors shadow-sm">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-green-800 truncate">About SAC</h4>
                    <p class="text-[10px] text-gray-500 hidden sm:block truncate">Student Activities Center</p>
                </div>
            </a>
        </div>
    </div>
</div>