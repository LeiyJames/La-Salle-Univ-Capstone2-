<div x-data="{
    add_faq_slider: false,
    edit_faq_slider: @entangle('edit_faq_slider'),
    delete_faq_modal: @entangle('delete_faq_modal')
}">
    <div class="space-y-6">
        <!-- 1. Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="/admin" wire:navigate.hover class="hover:text-green-700 transition-colors">Home</a>
                    <span>/</span>
                    <span class="text-green-700 font-semibold">Helpdesk & FAQs</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Frequently Asked Questions</h1>
                <p class="text-xs text-gray-500 mt-0.5">Manage student helpdesk Q&As and inquiries published on the public portal</p>
            </div>

            <!-- Header Action Button -->
            @if (in_array(auth()->user()->users_role, ['admin']))
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ url('/frequently-asked-questions') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-xs font-semibold text-gray-700 shadow-sm hover:bg-gray-50 hover:text-green-700 transition-all">
                    <svg class="h-4 w-4 text-gray-400 group-hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <span>View Public FAQ</span>
                </a>

                <button type="button"
                    x-on:click="add_faq_slider = true"
                    class="inline-flex items-center gap-2 rounded-xl bg-green-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-green-800 transition-all transform active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Add New Question</span>
                </button>
            </div>
            @endif
        </div>

        <!-- 2. Main Card Container -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <!-- Filter Tabs -->
            <div class="border-b border-gray-100 bg-gray-50/60 px-6 pt-3">
                <nav class="flex space-x-2 sm:space-x-4 overflow-x-auto" aria-label="Tabs">
                    <button type="button"
                        wire:click="setTab('all')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'all' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>All Questions</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'all' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['all'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('active')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'active' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span class="flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            <span>Published / Active</span>
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['active'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('inactive')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'inactive' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Drafts / Hidden</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'inactive' ? 'bg-gray-300 text-gray-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['inactive'] }}</span>
                    </button>
                </nav>
            </div>

            <!-- Search Toolbar -->
            <div class="p-5 border-b border-gray-100 bg-white">
                <div class="relative max-w-md">
                    <x-icons.search class="absolute top-[10.5px] left-3 w-4 h-4" stroke="#9ca3af" />
                    <input type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search questions or answer keywords..."
                        class="w-full pl-9 pr-4 py-2 bg-gray-50/70 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:border-green-600 focus:ring-1 focus:ring-green-600 transition-all placeholder:text-gray-400">
                </div>
            </div>

            <!-- Table of FAQs -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/75">
                        <tr>
                            <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider" style="width: 45%;">
                                Question & Answer
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Date Added
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Visibility Status
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-6 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($data as $faq)
                        <tr class="hover:bg-gray-50/80 transition-colors" x-data="{ expanded: false }">
                            <!-- Question and Answer preview -->
                            <td class="py-4 pl-6 pr-4">
                                <div class="space-y-1.5">
                                    <div class="flex items-start gap-2.5">
                                        <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-md bg-green-50 text-[10px] font-bold text-green-700 border border-green-200">
                                            Q
                                        </div>
                                        <h3 class="text-xs font-bold text-gray-900 leading-snug">
                                            {{ $faq->faqs_question }}
                                        </h3>
                                    </div>
                                    <div class="pl-7 text-xs text-gray-500">
                                        <p x-show="!expanded" class="line-clamp-2 leading-relaxed">
                                            {{ $faq->faqs_answer }}
                                        </p>
                                        <p x-show="expanded" class="leading-relaxed bg-gray-50 p-2.5 rounded-xl border border-gray-100 text-gray-700" style="display: none;">
                                            {{ $faq->faqs_answer }}
                                        </p>
                                        @if (strlen($faq->faqs_answer) > 120)
                                        <button type="button"
                                            x-on:click="expanded = !expanded"
                                            class="text-[11px] font-semibold text-green-700 hover:text-green-800 mt-1 inline-block">
                                            <span x-text="expanded ? 'Show less' : 'Read full answer'"></span>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Date Added -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-xs text-gray-700">
                                    <svg class="h-4 w-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $faq->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                                        <div class="text-[11px] text-gray-400">{{ $faq->created_at?->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Visibility Status -->
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if (in_array(auth()->user()->users_role, ['admin']))
                                <button type="button"
                                    wire:click="toggleStatus({{ $faq->faqs_id }})"
                                    wire:loading.attr="disabled"
                                    title="Click to toggle visibility on public FAQ"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition-all shadow-sm border {{ $faq->faqs_status ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-gray-100 text-gray-600 border-gray-200 hover:bg-gray-200' }}">
                                    @if ($faq->faqs_status)
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                    </span>
                                    <span>Active</span>
                                    @else
                                    <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                                    <span>Hidden</span>
                                    @endif
                                </button>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $faq->faqs_status ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $faq->faqs_status ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                    {{ $faq->faqs_status ? 'Active' : 'Hidden' }}
                                </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 pl-3 pr-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    @if (in_array(auth()->user()->users_role, ['admin']))
                                    <button type="button"
                                        wire:click="edit({{ $faq->faqs_id }})"
                                        title="Edit FAQ"
                                        class="p-1.5 rounded-lg text-green-700 hover:text-green-900 hover:bg-green-50 transition-colors">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>

                                    <button type="button"
                                        wire:click="delete({{ $faq->faqs_id }})"
                                        title="Delete FAQ"
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
                            <td colspan="4" class="py-12 text-center">
                                <div class="max-w-sm mx-auto flex flex-col items-center">
                                    <div class="h-14 w-14 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 mb-3">
                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">No questions found</h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if ($search)
                                            No FAQ matches your search "{{ $search }}". Try different search terms.
                                        @elseif ($tab !== 'all')
                                            No questions found under the "{{ ucfirst($tab) }}" filter.
                                        @else
                                            No FAQ questions added yet. Add common student questions to help visitors on the portal!
                                        @endif
                                    </p>
                                    @if (!$search && $tab === 'all' && in_array(auth()->user()->users_role, ['admin']))
                                    <button type="button"
                                        x-on:click="add_faq_slider = true"
                                        class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-green-700 px-3.5 py-2 text-xs font-semibold text-white shadow-sm hover:bg-green-800 transition-all">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Add First Question</span>
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
        @livewire('pages.admin.frequently-asked-question.slider.create', ['slider' => 'add_faq_slider'])
        @livewire('pages.admin.frequently-asked-question.slider.edit', ['slider' => 'edit_faq_slider'])
        @livewire('pages.admin.frequently-asked-question.modal.delete', ['modal' => 'delete_faq_modal'])
    @endif
</div>
