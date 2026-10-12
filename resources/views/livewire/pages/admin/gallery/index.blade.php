<div x-data="{
    add_gallery_slider: false,
    delete_gallery_modal: @entangle('delete_gallery_modal')
}">
    <div class="space-y-6">
        <!-- 1. Header & Quick Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="/admin" wire:navigate.hover class="hover:text-green-700 transition-colors">Home</a>
                    <span>/</span>
                    <span class="text-green-700 font-semibold">Hero Carousel</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Hero Carousel Banners</h1>
                <p class="text-xs text-gray-500 mt-0.5">Manage revolving banner slides displayed on the public student portal homepage</p>
            </div>

            <!-- Header Action Buttons -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ url('/') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-xs font-semibold text-gray-700 shadow-sm hover:bg-gray-50 hover:text-green-700 transition-all">
                    <svg class="h-4 w-4 text-gray-400 group-hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <span>View Live Site</span>
                </a>

                @if (in_array(auth()->user()->users_role, ['admin']))
                <button type="button"
                    x-on:click="add_gallery_slider = true"
                    class="inline-flex items-center gap-2 rounded-xl bg-green-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-green-800 transition-all transform active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Upload Banner</span>
                </button>
                @endif
            </div>
        </div>

        <!-- Flash messages -->
        @if (session()->has('success'))
        <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-xs text-emerald-800 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <svg class="h-4 w-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif
        @if (session()->has('error'))
        <div class="rounded-xl bg-red-50 border border-red-200 p-4 text-xs text-red-800 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <svg class="h-4 w-4 text-red-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- 2. Main Card Container -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <!-- Status Filter Tabs -->
            <div class="border-b border-gray-100 bg-gray-50/60 px-6 pt-3">
                <nav class="flex space-x-2 sm:space-x-4 overflow-x-auto" aria-label="Tabs">
                    <button type="button"
                        wire:click="setTab('all')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'all' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>All Banners</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'all' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['all'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('active')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'active' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Live on Homepage</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['active'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('inactive')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'inactive' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Hidden / Inactive</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'inactive' ? 'bg-gray-300 text-gray-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['inactive'] }}</span>
                    </button>
                </nav>
            </div>

            <!-- Banner Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/75">
                        <tr>
                            <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Banner Preview
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Information
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Date Uploaded
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Display Status
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-6 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($data as $gallery)
                        @php
                            $mediaUrl = $gallery->getFirstMediaUrl('gallery');
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <!-- Preview Thumbnail -->
                            <td class="py-4 pl-6 pr-3 whitespace-nowrap">
                                <div class="relative group">
                                    @if ($mediaUrl)
                                    <div class="w-44 h-24 rounded-xl overflow-hidden bg-gray-100 border border-gray-200 shadow-sm relative">
                                        <img src="{{ $mediaUrl }}"
                                            alt="Carousel Banner"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            loading="lazy">
                                        <a href="{{ $mediaUrl }}" target="_blank" rel="noopener noreferrer"
                                            title="View Full Image"
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                            <svg class="h-6 w-6 drop-shadow" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                            </svg>
                                        </a>
                                    </div>
                                    @else
                                    <div class="w-44 h-24 rounded-xl bg-gray-100 border border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400">
                                        <svg class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <span class="text-[10px]">No image file</span>
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Info -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-gray-900 font-mono">#BANNER-{{ str_pad($gallery->galleries_id, 3, '0', STR_PAD_LEFT) }}</span>
                                    <div class="mt-1 flex items-center gap-1.5">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Homepage Carousel
                                        </span>
                                    </div>
                                    <span class="text-[11px] text-gray-400 mt-1">Recommended: 16:9 Landscape</span>
                                </div>
                            </td>

                            <!-- Date Uploaded -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-xs text-gray-700">
                                    <svg class="h-4 w-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $gallery->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                                        <div class="text-[11px] text-gray-400">{{ $gallery->created_at?->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Status Toggle -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if (in_array(auth()->user()->users_role, ['admin']))
                                <button type="button"
                                    wire:click="toggleStatus({{ $gallery->galleries_id }})"
                                    wire:loading.attr="disabled"
                                    title="Click to toggle banner visibility"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold transition-all shadow-sm border {{ $gallery->galleries_status ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-gray-100 text-gray-600 border-gray-200 hover:bg-gray-200' }}">
                                    @if ($gallery->galleries_status)
                                    <span>Live on Homepage</span>
                                    @else
                                    <span>Hidden</span>
                                    @endif
                                </button>
                                @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $gallery->galleries_status ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $gallery->galleries_status ? 'Active' : 'Hidden' }}
                                </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 pl-3 pr-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($mediaUrl)
                                    <a href="{{ $mediaUrl }}" target="_blank" rel="noopener noreferrer"
                                        title="View Full Size"
                                        class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </a>
                                    @endif

                                    @if (in_array(auth()->user()->users_role, ['admin']))
                                    <button type="button"
                                        wire:click="delete({{ $gallery->galleries_id }})"
                                        title="Delete Banner"
                                        class="p-1.5 rounded-lg text-red-500 hover:text-red-700 hover:bg-red-50 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <div class="max-w-sm mx-auto flex flex-col items-center">
                                    <div class="h-14 w-14 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 mb-3">
                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">No carousel banners found</h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if ($tab !== 'all')
                                            No banners match the "{{ ucfirst($tab) }}" filter. Try switching tabs.
                                        @else
                                            No hero banners uploaded yet. Upload high-resolution banners to showcase on the homepage!
                                        @endif
                                    </p>
                                    @if ($tab === 'all' && in_array(auth()->user()->users_role, ['admin']))
                                    <button type="button"
                                        x-on:click="add_gallery_slider = true"
                                        class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-green-700 px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-green-800 transition-all">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Upload First Banner</span>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($data->hasPages())
            <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-4">
                {{ $data->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Livewire Drawers & Modals -->
    @if (in_array(auth()->user()->users_role, ['admin']))
        @livewire('pages.admin.gallery.slider.create', ['slider' => 'add_gallery_slider'])
        @livewire('pages.admin.gallery.modal.delete', ['modal' => 'delete_gallery_modal'])
    @endif
</div>