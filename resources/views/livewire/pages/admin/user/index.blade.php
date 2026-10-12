<div x-data="{
    add_user_slider: false,
    edit_user_slider: @entangle('edit_user_slider'),
    delete_user_modal: @entangle('delete_user_modal')
}">
    <div class="space-y-6">
        <!-- 1. Header & Quick Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
                    <a href="/admin" wire:navigate.hover class="hover:text-green-700 transition-colors">Home</a>
                    <span>/</span>
                    <span class="text-green-700 font-semibold">Users Management</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Users</h1>
                <p class="text-xs text-gray-500 mt-0.5">Manage administrators, student editors, and registered university student accounts</p>
            </div>

            <!-- Header Action Button -->
            @if (in_array(auth()->user()->users_role, ['admin']))
            <div class="flex items-center gap-2.5 shrink-0">
                <button type="button"
                    x-on:click="add_user_slider = true"
                    class="inline-flex items-center gap-2 rounded-xl bg-green-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-green-800 transition-all transform active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 013 19.235z" />
                    </svg>
                    <span>Add New User</span>
                </button>
            </div>
            @endif
        </div>

        <!-- 2. Main Card Container -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <!-- Role Filter Tabs -->
            <div class="border-b border-gray-100 bg-gray-50/60 px-6 pt-3">
                <nav class="flex space-x-2 sm:space-x-4 overflow-x-auto" aria-label="Tabs">
                    <button type="button"
                        wire:click="setTab('all')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'all' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>All Accounts</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'all' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['all'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('admin')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'admin' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Administrators</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['admin'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('editor')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'editor' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Event Editors</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'editor' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['editor'] }}</span>
                    </button>

                    <button type="button"
                        wire:click="setTab('student')"
                        class="inline-flex items-center gap-2 pb-3 px-1 border-b-2 text-xs font-bold transition-colors whitespace-nowrap {{ $tab === 'student' ? 'border-green-700 text-green-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span>Students</span>
                        <span class="px-2 py-0.5 rounded-full text-[11px] {{ $tab === 'student' ? 'bg-blue-100 text-blue-800' : 'bg-gray-200 text-gray-700' }}">{{ $counts['student'] }}</span>
                    </button>
                </nav>
            </div>

            <!-- Search & Filter Toolbar -->
            <div class="p-5 border-b border-gray-100 bg-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search by name, email, or department..."
                            class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all placeholder:text-gray-400" />
                        @if ($search)
                        <button type="button" wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            &times;
                        </button>
                        @endif
                    </div>

                    <!-- Status Filter & Reset -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <select wire:model.live="status" class="py-2 pl-3 pr-8 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700">
                            <option value="">All Statuses</option>
                            <option value="1">Active Only</option>
                            <option value="0">Suspended / Inactive</option>
                        </select>

                        @if ($search || $status !== '' || $tab !== 'all')
                        <button type="button"
                            wire:click="resetFilters"
                            class="inline-flex items-center gap-1 px-3 py-2 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>Reset Filters</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 3. Users Table -->
            @if (in_array(auth()->user()->users_role, ['admin']))
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/75 text-xs uppercase tracking-wider text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3.5 font-semibold cursor-pointer hover:text-gray-900" wire:click="sortBy('users_family_name')">
                                <div class="flex items-center gap-1.5">
                                    <span>User Profile</span>
                                    @if ($sortField === 'users_family_name')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-6 py-3.5 font-semibold cursor-pointer hover:text-gray-900" wire:click="sortBy('email')">
                                <div class="flex items-center gap-1.5">
                                    <span>Email Address</span>
                                    @if ($sortField === 'email')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-6 py-3.5 font-semibold">Role</th>
                            <th class="px-6 py-3.5 font-semibold">Department / Organization</th>
                            <th class="px-6 py-3.5 font-semibold text-center">Status</th>
                            <th class="px-6 py-3.5 font-semibold cursor-pointer hover:text-gray-900" wire:click="sortBy('created_at')">
                                <div class="flex items-center gap-1.5">
                                    <span>Joined</span>
                                    @if ($sortField === 'created_at')
                                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                    @endif
                                </div>
                            </th>
                            <th class="px-6 py-3.5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($data as $user)
                        @php
                            $isSelf = $user->users_id === auth()->id();
                            $initials = strtoupper(substr($user->users_given_name ?? 'U', 0, 1) . substr($user->users_family_name ?? '', 0, 1));
                            $avatarColors = [
                                'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                'editor' => 'bg-green-100 text-green-800 border-green-200',
                                'student' => 'bg-blue-100 text-blue-800 border-blue-200',
                            ];
                            $avatarColor = $avatarColors[$user->users_role] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <!-- User Profile -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <!-- Avatar Initials Circle -->
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl font-bold text-xs border {{ $avatarColor }} shadow-2xs">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 flex items-center gap-2">
                                            <span>{{ $user->users_family_name }}, {{ $user->users_given_name }}</span>
                                            @if ($isSelf)
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-800">You</span>
                                            @endif
                                        </div>
                                        @if ($user->users_middle_name)
                                        <p class="text-[11px] text-gray-400">{{ $user->users_middle_name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Email Address -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-600">
                                {{ $user->email }}
                            </td>

                            <!-- Role Badge -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->users_role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 border border-purple-200">
                                        Administrator
                                    </span>
                                @elseif ($user->users_role === 'editor')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Event Editor
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                        Student
                                    </span>
                                @endif
                            </td>

                            <!-- Organization / College -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-600">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ $user->users_organization_name ?? 'Campus Wide' }}
                                </span>
                            </td>

                            <!-- Status Toggle -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($isSelf)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800" title="Your account is active">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Active
                                    </span>
                                @else
                                    <button type="button"
                                        wire:click="toggleStatus({{ $user->users_id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition-all {{ $user->users_status ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                                        title="Click to toggle status">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $user->users_status ? 'bg-green-600' : 'bg-gray-400' }}"></span>
                                        <span>{{ $user->users_status ? 'Active' : 'Suspended' }}</span>
                                    </button>
                                @endif
                            </td>

                            <!-- Registered Date -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                {{ $user->created_at ? $user->created_at->format('M d, Y') : '—' }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button"
                                        wire:click="edit({{ $user->users_id }})"
                                        class="p-2 rounded-xl text-gray-600 hover:text-green-700 hover:bg-green-50 transition-colors"
                                        title="Edit User">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    @if (!$isSelf)
                                    <button type="button"
                                        wire:click="delete({{ $user->users_id }})"
                                        class="p-2 rounded-xl text-gray-400 hover:text-red-700 hover:bg-red-50 transition-colors"
                                        title="Delete User">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-12 text-center text-gray-500" colspan="7">
                                <div class="max-w-xs mx-auto">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 mx-auto">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-3 text-sm font-bold text-gray-900">No users found</h3>
                                    <p class="mt-1 text-xs text-gray-500">Try adjusting your search query, role tabs, or status filter.</p>
                                    @if ($search || $status !== '' || $tab !== 'all')
                                    <button type="button" wire:click="resetFilters" class="mt-4 px-3 py-1.5 text-xs font-semibold rounded-lg bg-green-50 text-green-700 hover:bg-green-100 transition-colors">
                                        Clear all filters
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if ($data->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $data->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>

    <!-- Sliders and Modals -->
    @if (in_array(auth()->user()->users_role, ['admin']))
    @livewire('pages.admin.user.slider.create', ['slider' => 'add_user_slider'])
    @livewire('pages.admin.user.slider.edit', ['slider' => 'edit_user_slider'])
    @livewire('pages.admin.user.modal.delete', ['modal' => 'delete_user_modal'])
    @endif
</div>
