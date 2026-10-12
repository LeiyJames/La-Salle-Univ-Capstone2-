<div>
    <!-- Minimized Sidebar (w-[72px]) -->
    <div class="fixed inset-y-0 left-0 z-50 flex flex-col w-[72px] bg-green-700 ring-1 ring-white/10"
        x-cloak
        x-show="!sidebar">
        <div class="flex flex-col h-full px-3 pb-4">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 shrink-0 mt-3">
                <a href="/admin" wire:navigate.hover class="flex items-center justify-center">
                    <img class="w-auto h-8" src="{{ asset('assets/img/logo.png') }}" alt="LSU Logo">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col flex-1 mt-6">
                <ul role="list" class="flex flex-col flex-1 justify-between">
                    <li>
                        <ul role="list" class="space-y-2">
                            <!-- Home -->
                            @php
                                $isHome = request()->is('admin');
                            @endphp
                            <li>
                                <a href="/admin"
                                    wire:navigate.hover
                                    class="relative group flex items-center justify-center p-2.5 rounded-lg transition-all {{ $isHome ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isHome)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-white rounded-r-full"></span>
                                    @endif
                                    <x-icons.home class="w-6 h-6 shrink-0" fill="{{ $isHome ? '#ffffff' : '#dce7ef' }}" />
                                    
                                    <!-- Tooltip -->
                                    <div class="absolute left-full ml-3 px-2.5 py-1 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-xl pointer-events-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 whitespace-nowrap z-[60] flex items-center">
                                        <span class="absolute right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900"></span>
                                        Home
                                    </div>
                                </a>
                            </li>

                            <!-- Events -->
                            @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                            @php
                                $isEvent = request()->is('admin/event*');
                            @endphp
                            <li>
                                <a href="/admin/event"
                                    wire:navigate.hover
                                    class="relative group flex items-center justify-center p-2.5 rounded-lg transition-all {{ $isEvent ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isEvent)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-white rounded-r-full"></span>
                                    @endif
                                    <x-icons.star-outline class="w-6 h-6 shrink-0" fill="{{ $isEvent ? '#ffffff' : '#dce7ef' }}" />

                                    <!-- Tooltip -->
                                    <div class="absolute left-full ml-3 px-2.5 py-1 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-xl pointer-events-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 whitespace-nowrap z-[60] flex items-center">
                                        <span class="absolute right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900"></span>
                                        Events
                                    </div>
                                </a>
                            </li>
                            @endif

                            <!-- Users -->
                            @if (in_array(auth()->user()->users_role, ['admin']))
                            @php
                                $isUser = request()->is('admin/user*');
                            @endphp
                            <li>
                                <a href="/admin/user"
                                    wire:navigate.hover
                                    class="relative group flex items-center justify-center p-2.5 rounded-lg transition-all {{ $isUser ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isUser)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-white rounded-r-full"></span>
                                    @endif
                                    <x-icons.users-two class="w-6 h-6 shrink-0" stroke="{{ $isUser ? '#ffffff' : '#dce7ef' }}" />

                                    <!-- Tooltip -->
                                    <div class="absolute left-full ml-3 px-2.5 py-1 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-xl pointer-events-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 whitespace-nowrap z-[60] flex items-center">
                                        <span class="absolute right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900"></span>
                                        Users
                                    </div>
                                </a>
                            </li>
                            @endif

                            <!-- Carousel -->
                            @if (in_array(auth()->user()->users_role, ['admin']))
                            @php
                                $isGallery = request()->is('admin/gallery*');
                            @endphp
                            <li>
                                <a href="/admin/gallery"
                                    wire:navigate.hover
                                    class="relative group flex items-center justify-center p-2.5 rounded-lg transition-all {{ $isGallery ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isGallery)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-white rounded-r-full"></span>
                                    @endif
                                    <x-icons.gallery-heart class="w-6 h-6 shrink-0" stroke="{{ $isGallery ? '#ffffff' : '#dce7ef' }}" />

                                    <!-- Tooltip -->
                                    <div class="absolute left-full ml-3 px-2.5 py-1 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-xl pointer-events-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 whitespace-nowrap z-[60] flex items-center">
                                        <span class="absolute right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900"></span>
                                        Carousel
                                    </div>
                                </a>
                            </li>
                            @endif

                            <!-- FAQ -->
                            @if (in_array(auth()->user()->users_role, ['admin']))
                            @php
                                $isFaq = request()->is('admin/frequently-asked-question*');
                            @endphp
                            <li>
                                <a href="/admin/frequently-asked-question"
                                    wire:navigate.hover
                                    class="relative group flex items-center justify-center p-2.5 rounded-lg transition-all {{ $isFaq ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isFaq)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-5 bg-white rounded-r-full"></span>
                                    @endif
                                    <x-icons.question-mark-fill class="w-6 h-6 shrink-0" fill="{{ $isFaq ? '#ffffff' : '#dce7ef' }}" />

                                    <!-- Tooltip -->
                                    <div class="absolute left-full ml-3 px-2.5 py-1 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-xl pointer-events-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 whitespace-nowrap z-[60] flex items-center">
                                        <span class="absolute right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900"></span>
                                        FAQ
                                    </div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <!-- Logout -->
                    <li class="mt-auto pt-4">
                        <button type="button"
                            @click="$dispatch('open-logout-modal')"
                            class="relative group w-full flex items-center justify-center p-2.5 rounded-lg text-gray-100 hover:bg-red-600/80 hover:text-white transition-all">
                            <x-icons.sign-out-right class="w-6 h-6 shrink-0" fill="#dce7ef" />

                            <!-- Tooltip -->
                            <div class="absolute left-full ml-3 px-2.5 py-1 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-xl pointer-events-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 whitespace-nowrap z-[60] flex items-center">
                                <span class="absolute right-full top-1/2 -translate-y-1/2 border-4 border-transparent border-r-gray-900"></span>
                                Log out
                            </div>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Expanded Sidebar (w-64) -->
    <div class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-green-700"
        x-cloak
        x-show="sidebar">
        <div class="flex flex-col h-full px-6 pb-4 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center h-16 mt-5 shrink-0">
                <a href="/admin" wire:navigate.hover>
                    <img class="w-auto h-8" src="{{ asset('assets/img/lsu-logotype-white 1.png') }}" alt="LSU Logotype">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col flex-1 mt-6">
                <ul role="list" class="flex flex-col flex-1 justify-between gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1.5">
                            <!-- Home -->
                            @php
                                $isHome = request()->is('admin');
                            @endphp
                            <li>
                                <a href="/admin"
                                    wire:navigate.hover
                                    class="relative flex items-center p-2.5 text-sm font-semibold rounded-lg transition-all gap-x-3 {{ $isHome ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isHome)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full shadow"></span>
                                    @endif
                                    <x-icons.home class="w-6 h-6 shrink-0" fill="{{ $isHome ? '#ffffff' : '#dce7ef' }}" />
                                    <span class="{{ $isHome ? 'font-bold' : '' }}">Home</span>
                                </a>
                            </li>

                            <!-- Events -->
                            @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                            @php
                                $isEvent = request()->is('admin/event*');
                            @endphp
                            <li>
                                <a href="/admin/event"
                                    wire:navigate.hover
                                    class="relative flex items-center p-2.5 text-sm font-semibold rounded-lg transition-all gap-x-3 {{ $isEvent ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isEvent)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full shadow"></span>
                                    @endif
                                    <x-icons.star-outline class="w-6 h-6 shrink-0" fill="{{ $isEvent ? '#ffffff' : '#dce7ef' }}" />
                                    <span class="{{ $isEvent ? 'font-bold' : '' }}">Events</span>
                                </a>
                            </li>
                            @endif

                            <!-- Users -->
                            @if (in_array(auth()->user()->users_role, ['admin']))
                            @php
                                $isUser = request()->is('admin/user*');
                            @endphp
                            <li>
                                <a href="/admin/user"
                                    wire:navigate.hover
                                    class="relative flex items-center p-2.5 text-sm font-semibold rounded-lg transition-all gap-x-3 {{ $isUser ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isUser)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full shadow"></span>
                                    @endif
                                    <x-icons.users-two class="w-6 h-6 shrink-0" stroke="{{ $isUser ? '#ffffff' : '#dce7ef' }}" />
                                    <span class="{{ $isUser ? 'font-bold' : '' }}">Users</span>
                                </a>
                            </li>
                            @endif

                            <!-- Carousel -->
                            @if (in_array(auth()->user()->users_role, ['admin']))
                            @php
                                $isGallery = request()->is('admin/gallery*');
                            @endphp
                            <li>
                                <a href="/admin/gallery"
                                    wire:navigate.hover
                                    class="relative flex items-center p-2.5 text-sm font-semibold rounded-lg transition-all gap-x-3 {{ $isGallery ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isGallery)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full shadow"></span>
                                    @endif
                                    <x-icons.gallery-heart class="w-6 h-6 shrink-0" stroke="{{ $isGallery ? '#ffffff' : '#dce7ef' }}" />
                                    <span class="{{ $isGallery ? 'font-bold' : '' }}">Carousel</span>
                                </a>
                            </li>
                            @endif

                            <!-- FAQ -->
                            @if (in_array(auth()->user()->users_role, ['admin']))
                            @php
                                $isFaq = request()->is('admin/frequently-asked-question*');
                            @endphp
                            <li>
                                <a href="/admin/frequently-asked-question"
                                    wire:navigate.hover
                                    class="relative flex items-center p-2.5 text-sm font-semibold rounded-lg transition-all gap-x-3 {{ $isFaq ? 'bg-green-900 text-white shadow-inner ring-1 ring-white/20' : 'text-gray-100 hover:bg-green-800/80 hover:text-white' }}">
                                    @if ($isFaq)
                                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full shadow"></span>
                                    @endif
                                    <x-icons.question-mark-fill class="w-6 h-6 shrink-0" fill="{{ $isFaq ? '#ffffff' : '#dce7ef' }}" />
                                    <span class="{{ $isFaq ? 'font-bold' : '' }}">FAQ</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <!-- Logout -->
                    <li class="mt-auto pt-4">
                        <button type="button"
                            @click="$dispatch('open-logout-modal')"
                            class="flex w-full items-center p-2.5 -mx-2 text-sm font-semibold rounded-lg text-gray-100 hover:bg-red-600/80 hover:text-white transition-all gap-x-3">
                            <x-icons.sign-out-right class="w-6 h-6 shrink-0" fill="#dce7ef" />
                            <span>Log out</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
