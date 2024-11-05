<div>
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div
        class="relative z-50"
        role="dialog"
        aria-modal="true"
        x-show="!sidebar">

        <div class="fixed flex h-full">
            <div
                class="relative flex flex-1 w-full"
                x-show="!sidebar"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full">
                <div
                    class="absolute top-0 flex justify-center w-16 pt-5 left-full"
                    x-show="!sidebar"
                    x-transition:enter="ease-in-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in-out duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                </div>

                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col gap-y-5 overflow-y-auto bg-green-700 px-4 pb-4 ring-1 ring-white/10 w-[72px]">
                    <div class="flex items-center justify-center h-16 shrink-0">
                        <img class="w-auto h-8" src="{{ asset('assets/img/logo.png') }}"
                            alt="Your Company">
                    </div>
                    <nav class="flex flex-col flex-1">
                        <ul role="list" class="flex flex-col flex-1 gap-y-7">
                            <li>
                                <ul role="list" class="space-y-1">
                                    <li>
                                        <!-- Current: "bg-gray-800 text-white", Default: "text-gray-400 hover:text-green-700 hover:bg-gray-100" -->
                                        <a href="/admin"
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:text-green-700 hover:bg-gray-100 group gap-x-3">
                                            <x-icons.home class="w-6 h-6" fill="#dce7ef" />
                                        </a>
                                    </li>

                                    @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                                    <li>
                                        <a href="/admin/event"
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:text-green-700 hover:bg-gray-100 group gap-x-3">
                                            <x-icons.star-outline class="w-6 h-6" fill="#dce7ef" />
                                        </a>
                                    </li>
                                    @endif

                                    @if (in_array(auth()->user()->users_role, ['admin']))
                                    <li>
                                        <a href="/admin/user"
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:text-green-700 hover:bg-gray-100 group gap-x-3">
                                            <x-icons.users-two class="w-6 h-6" stroke="#dce7ef" />
                                        </a>
                                    </li>
                                    @endif

                                    @if (in_array(auth()->user()->users_role, ['admin']))
                                    <li>
                                        <a href="/admin/gallery"
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:text-green-700 hover:bg-gray-100 group gap-x-3">
                                            <x-icons.gallery-heart class="w-6 h-6" stroke="#dce7ef" />
                                        </a>
                                    </li>
                                    @endif

                                    @if (in_array(auth()->user()->users_role, ['admin']))
                                    <li>
                                        <a href="/admin/frequently-asked-question"
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:text-green-700 hover:bg-gray-100 group gap-x-3">
                                            <x-icons.question-mark-fill class="w-6 h-6" fill="#dce7ef" />
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            <li class="mt-auto">
                                <a href="#"
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-400 rounded-md group gap-x-3 hover:bg-gray-800 hover:text-white" wire:click="logout">
                                    <div class="flex items-center gap-2">
                                        <x-icons.sign-out-right class="w-6 h-6" fill="#dce7ef" />
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="fixed inset-y-0 z-50 flex flex-col w-64" x-show="sidebar">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div
            class="flex flex-col px-6 pb-4 overflow-y-auto bg-green-700 grow gap-y-5"
            x-show="sidebar"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">
            <div class="flex items-center h-16 mt-5 shrink-0">
                <img class="w-auto h-8" src="{{ asset('assets/img/lsu-logotype-white 1.png') }}"
                    alt="lsu-logotype">
            </div>
            <nav class="flex flex-col flex-1">
                <ul role="list" class="flex flex-col flex-1 gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li>
                                <!-- Current: "bg-gray-800 text-white", Default: "text-gray-400 hover:text-green-700 hover:bg-gray-100" -->
                                <a href="/admin"
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:bg-gray-800 group gap-x-3">
                                    <x-icons.home class="w-6 h-6 " fill="#dce7ef" />
                                    <span>Home</span>
                                </a>
                            </li>

                            @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                            <li>
                                <a href="/admin/event"
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:bg-gray-800 group gap-x-3">
                                    <x-icons.star-outline class="w-6 h-6" fill="#dce7ef" />
                                    <span>Events</span>
                                </a>
                            </li>
                            @endif

                            @if (in_array(auth()->user()->users_role, ['admin']))
                            <li>
                                <a href="/admin/user"
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:bg-gray-800 group gap-x-3">
                                    <x-icons.users-two class="w-6 h-6" stroke="#dce7ef" />
                                    <span>Users</span>
                                </a>
                            </li>
                            @endif

                            @if (in_array(auth()->user()->users_role, ['admin']))
                            <li>
                                <a href="/admin/gallery"
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:bg-gray-800 group gap-x-3">
                                    <x-icons.gallery-heart class="w-6 h-6" stroke="#dce7ef" />
                                    <span>Carousel</span>
                                </a>
                            </li>
                            @endif

                            @if (in_array(auth()->user()->users_role, ['admin']))
                            <li>
                                <a href="/admin/frequently-asked-question"
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-100 rounded-md hover:bg-gray-800 group gap-x-3">
                                    <x-icons.question-mark-fill class="w-6 h-6" fill="#dce7ef" />
                                    <span>FAQ</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li class="mt-auto">
                        <a href="#"
                            class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-gray-400 rounded-md group gap-x-3 hover:bg-gray-800 hover:text-white" wire:click="logout">
                            <div class="flex items-center gap-2">
                                <x-icons.sign-out-right class="w-6 h-6" fill="#dce7ef" />
                                <span class="text-gray-100" aria-hidden="true">Log out</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
