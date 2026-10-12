<div class="sticky top-0 z-40 flex h-20 items-center px-4 sm:px-6 lg:px-8 bg-white shadow-md">
    <!-- Sidebar Toggle Button -->
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 hover:text-green-700 hover:bg-gray-100 rounded-lg transition-colors" x-on:click="toggleSidebar" title="Toggle Sidebar">
        <span class="sr-only">Toggle Sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Spacer for Flex Layout -->
    <div class="flex-1"></div>

    <!-- User Profile Dropdown -->
    <div class="flex items-center gap-x-4 lg:gap-x-6">
        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
            <button type="button" 
                @click="open = !open"
                class="-m-1.5 flex items-center p-2 rounded-xl hover:bg-gray-50 focus:outline-none transition-colors border border-transparent hover:border-gray-200" 
                id="user-menu-button"
                :aria-expanded="open" 
                aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <div class="relative">
                    <x-icons.user-circle class="w-9 h-9 text-gray-700" stroke="#15803d" />
                </div>
                <div class="hidden lg:flex lg:items-center ml-3">
                    <div class="text-left">
                        <p class="text-xs text-gray-400 font-medium">Administrator</p>
                        <span class="text-sm font-semibold leading-5 text-gray-800" aria-hidden="true">{{ $fullname }}</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-50 mt-2 w-64 origin-top-right rounded-2xl bg-white p-1.5 shadow-xl ring-1 ring-black/5 divide-y divide-gray-100 focus:outline-none">
                
                <!-- User Info Header -->
                <div class="px-3.5 py-3">
                    <p class="text-xs font-medium text-gray-400">Signed in as</p>
                    <p class="text-sm font-bold text-gray-900 truncate mt-0.5">{{ $fullname }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold bg-green-50 text-green-700 border border-green-200/60 uppercase">
                            {{ auth()->user()->users_role ?? 'admin' }}
                        </span>
                    </div>
                </div>

                <!-- Menu Items -->
                <div class="py-1">
                    <a href="/admin/profile" 
                        wire:navigate.hover
                        @click="open = false"
                        class="flex items-center px-3.5 py-2 text-sm text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-800 transition-colors gap-2.5">
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Admin Profile</span>
                    </a>
                </div>

                <!-- Log Out Action -->
                <div class="py-1">
                    <button type="button"
                        @click="open = false; $dispatch('open-logout-modal')"
                        class="flex w-full items-center px-3.5 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 hover:text-red-700 transition-colors gap-2.5 text-left">
                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-medium">Log out</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
