<div x-data="data">
    <div class="space-y-5">
        <div class="mx-auto ">
            <img src="{{ asset('assets/img/admin-event.jpg') }}" class="object-cover w-full h-auto" alt="Header Image">
        </div>

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-gray-600 uppercase">Events</h1>
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs text-gray-400">Home</a>
                    <span class="text-xs text-gray-400">/</span>
                    <span class="text-xs text-blue-400">Events</span>
                </div>
            </div>
            <div class="flex gap-3">
                @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                <a href="/admin/event/spotlight">
                    <x-primary-button class="py-2.5">
                        <span class="w-full text-center">{{ __('Event Spotlight') }}</span>
                    </x-primary-button>
                </a>
                @endif

                @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
                <a href="/admin/event/create">
                    <x-primary-button class="py-2.5">
                        <span class="w-full text-center">{{ __('Add new') }}</span>
                    </x-primary-button>
                </a>
                @endif
            </div>
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

            @if (in_array(auth()->user()->users_role, ['admin', 'editor']))
            <div class="overflow-y-auto">
                <table class="min-w-full border-t divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Location
                            </th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Date
                                Created</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Status
                            </th>
                            <th scope="col" class="uppercase relative py-3.5">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data as $event)
                        <tr>
                            <td class="py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $event->events_name }}</td>
                            <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $event->events_start_date }} to {{ $event->events_end_date }}</td>
                            <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $event->events_location }}</td>
                            <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $event->created_at }}</td>
                            <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $event->events_status ? 'Active' : 'Inactive' }}</td>
                            <td class="relative py-4 space-x-3 text-sm font-medium text-right whitespace-nowrap">
                                <a href="/admin/event/edit/{{ $event->events_id }}" class="text-green-600 hover:text-green-900">
                                    <span>Edit</span>
                                </a>
                                <a href="#" class="text-red-600 hover:text-red-900" wire:click="delete({{ $event->events_id }})">
                                    <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-4 text-sm text-center text-gray-500 whitespace-nowrap" colspan="6">
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

    @livewire('pages.admin.event.modal.delete', ['modal' => 'delete_event_modal'])

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                delete_event_modal: @entangle('delete_event_modal')
            }))
        })
    </script>
</div>
