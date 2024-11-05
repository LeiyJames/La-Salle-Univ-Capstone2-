<div x-data="data">
    <div class="bg-green-700">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8" aria-label="Global">
            <a href="/" class="-m-1.5 p-1.5">
                <span class="sr-only">LSU Student Events</span>
                <img class="h-9 w-auto" src="{{ asset('assets/img/lsu-logotype-white 1.png') }}" alt="lsu-logotype-white">
            </a>
            <div class="flex lg:hidden">
                <button 
                    type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-2xl p-2.5 text-gray-700 transition-colors duration-300 hover:text-white hover:bg-gray-800"
                    x-on:click="toggleMenu">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-8">
                <a href="/" class="text-sm leading-6 text-gray-100 uppercase py-0.5 transition-colors duration-300 hover:text-slate-300 hover:bg-transparent">Home</a>
                <a href="/about-us" class="text-sm leading-6 text-gray-100 uppercase py-0.5 transition-colors duration-300 hover:text-slate-300 hover:bg-transparent">About</a>
                <a href="/login" class="text-sm leading-6 text-gray-100 uppercase py-0.5 transition-colors duration-300 hover:text-gray-950	hover:bg hover:bg-slate-200 bg-gray-950 rounded-2xl px-5">Login</a>
            </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div role="dialog" aria-modal="true" x-show="menu">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div class="fixed inset-0 z-50" x-show="menu"></div>
            <div
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-green-700 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 transition-opacity duration-300"
                x-show="menu">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">LSU Student Events</span>
                        <img class="h-9 w-auto" src="{{ asset('assets/img/lsu-logotype-white 1.png') }}" alt="">
                    </a>
                    <button 
                        type="button" 
                        class="-m-2.5 rounded-2xl p-2.5 text-gray-700 transition-colors duration-300" 
                        x-on:click="toggleMenu">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a href="/"
                                class="-mx-3 block rounded-2xl px-3 py-2 text-base leading-7 text-gray-100 hover:bg-gray-50 transition-colors duration-300">Home</a>
                            <a href="/about-us"
                                class="-mx-3 block rounded-2xl px-3 py-2 text-base leading-7 text-gray-100 hover:bg-gray-50 transition-colors duration-300">About</a>
                            <a href="/login"
                                class="-mx-3 block rounded-2xl px-3 py-2 text-base leading-7 text-gray-100 hover:bg-gray-50 transition-colors duration-300">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                menu: false,
     
                toggleMenu() {
                    this.menu = ! this.menu
                },
            }))
        })
    </script>
</div>
