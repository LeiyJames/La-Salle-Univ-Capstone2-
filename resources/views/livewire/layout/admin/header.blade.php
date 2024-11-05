<div class="sticky top-0 z-40 flex h-20 items-center px-4 sm:px-6 lg:px-8 bg-white shadow-md">
    <!-- Sidebar Toggle Button -->
    <button type="button" class="-m-2.5 p-2.5 text-gray-700" x-on:click="toggleSidebar">
        <span class="sr-only">Toggle Sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Spacer for Flex Layout -->
    <div class="flex-1"></div>

    <!-- User Profile Dropdown -->
    <div class="flex items-center gap-x-4 lg:gap-x-6">
        <div class="relative">
            <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
                aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <x-icons.user-circle class="w-8 h-8" stroke="#323b3f" />
                <span class="hidden lg:flex lg:items-center">
                    <div class="text-left">
                        <p class="ml-4 text-xs">Hello</p>
                        <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ $fullname }}</span>
                    </div>
                </span>
            </button>
        </div>
    </div>
</div>
