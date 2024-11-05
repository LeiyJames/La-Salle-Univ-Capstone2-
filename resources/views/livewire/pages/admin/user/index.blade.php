<div x-data="data">
    <div class="space-y-5">
        <div class="mx-auto ">
                <img src="{{ asset('assets/img/admin-user.jpg') }}" class="object-cover w-full h-auto" alt="Header Image">
        </div>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-gray-600 uppercase">Users</h1>
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs text-gray-400">Home</a>
                    <span class="text-xs text-gray-400">/</span>
                    <span class="text-xs text-blue-400">User</span>
                </div>
            </div>

            @if (in_array(auth()->user()->users_role, ['admin']))
            <x-primary-button class="py-2.5" x-on:click="add_user_slider = true">
                <span class="w-full text-center">{{ __('Add new') }}</span>
            </x-primary-button>
            @endif
        </div>
        <div class="p-5 space-y-5 bg-white rounded-2xl">
            <div class="grid grid-cols-1 gap-3 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <x-input-label for="email" :value="__('Search')" class="mb-1" />
                    <div class="relative">
                        <x-icons.search class="absolute top-[10.5px] left-3 w-4 h-4" stroke="#6b7280" />
                        <x-text-input type="text" class="w-full pl-8 rounded-2xl" wire:model.live="search" />
                    </div>
                </div>
            </div>

            @if (in_array(auth()->user()->users_role, ['admin']))
            <div class="overflow-y-auto">
                <table class="min-w-full border-t divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Email
                            </th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Date Created</th>
                            <th scope="col" class="uppercase relative py-3.5">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data as $user)
                            @if (in_array($user->users_role, ['editor', 'student']))
                            <tr>
                                <td class="py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $user->users_family_name }}, {{ $user->users_given_name }}</td>
                                <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $user->users_email }}</td>
                                <td class="py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="capitalize">{{ $user->users_role }}</span>
                                </td>
                                <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $user->created_at }}</td>
                                <td class="relative py-4 space-x-3 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="#" class="text-green-600 hover:text-green-900" wire:click="edit({{ $user->users_id }})">
                                        <span>Edit</span>
                                    </a>
                                    <a href="#" class="text-red-600 hover:text-red-900" wire:click="delete({{ $user->users_id }})">
                                        <span>Delete</span>
                                    </a>
                                </td>
                            </tr>
                            @endif
                        @empty
                        <tr>
                            <td class="py-4 text-sm text-center text-gray-500 whitespace-nowrap" colspan="5">
                                <span>No data available.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($data->hasPages())
            <div>
                {{ $data->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>


    @if (in_array(auth()->user()->users_role, ['admin']))
    @livewire('pages.admin.user.slider.create', ['slider' => 'add_user_slider'])
    @livewire('pages.admin.user.slider.edit', ['slider' => 'edit_user_slider'])
    @livewire('pages.admin.user.modal.delete', ['modal' => 'delete_user_modal'])
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                add_user_slider: false,
                edit_user_slider: @entangle('edit_user_slider'),
                delete_user_modal: @entangle('delete_user_modal')
            }))
        })
    </script>
</div>
